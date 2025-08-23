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
    <form method="POST" action="{{route('register')}}">
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
