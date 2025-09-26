@extends('admin.dashboard')

@section('content')
 <link rel="stylesheet" href="{{ asset('css/index.css') }}">

<div class="container mt-4">
    <div class="card shadow-sm mb-4 bg-dark">
        <div class="card-body text-center p-3">
            <h3 class="mb-0 text-white">Sedes del Sistema</h3>
        </div>
    </div>
</div>


<div class="container mt-4">

    <!-- Mensajes de éxito -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.sedes.create') }}" class="btn btn-primary mb-3">Nueva Sede</a>

    <table class="table table-bordered table-responsive table-striped">
        <thead class="table-dark">
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
                <td>{{ $sede->encargado && $sede->encargado->persona ? $sede->encargado->persona->nombre . ' ' . $sede->encargado->persona->apellido : 'Sin encargado'}}</td>
                <td>
                    <a href="{{ route('admin.sedes.show', $sede) }}" class="btn btn-info btn-sm">Ver</a>
                    <a href="{{ route('admin.sedes.edit', $sede) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('admin.sedes.destroy', $sede) }}" method="POST" style="display:inline;">
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
