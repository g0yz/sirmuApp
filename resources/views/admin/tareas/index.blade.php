@extends('admin.dashboard')

@section('content')

 <link rel="stylesheet" href="{{ asset('css/index.css') }}">


<div class="container mt-4">
    <div class="card shadow-sm mb-4 bg-dark">
        <div class="card-body text-center p-3">
            <h3 class="mb-0 text-white">Tareas del Sistema</h3>
        </div>
    </div>
</div>


<div class="container mt-4">
    <!-- Mensajes de éxito -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.tareas.create') }}" class="btn btn-primary mb-3">Nueva Tarea</a>

    <table class="table table-bordered table-responsive table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Sede</th>
                <th>Título</th>
                <th>Técnico</th>
                <th>Prioridad</th>
                <th>Tipo</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tareas as $tarea)
            <tr>
                <td>{{ $tarea->id }}</td>
                <td>{{ $tarea->sede ? $tarea->sede->nombre : '-' }}</td>
                <td>{{ ucfirst($tarea->titulo) }}</td>
                <td>{{ $tarea->tecnico && $tarea->tecnico->persona ? $tarea->tecnico->persona->nombre . ' ' . $tarea->tecnico->persona->apellido : 'Sin tecnico'}}</td>
                <td>{{ ucfirst($tarea->tipo) }}</td>
                <td>{{ ucfirst($tarea->prioridad) }}</td>
                <td>{{ ucfirst($tarea->estado) }}</td>
                <td>
                    <a href="{{ route('admin.tareas.show', $tarea) }}" class="btn btn-info btn-sm">Ver</a>
                    <a href="{{ route('admin.tareas.edit', $tarea) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('admin.tareas.destroy', $tarea) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar Tarea?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="10" class="text-center">No hay tareas registradas</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
