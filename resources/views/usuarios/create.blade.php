 <link rel="stylesheet" href="{{ asset('css/register.css') }}">

@extends('admin.dashboard')

@section('content')

  <!-- Formulario centrado -->
<div class="registration-container">
  <div class="registration-form">
    <h2 class="h2">Ingresar Datos Del Usuario</h2>
    <form method="POST" action="{{route('usuarios.store')}}">
      @csrf
      <input type="email" name="email" class="form-control mb-2" placeholder="Correo electrónico" required>
      <input type="password" name="password" class="form-control mb-2" placeholder="Contraseña" required>
      <input type="password" name="password_confirmation" class="form-control mb-2" placeholder="Confirmar Contraseña" required>
      <input type="text" name="nombre" class="form-control mb-2" placeholder="Nombre" required>
      <input type="text" name="apellido" class="form-control mb-2" placeholder="Apellido" required>
      <label for="opciones">Rol del Usuario:</label>
      <select name="rol" class="form-select form-select-sm-2">
      <option value="administrador">Administrador</option>
      <option value="tecnico">Tecnico</option>
      <option value="encargado">Encargado</option>
      <option value="auditor">Auditor</option>
      </select>
      <button type="submit" class="registration-btn">Registrarse</button>
    </form>
  </div>
</div>

@endsection