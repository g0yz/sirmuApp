<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sede;
use App\Models\User;

class SedeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        $sedes = Sede::with('encargado')->get();
            return view('sedes.index', compact('sedes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(){
        $encargados = User::where('rol', 'encargado')->get();
            return view('sedes.create', compact('encargados'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
        $request->validate([
            'nombre' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'tipo' => 'required|in:' . implode(',', Sede::$tipos),
            'encargado_id' => 'nullable|exists:users,id',
            'capacidad_estudiantes' => 'required|integer|min:1',
            'carreras_ofrecidas' => 'required|string',
        ]);

        Sede::create($request->all());
            return redirect()->route('sedes.index')->with('success', 'Sede creada correctamente');
    }

    /**
     * Display the specified resource.
     */
public function show(Sede $sede){
    return view('sedes.show', compact('sede'));
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sede $sede){
        $encargados = User::where('rol', 'encargado')->get();
            return view('sedes.edit', compact('sede','encargados'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sede $sede){
        $request->validate([
            'nombre' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'tipo' => 'required|in:' . implode(',', Sede::$tipos),
            'encargado_id' => 'nullable|exists:users,id',
            'capacidad_estudiantes' => 'required|integer|min:1',
            'carreras_ofrecidas' => 'required|string',
        ]);

        $sede->update($request->all());

        return redirect()->route('sedes.index')->with('success', 'Sede actualizada correctamente');
    }

    public function destroy(Sede $sede){
        $sede->delete();
        return redirect()->route('sedes.index')->with('success', 'Sede eliminada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */

}
