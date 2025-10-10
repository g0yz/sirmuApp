@extends('encargado.dashboard')

@section('content')
 <link rel="stylesheet" href="{{ asset('css/index.css') }}">


<div class="container mt-4">
    <div class="card shadow-sm mb-4 bg-dark">
        <div class="card-body text-center p-3">
            <h3 class="mb-0 text-white">Mis Tareas (En curso)</h3>
        </div>
    </div>
</div>



<div class="container mt-4">
    <!-- Mensajes de éxito -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('encargado.tareas.crearTarea') }}" class="btn btn-primary mb-3">Nueva Tarea</a>
    <a href="{{ route ('encargado.tareas.listadoTareasConclusas') }}" class="btn btn-primary mb-3">Historial de Tareas</a>

    <table class="table table-bordered table-striped table-responsive">
        <thead class="table-dark">
            <tr>
                <th>Titulo</th>
                <th>Técnico</th>
                <th>Prioridad</th>
                <th>Tipo</th>
                <th>Estado</th>
                <th>Fecha Estimada</th>
                <th>Fecha Finalización</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tareas as $tarea)
                <tr>
                    <td>{{ ucfirst($tarea->titulo) }}</td>
                    <td>{{ $tarea->tecnico->persona->nombre ?? $tarea->tecnico->name ?? '-' }}</td>
                    <td>{{ ucfirst($tarea->prioridad) }}</td>
                    <td>{{ ucfirst($tarea->tipo) }}</td>
                    <td>{{ ucfirst($tarea->estado) }}</td>
                    <td>{{ $tarea->fecha_estimada }}</td>
                    <td>{{ $tarea->fecha_finalizacion ?? 'no asignado' }}</td>
                    <td>
                        <a href="{{ route ('encargado.tareas.verTarea', $tarea) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route ('encargado.tareas.editarTarea', $tarea) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('encargado.tareas.destroy', $tarea) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar Tarea?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center">No hay tareas creadas.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
