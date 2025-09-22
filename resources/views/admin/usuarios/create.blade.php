<link rel="stylesheet" href="{{ asset('css/register.css') }}">

@extends('admin.dashboard')

@section('content')

  <!-- Formulario centrado -->
<div class="registration-container">
  <div class="registration-form p-4 bg-white rounded shadow-sm">
    <h2 class="h2">Ingresar Usuario</h2>
    <form method="POST" action="{{route('admin.usuarios.store')}}">
      @csrf
      <label for="text">Correo Electronico:</label>
      <input type="email" name="email" class="form-control mb-2" required>
      <label for="text">Constraseña:</label>
      <input type="password" name="password" class="form-control mb-2" required>
      <label for="text">Confirmar Constraseña:</label>
      <input type="password" name="password_confirmation" class="form-control mb-2" required>
      <label for="text">Nombre:</label>
      <input type="text" name="nombre" class="form-control mb-2" required>
      <label for="text">Apellido:</label>
      <input type="text" name="apellido" class="form-control mb-2" placeholder="Apellido" required>
      <label for="opciones">Rol del Usuario:</label>
      <select name="rol" class="form-select form-select-sm-2">
      <option value="administrador">Administrador</option>
      <option value="tecnico">Tecnico</option>
      <option value="encargado">Encargado</option>
      <option value="auditor">Auditor</option>
      </select>
      <button type="submit" class="registration-btn">Registrar</button>
    </form>
  </div>
</div>
<div class="mt-3 text-center">
    <a href="{{ url()->previous() }}" class="btn btn-secondary">Volver</a> 
</div>
@endsection