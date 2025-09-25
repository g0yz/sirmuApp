<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evento;
use Carbon\Carbon;

class EventoController extends Controller
{
    
    public function index()
    {
        return view('encargado.calendario.index');
    }



    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate(Evento::$rules);
        $evento = Evento::create([
            'title' => $request->title,
            'descripcion' => $request->descripcion,
            'start' => $request->start,
            'end' => $request->end,
            'user_id' => auth()->id(),
        ]);
            return response()->json(['success' => 'Evento creado correctamente']);   
    }



    public function show()
    {
        $evento = Evento::where('user_id', auth()->id())->get();
        return response()->json($evento);
    }

    public function edit(Request $request, $id)
    {
        $evento = Evento::find($id);

        if ($evento->user_id !== auth()->id()) {
            return response()->json(['error' => 'No autorizado'], 403);
        }

        $evento->start=Carbon::createFromFormat('Y-m-d H:i:s', $evento->start)->format('Y-m-d');
        $evento->end=Carbon::createFromFormat('Y-m-d H:i:s', $evento->end)->format('Y-m-d');

        return response()->json($evento);
    }

    public function update(Request $request, Evento $evento)
    {
        if ($evento->user_id !== auth()->id()) {
            return response()->json(['error' => 'No autorizado'], 403);
        }

        $request->validate(Evento::$rules);
        $evento->update($request->all());
        return response()->json(['success' => 'Evento actualizado correctamente']);
    }



    public function destroy($id)
    {
        
        $evento=Evento::find($id)->delete();
        return response()->json(['success' => 'Evento eliminado correctamente']);
    }


}
