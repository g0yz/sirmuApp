@extends('admin.dashboard')

@section('content')
<div class="container mt-4">
    <h1>Sedes del Sistema</h1>

    <!-- Mensajes de éxito -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('sedes.create') }}" class="btn btn-primary mb-3">Nueva Sede</a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Direccion</th>
                <th>Tipo</th>
                <th>Encargado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($sedes as $sede)
            <tr>
                <td>{{ $sede->id }}</td>
                <td>{{ $sede->nombre ?? '-' }}</td>
                <td>{{ $sede->direccion ?? '-' }}</td>
                <td>{{ $sede->tipo }}</td>
                <td>{{ $sede->encargado_id }}</td>
                <td>
                    <a href="{{ route('sedes.show', $sede) }}" class="btn btn-info btn-sm">Ver</a>
                    <a href="{{ route('sedes.edit', $sede) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('sedes.destroy', $sede) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar Sede?')">Eliminar</button>
                        </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">No hay sedes registradas</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
