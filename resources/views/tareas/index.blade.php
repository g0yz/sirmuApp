@extends('admin.dashboard')

@section('content')
<div class="container mt-4">
    <h1>Tareas del Sistema</h1>

    <!-- Mensajes de éxito -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('tareas.create') }}" class="btn btn-primary mb-3">Nueva Tarea</a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Sede</th>
                <th>Encargado</th>
                <th>Técnico</th>
                <th>Prioridad</th>
                <th>Tipo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tareas as $tarea)
            <tr>
                <td>{{ $tarea->id }}</td>
                <td>{{ $tarea->sede ? $tarea->sede->nombre : '-' }}</td>
                <td>{{ $tarea->encargado ? $tarea->encargado->email : '-' }}</td>
                <td>{{ $tarea->tecnico ? $tarea->tecnico->email : '-' }}</td>
                <td>{{ ucfirst($tarea->prioridad) }}</td>
                <td>{{ ucfirst($tarea->tipo) }}</td>
                <td>
                    <a href="{{ route('tareas.show', $tarea) }}" class="btn btn-info btn-sm">Ver</a>
                    <a href="{{ route('tareas.edit', $tarea) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('tareas.destroy', $tarea) }}" method="POST" style="display:inline;">
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
