<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Tarea;
use App\Models\Sede;

class TareaController extends Controller{
    

    /**
     * @OA\Get(
     *   path="/tareas",
     *   summary="Listar todas las tareas",
     *   tags={"Tarea"},
     *   @OA\Response(
     *     response=200,
     *     description="Vista con listado de tareas"
     *   )
     * )
     */

    public function index() {
    $tareas = Tarea::with(['sede', 'encargado', 'tecnico'])->get();
    return view('tareas.index', compact('tareas'));
    }

    /**
     * @OA\Get(
     *   path="/tareas/create",
     *   summary="Formulario para crear tarea",
     *   tags={"Tarea"},
     *   @OA\Response(
     *     response=200,
     *     description="Vista con formulario de creación de tarea"
     *   )
     * )
     */

    public function create() {
        $encargados = User::where('rol','encargado')->get();
        $tecnicos = User::where('rol','tecnico')->get();
        $sedes = Sede::all();
        return view('tareas.create',compact('encargados','tecnicos','sedes'));
    }



    /**
    * @OA\Post(
    *   path="/tareas",
    *   summary="Crear una nueva tarea",
    *   tags={"Tarea"},
    *   description="Crea una nueva tarea y permite subir imágenes y documentos asociados",
    *   @OA\RequestBody(
    *     required=true,
    *     @OA\MediaType(
    *       mediaType="multipart/form-data",
    *       @OA\Schema(
    *         @OA\Property(property="sede_id", type="integer", example=1),
    *         @OA\Property(property="encargado_id", type="integer", example=3),
    *         @OA\Property(property="tecnico_id", type="integer", example=5),
    *         @OA\Property(property="titulo", type="string", example="Revisión de mantenimiento"),
    *         @OA\Property(property="prioridad", type="string", example="alta", enum={"alta","media","baja"}),
    *         @OA\Property(property="tipo", type="string", example="mantenimiento", enum={"mantenimiento","presupuesto","instalacion"}),
    *         @OA\Property(property="estado", type="string", example="pendiente", enum={"pendiente","finalizado","validado","rechazado"}),
    *         @OA\Property(property="descripcion", type="string", example="Se realizará mantenimiento de equipos"),
    *         @OA\Property(property="fecha_creacion", type="string", format="date", example="2025-09-15"),
    *         @OA\Property(property="fecha_estimada", type="string", format="date", example="2025-09-20"),
    *         @OA\Property(property="fecha_finalizacion", type="string", format="date", example="2025-09-25"),
    *         @OA\Property(
    *           property="imagenes",
    *           type="array",
    *           @OA\Items(type="string", format="binary")
    *         ),
    *         @OA\Property(
    *           property="documentos",
    *           type="array",
    *           @OA\Items(type="string", format="binary")
    *         )
    *       )
    *     )
    *   ),
    *   @OA\Response(
    *     response=201,
    *     description="Tarea creada exitosamente"
    *   ),
    *   @OA\Response(
    *     response=400,
    *     description="Datos inválidos"
    *   )
    * )
    */

    public function store(Request $request){
        $request->validate([
            'sede_id' => 'exists:sedes,id',
            'encargado_id' => 'exists:users,id',
            'tecnico_id' => 'nullable|exists:users,id',
            'titulo' => 'required|string|max:50',
            'prioridad' => 'required|in:' . implode(',', Tarea::$prioridades),
            'tipo' => 'required|in:' . implode(',', Tarea::$tipos),
            'estado' => 'required|in:' . implode(',', Tarea::$estados),
            'descripcion' => 'required|string|max:250',
            //fecha de validacion se crea en el Modelo Tarea automaticamente
            'fecha_estimada' => 'required|date',
            'fecha_finalizacion' => 'nullable|date|after_or_equal:fecha_estimada',
            'imagenes.*' => 'nullable|image|mimes:jpeg,png',
            'documentos.*' => 'nullable|mimes:pdf,doc,docx',
        ]);

        $tarea = Tarea::create($request->all());

                // Subir imágenes
        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $imagen) {
                $tarea->agregarArchivo($imagen, 'imagenes');
            }
        }

        // Subir documentos
        if ($request->hasFile('documentos')) {
            foreach ($request->file('documentos') as $documento) {
                $tarea->agregarArchivo($documento, 'documentos');
            }
        }

            return redirect()->route('tareas.index')->with('success', 'Tarea creada correctamente');
    }





        public function destroy(Tarea $tarea)
    {

        $tarea->delete();
        return redirect()->route('tareas.index')->with('success', 'tarea eliminada correctamente.');
    }

    
}
