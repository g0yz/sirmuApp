<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pagina Principal</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Estilos personalizados -->
  <link rel="stylesheet" href="{{ asset('css\dashboard.css') }}">


<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <!-- Logo / marca -->
    <a class="navbar-brand">{{ucfirst(Auth::user()->rol)}}</a>
    <!-- Botón colapsable en móviles -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
            aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>
    <!-- Contenido horizontal -->
            <div class="collapse navbar-collapse" id="navbarContent">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                  @if(Auth::user()->rol === 'administrador')
                    <a class="nav-link active" href="{{ route('admin.dashboard') }}">Inicio</a>
                  @elseif(Auth::user()->rol === 'auditor')
                    <a class="nav-link active" href="{{ route('auditor.dashboard') }}">Inicio</a>
                  @elseif(Auth::user()->rol === 'encargado')
                    <a class="nav-link active" href="{{ route('encargado.dashboard') }}">Inicio</a>
                  @elseif(Auth::user()->rol === 'tecnico')
                    <a class="nav-link active" href="{{ route('tecnico.dashboard') }}">Inicio</a>
                  @endif
                </li>
                <li class="nav-item">
                  <a class="nav-link active" href="#">Sedes</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" href="#">Tareas</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" href="#">Usuarios</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" href="#">Configuración</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link disabled">Soporte Técnico</a>
                </li>
              </ul>     
      <!-- Botón de logout a la derecha -->
      <form action="{{ route('logout') }}" method="POST" class="d-flex">
        @csrf
        <button type="submit" class="btn btn-danger">Cerrar sesión</button>
      </form>
    </div>
  </div>
</nav>

</div>
<body>     
</html>



