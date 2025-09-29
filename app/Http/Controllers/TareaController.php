<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Tarea;
use App\Models\Sede;
use Illuminate\Support\Facades\Auth;



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
    return view('admin.tareas.index', compact('tareas'));
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

    public function create(){
    $encargados = User::where('rol', 'encargado')->with('persona')->get();
    $tecnicos = User::where('rol', 'tecnico')->with('persona')->get();
    $sedes = Sede::all();

    return view('admin.tareas.create', compact('encargados', 'tecnicos', 'sedes'));
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
            'documentos.*' => 'nullable|mimes:pdf,doc,docx,xls,xlsx',
        ]);


        
        $tarea = Tarea::create([
            'sede_id' => $request->sede_id,
            'encargado_id' => $request->encargado_id,
            'tecnico_id' => $request->tecnico_id,
            'titulo' => $request->titulo,
            'prioridad' => $request->prioridad,
            'tipo' => $request->tipo,
            'estado' => $request->estado,
            'descripcion' => $request->descripcion,
            'fecha_estimada' => $request->fecha_estimada,
            'fecha_finalizacion' => $request->fecha_finalizacion ?? null,
        ]);

                // Subir imágenes
        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $imagen) {
                $tarea->addMedia($imagen)->toMediaCollection('imagenes');
            }
        }

        // Subir documentos
        if ($request->hasFile('documentos')) {
            foreach ($request->file('documentos') as $documento) {
                $tarea->addMedia($documento)->toMediaCollection('documentos');
            }
        }

            return redirect()->route('admin.tareas.index')->with('success', 'Tarea creada correctamente');
    }


    public function show(Tarea $tarea){
        return view('admin.tareas.show', compact('tarea'));
    }
        

    public function edit(Tarea $tarea){
        $encargados = User::where('rol','encargado')->get();
        $tecnicos = User::where('rol','tecnico')->get();
        $sedes = Sede::all();

        return view('admin.tareas.edit', compact('tarea', 'encargados', 'tecnicos', 'sedes'));
    }

public function update(Request $request, Tarea $tarea)
{
    $request->validate([
        'sede_id' => 'exists:sedes,id',
        'encargado_id' => 'exists:users,id',
        'tecnico_id' => 'nullable|exists:users,id',
        'titulo' => 'required|string|max:50',
        'prioridad' => 'required|in:' . implode(',', Tarea::$prioridades),
        'tipo' => 'required|in:' . implode(',', Tarea::$tipos),
        'estado' => 'required|in:' . implode(',', Tarea::$estados),
        'descripcion' => 'required|string|max:250',
        'fecha_estimada' => 'required|date',
        'fecha_finalizacion' => 'nullable|date|after_or_equal:fecha_estimada',
        'imagenes.*' => 'nullable|image|mimes:jpeg,png',
        'documentos.*' => 'nullable|mimes:pdf,doc,docx,xls,xlsx',
    ]);

    $tarea->update($request->all());

    // Subir imágenes nuevas
    if ($request->hasFile('imagenes')) {
        foreach ($request->file('imagenes') as $imagen) {
            $tarea->addMedia($imagen)->toMediaCollection('imagenes');
        }
    }

    // Subir documentos nuevos
    if ($request->hasFile('documentos')) {
        foreach ($request->file('documentos') as $documento) {
            $tarea->addMedia($documento)->toMediaCollection('documentos');
        }
    }

    return redirect()->route('admin.tareas.index')->with('success', 'Tarea actualizada correctamente');
}


    public function destroy(Tarea $tarea){
        $tarea->delete();
        return redirect()->route('admin.tareas.index')->with('succes','Tarea eliminada correctamente');
    }




public function verTarea(Tarea $tarea)
{
    $user = Auth::user();

    // Verificar que la tarea esté asignada a este técnico
    if ($tarea->tecnico_id !== $user->id) {
        abort(403, 'Acceso denegado');
    }

    // Cargar la relación con la sede
    $tarea->load('sede');

    return view('tecnico.tareas.show', compact('tarea'));
}

public function indexTecnico() {
    $user = Auth::user();

    // Obtener solo las tareas asignadas a este técnico
    $tareasAsignadas = Tarea::with('sede')
                            ->where('tecnico_id', $user->id)
                            ->get();

    return view('tecnico.tareas.index', compact('tareasAsignadas'));
}


public function indexEncargado(){
    $user = Auth::user();
    $tareas = Tarea::with(['sede', 'tecnico'])
                    ->where('encargado_id', $user->id)
                    ->get();

    return view('encargado.tareas.listadoTareas', compact('tareas'));

}


public function crearTareaEncargado() {

    $encargado_id = auth()->id();

    $sede = Sede::where('encargado_id', $encargado_id)->first();

    $tecnicos = User::where('rol', 'tecnico')->get();

    return view('encargado.tareas.crearTarea', compact('sede', 'tecnicos'));

}


public function storeEncargado(Request $request) {
    $user = Auth::user(); // Encargado actual

    $request->validate([
        'tecnico_id' => 'nullable|exists:users,id',
        'titulo' => 'required|string|max:50',
        'prioridad' => 'required|in:' . implode(',', Tarea::$prioridades),
        'tipo' => 'required|in:' . implode(',', Tarea::$tipos),
        'estado' => 'required|in:' . implode(',', Tarea::$estados),
        'descripcion' => 'required|string|max:250',
        'fecha_estimada' => 'required|date',
        'fecha_finalizacion' => 'nullable|date|after_or_equal:fecha_estimada',
        'imagenes.*' => 'nullable|image|mimes:jpeg,png',
        'documentos.*' => 'nullable|mimes:pdf,doc,docx,xls,xlsx',
    ]);


        $sede = $user->sede;

        if (!$sede) {
            return redirect()->back()->with('error', 'No tienes una sede asignada.');
        }

    // Crear la tarea usando la sede del encargado
    $tarea = Tarea::create([
        'sede_id' => $user->sede->id, // sede del encargado
        'encargado_id' => $user->id,
        'tecnico_id' => $request->tecnico_id,
        'titulo' => $request->titulo,
        'prioridad' => $request->prioridad,
        'tipo' => $request->tipo,
        'estado' => $request->estado,
        'descripcion' => $request->descripcion,
        'fecha_estimada' => $request->fecha_estimada,
        'fecha_finalizacion' => $request->fecha_finalizacion ?? null,
    ]);

    // Subir imágenes
    if ($request->hasFile('imagenes')) {
        foreach ($request->file('imagenes') as $imagen) {
            $tarea->addMedia($imagen)->toMediaCollection('imagenes');
        }
    }

    // Subir documentos
    if ($request->hasFile('documentos')) {
        foreach ($request->file('documentos') as $documento) {
            $tarea->addMedia($documento)->toMediaCollection('documentos');
        }
    }

    return redirect()->route('encargado.tareas.listadoTareas')
                     ->with('success', 'Tarea creada correctamente');
}



    public function showEncargado(Tarea $tarea){
        return view('encargado.tareas.verTarea', compact('tarea'));
    }


    public function editEncargado(Tarea $tarea){
        $tecnicos = User::where('rol','tecnico')->get();
        return view('encargado.tareas.editarTarea', compact('tarea', 'tecnicos'));
    }




    public function updateEncargado(Request $request, Tarea $tarea){
    $request->validate([
        'tecnico_id' => 'nullable|exists:users,id',
        'titulo' => 'required|string|max:50',
        'prioridad' => 'required|in:' . implode(',', Tarea::$prioridades),
        'tipo' => 'required|in:' . implode(',', Tarea::$tipos),
        'estado' => 'required|in:' . implode(',', Tarea::$estados),
        'descripcion' => 'required|string|max:250',
        'fecha_estimada' => 'required|date',
        'fecha_finalizacion' => 'nullable|date|after_or_equal:fecha_estimada',
        'imagenes.*' => 'nullable|image|mimes:jpeg,png',
        'documentos.*' => 'nullable|mimes:pdf,doc,docx,xls,xlsx',
    ]);

    $tarea->update($request->all());

    // Subir imágenes nuevas
    if ($request->hasFile('imagenes')) {
        foreach ($request->file('imagenes') as $imagen) {
            $tarea->addMedia($imagen)->toMediaCollection('imagenes');
        }
    }

    // Subir documentos nuevos
    if ($request->hasFile('documentos')) {
        foreach ($request->file('documentos') as $documento) {
            $tarea->addMedia($documento)->toMediaCollection('documentos');
        }
    }

    return redirect()->route('encargado.tareas.listadoTareas')->with('success', 'Tarea actualizada correctamente');
}


    public function destroyEncargado(Tarea $tarea){
        $tarea->delete();
        return redirect()->route('encargado.tareas.listadoTareas')->with('succes','Tarea eliminada correctamente');
    }


    public function indexFinalizadasAuditor(){
    $tareasFinalizadas = Tarea::with(['sede', 'encargado', 'tecnico'])
                                ->where('estado', 'finalizada')
                                ->get();

    return view('auditor.tareas.finalizadas', compact('tareasFinalizadas'));

    }



public function formularioResolucion(Tarea $tarea)
{
    $user = Auth::user();

    // Verificar que la tarea esté asignada a este técnico
    if ($tarea->tecnico_id !== $user->id) {
        abort(403, 'Acceso denegado');
    }

    // Cargar archivos previos de resolución
    $archivos = $tarea->listarArchivos('resoluciones');

    return view('tecnico.tareas.resolucion', compact('tarea', 'archivos'));
}



public function subirResolucion(Request $request, Tarea $tarea)
{
    $request->validate([
        'resolucion_desc' => 'required|string',
        'imagenes.*' => 'nullable|file|mimes:jpeg,png',
        'documentos.*' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx',
    ]);

    // Guardar texto de resolución y fecha de finalización
    $tarea->resolucion_desc = $request->resolucion_desc;
    $tarea->fecha_finalizacion = $request->fecha_finalizacion;
    $tarea->estado = Tarea::estado_Finalizado; // Actualizar estado a 'finalizado'
    $tarea->save();

    // Guardar archivo en la colección 'resoluciones'
    if ($request->hasFile('imagenes')) {
        foreach ($request->file('imagenes') as $imagen) {
            $tarea->addMedia($imagen)->toMediaCollection('imagenes-resoluciones');
        }
    }
    if ($request->hasFile('documentos')) {
        foreach ($request->file('documentos') as $documento) {
            $tarea->addMedia($documento)->toMediaCollection('documentos-resoluciones');
        }
    }
    return redirect()->route('tecnico.tareas.index',$tarea->id)->with('success', 'Resolución guardada correctamente.');
}


public function visualizarResolucion(Tarea $tarea)
{
    // Verificar que el usuario sea auditor
    if (Auth::user()->rol !== 'auditor') {
        abort(403, 'Acceso denegado');
    }
    $user = Auth::user();
    // Cargar la relación con la sede
    $tarea->load('sede');

    return view('auditor.tareas.visualizar', compact('tarea'));

}


public function procesarResolucion(Request $request, Tarea $tarea)
{
    // Verificar que el usuario sea auditor
    if (Auth::user()->rol !== 'auditor') {
        abort(403, 'Acceso denegado');
    }

    $request->validate([
        'observacion' => 'required|string',
        'accion' => 'required|in:validar,rechazar',
    ]);

    if ($request->accion === 'validar') {
        $tarea->estado = Tarea::estado_Validado;
        $tarea->observacion = $request->observacion;
    } elseif ($request->accion === 'rechazar') {
        $tarea->estado = Tarea::estado_Rechazado;
        $tarea->observacion = $request->observacion;
    }

    $tarea->save();

    return redirect()->route('auditor.tareas.finalizadas')->with('success', 'Acción realizada correctamente.');


}



}
