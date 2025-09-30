<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registro</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Estilos personalizados -->
 <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>
<body>
  <!-- Header -->
  <div class="header">
    <div>SIRMU</div>
    <div>Registro de Usuario</div>
  </div>

  <!-- Formulario centrado -->
<div class="registration-container">
  <div class="registration-form">
    <h2 class="h2">Ingresar Datos</h2>

    <form method="POST" action="{{ route('register') }}">
      @csrf

      <input type="email" name="email" id="email" 
             class="form-control mb-2" 
             placeholder="Correo electrónico" 
             value="{{ old('email') }}" required>
      @error('email')
        <div class="text-danger small">{{ $message }}</div>
      @enderror

      <input type="password" name="password" id="password" 
             class="form-control mb-2" 
             placeholder="Contraseña" 
             required>
      @error('password')
        <div class="text-danger small">{{ $message }}</div>
      @enderror

      <input type="password" name="password_confirmation" id="password_confirmation" class="form-control mb-2" placeholder="Confirmar Contraseña" required>

      <input type="text" name="nombre" id="nombre" class="form-control mb-2" placeholder="Nombre" required>
      <input type="text" name="apellido" id="apellido" class="form-control mb-2" placeholder="Apellido" required>

      <label for="opciones">Rol del Usuario:</label>
      <select name="rol" id="rol" class="form-select form-select-sm-2 mb-3">
        <option value="administrador">Administrador</option>
        <option value="tecnico">Técnico</option>
        <option value="encargado">Encargado</option>
        <option value="auditor">Auditor</option>
      </select>

      @error('rol')
        <div class="text-danger small">{{ $message }}</div>
      @enderror

      <button type="submit" class="registration-btn">Registrarse</button>
    </form>
  </div>
</div>

  <!-- Footer -->
  <div class="footer">
    <div>
      <span class="circle-icon"><i class="bi bi-telephone-fill"></i></span>
      NumeroSoporteTecnico
    </div>
    <div>
      <span class="circle-icon"><i class="bi bi-envelope-fill"></i></span>
      correoSoporteTecnico
    </div>
  </div>

</body>
</html>
