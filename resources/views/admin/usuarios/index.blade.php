@extends('admin.dashboard')

@section('content')


<div class="container mt-4">
    <div class="card shadow-sm mb-4 bg-dark">
        <div class="card-body text-center p-3">
            <h3 class="mb-0 text-white">Usuarios Del Sistema</h3>
        </div>
    </div>
</div>

<div class="container mt-4">
    <!-- Mensajes de éxito -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.usuarios.create') }}" class="btn btn-primary mb-3">Nuevo Usuario</a>

    <table class="table table-bordered table-responsive table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Rol</th>
                <th>Email</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->persona->nombre ?? '-' }}</td>
                <td>{{ $user->persona->apellido ?? '-' }}</td>
                <td>{{ $user->rol }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <a href="{{ route('admin.usuarios.show', $user) }}" class="btn btn-info btn-sm">Ver</a>
                    <a href="{{ route('admin.usuarios.edit', $user) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('admin.usuarios.destroy', $user) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar usuario?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">No hay usuarios registrados</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
