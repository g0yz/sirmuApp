<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sede;
use App\Models\User;


class SedeController extends Controller{
    /**
     * @OA\Get(
     *   path="/sedes",
     *   summary="Listar todas las sedes",
     *   tags={"Sede"},
     *   @OA\Response(
     *     response=200,
     *     description="Vista con listado de sedes"
     *   )
     * )
     */
    public function index(){
        $sedes = Sede::with('encargado')->get();
            return view('sedes.index', compact('sedes'));
    }
    /**
     * @OA\Get(
     *   path="/sedes/create",
     *   summary="Formulario para crear sede",
     *   tags={"Sede"},
     *   @OA\Response(
     *     response=200,
     *     description="Vista con formulario de creación de sede"
     *   )
     * )
     */
    public function create(){
        $encargados = User::where('rol', 'encargado')->get();
            return view('sedes.create', compact('encargados'));
    }
    /**
     * @OA\Post(
     *   path="/sedes",
     *   summary="Guardar una nueva sede",
     *   tags={"Sede"},
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       required={"nombre","direccion","tipo","capacidad_estudiantes","carreras_ofrecidas"},
     *       @OA\Property(property="nombre", type="string", example="Sede Norte"),
     *       @OA\Property(property="direccion", type="string", example="Calle Falsa 123"),
     *       @OA\Property(property="tipo", type="string", example="instituto"),
     *       @OA\Property(property="capacidad_estudiantes", type="integer", example=200),
     *       @OA\Property(property="carreras_ofrecidas", type="string", example="Ingeniería, Medicina"),
     *       @OA\Property(property="encargado_id", type="integer", example=5)
     *     )
     *   ),
     *   @OA\Response(
     *     response=302,
     *     description="Redirección al listado de sedes"
     *   ),
     *   @OA\Response(
     *     response=422,
     *     description="Error de validación"
     *   )
     * )
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
     * @OA\Get(
     *   path="/sedes/{id}",
     *   summary="Mostrar detalle de una sede",
     *   tags={"Sede"},
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     required=true,
     *     @OA\Schema(type="integer"),
     *     description="ID de la sede"
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Vista con detalle de la sede"
     *   ),
     *   @OA\Response(
     *     response=404,
     *     description="Sede no encontrada"
     *   )
     * )
     */
    public function show(Sede $sede){
        return view('sedes.show', compact('sede'));
    }
    /**
     * @OA\Get(
     *   path="/sedes/{id}/edit",
     *   summary="Formulario de edición de una sede",
     *   tags={"Sede"},
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     required=true,
     *     @OA\Schema(type="integer"),
     *     description="ID de la sede"
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Vista con formulario de edición de sede"
     *   ),
     *   @OA\Response(
     *     response=404,
     *     description="Sede no encontrada"
     *   )
     * )
     */
    public function edit(Sede $sede){
        $encargados = User::where('rol', 'encargado')->get();
            return view('sedes.edit', compact('sede','encargados'));
    }
    /**
     * @OA\Put(
     *   path="/sedes/{id}",
     *   summary="Actualizar sede",
     *   tags={"Sede"},
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     required=true,
     *     @OA\Schema(type="integer"),
     *     description="ID de la sede"
     *   ),
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       required={"nombre","direccion","tipo","capacidad_estudiantes","carreras_ofrecidas"},
     *       @OA\Property(property="nombre", type="string", example="Sede Sur"),
     *       @OA\Property(property="direccion", type="string", example="Av. Siempre Viva 742"),
     *       @OA\Property(property="tipo", type="string", example="universidad"),
     *       @OA\Property(property="capacidad_estudiantes", type="integer", example=300),
     *       @OA\Property(property="carreras_ofrecidas", type="string", example="Contabilidad, Derecho"),
     *       @OA\Property(property="encargado_id", type="integer", example=8)
     *     )
     *   ),
     *   @OA\Response(
     *     response=302,
     *     description="Redirección al listado de sedes"
     *   ),
     *   @OA\Response(
     *     response=422,
     *     description="Error de validación"
     *   )
     * )
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
    /**
     * @OA\Delete(
     *   path="/sedes/{id}",
     *   summary="Eliminar sede",
     *   tags={"Sede"},
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     required=true,
     *     @OA\Schema(type="integer"),
     *     description="ID de la sede"
     *   ),
     *   @OA\Response(
     *     response=302,
     *     description="Redirección al listado de sedes con mensaje de éxito"
     *   ),
     *   @OA\Response(
     *     response=404,
     *     description="Sede no encontrada"
     *   )
     * )
     */
    public function destroy(Sede $sede){
        $sede->delete();
        return redirect()->route('sedes.index')->with('success', 'Sede eliminada correctamente');
    }

    public $timestamps = false;

}
