<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Inicio de Sesion</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
   <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Estilos personalizados -->
  <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
  <!-- Header -->
  <div class="header">
    <div>SIRMU</div>
    <div>Inicio de Sesion</div>
  </div>

  <!-- Formulario centrado -->
  <div class="login-container">
    <div class="login-form">
      <form method="POST" action="{{ route('login') }}">
        @csrf
        <input type="email" class="form-control" placeholder="Correo Electronico" required name="email">
        <input type="password" class="form-control" placeholder="Contraseña" required name="password">
        <label>
        <input type="checkbox" name="remember"> Recordarme
        </label>
        <a href="#" class="forgot">¿Olvidaste tu contraseña?</a>
        <button type="submit" class="login-btn">Iniciar Sesion</button>
      </form>
    </div>
  </div>


      @if ($errors->any())
    <div class="alerta-error">
      <i class="bi bi-exclamation-triangle "></i>
        <span>{{  $errors->first() }}</span>
    </div>
    @endif

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
