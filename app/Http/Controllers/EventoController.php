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
        $evento= Evento::create($request->all());
    }



    public function show()
    {
        $evento = Evento::all();
        return response()->json($evento);
    }

    public function edit(Request $request, $id)
    {
        $evento = Evento::find($id);
        $evento->start=Carbon::createFromFormat('Y-m-d H:i:s', $evento->start)->format('Y-m-d');
        $evento->end=Carbon::createFromFormat('Y-m-d H:i:s', $evento->end)->format('Y-m-d');

        return response()->json($evento);
    }

    public function update(Request $request, Evento $evento)
    {
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
