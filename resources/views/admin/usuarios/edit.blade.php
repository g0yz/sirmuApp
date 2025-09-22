 <link rel="stylesheet" href="{{ asset('css/register.css') }}">

@extends('admin.dashboard')

@section('content')

<div class="registration-container">
    <div class="registration-form p-4 bg-white rounded shadow-sm">
        <h2 class="h2">Editar Usuario</h2>
        <form method="POST" action="{{ route('admin.usuarios.update', $user) }}">
            @csrf
            @method('PUT')
            <label for="opciones">Email:</label>
            <input type="email" name="email" class="form-control mb-2" placeholder="Correo electrónico" required value="{{ $user->email }}">
            <label for="opciones">Nombre:</label>
            <input type="text" name="nombre" class="form-control mb-2" placeholder="Nombre" required value="{{ $user->persona->nombre }}">
            <label for="opciones">Apellido:</label>
            <input type="text" name="apellido" class="form-control mb-2" placeholder="Apellido" required value="{{ $user->persona->apellido }}">
            <input type="password" name="password" class="form-control mb-2" placeholder="Nueva Contraseña (opcional)">
            <input type="password" name="password_confirmation" class="form-control mb-2" placeholder="Confirmar Nueva Contraseña">
            <label for="opciones">Rol del Usuario:</label>
            <select name="rol" class="form-select form-select-sm-2">
                <option value="administrador" @if($user->rol == 'administrador') selected @endif>Administrador</option>
                <option value="tecnico" @if($user->rol == 'tecnico') selected @endif>Tecnico</option>
                <option value="encargado" @if($user->rol == 'encargado') selected @endif>Encargado</option>
                <option value="auditor" @if($user->rol == 'auditor') selected @endif>Auditor</option>
            </select>
            <button type="submit" class="registration-btn">Actualizar</button>
        </form>
    </div>
</div>
<div class="mt-3 text-center">
    <a href="{{ url()->previous() }}" class="btn btn-secondary">Volver</a> 
</div>
@endsection