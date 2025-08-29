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
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <!-- Logo / marca -->
    <a class="navbar-brand">Administrador</a>
    <!-- Botón colapsable en móviles -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
            aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>
    <!-- Contenido horizontal -->
            <div class="collapse navbar-collapse" id="navbarContent">@yield('nav')
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item navSelect">
                  <a class="nav-link active" href="{{route('admin.dashboard')}}" >Inicio</a>        
                </li>
                <li class="nav-item navSelect">
                  <a class="nav-link " href="#">Sedes</a>
                </li>
                <li class="nav-item navSelect">
                  <a class="nav-link " href="#">Tareas</a>
                </li>
                <li class="nav-item navSelect">
                  <a class="nav-link " href="{{route('usuarios.index')}}">Usuarios</a>
                </li>
                <li class="nav-item navSelect">
                  <a class="nav-link " href="#">Configuración</a>
                </li>
                <li class="nav-item navSelect">
                  <a class="nav-link " href="#">Soporte Técnico</a>
                </li>
              </ul>     
      <!-- Botón de logout a la derecha -->
      <form action="{{ route('logout') }}" method="POST" class="cerrarSesion">
        @csrf
        <button type="submit" class="btn btn-danger">Cerrar sesión</button>
      </form>
    </div>
  </div>
</nav>
@yield('content')
</body>     
</html>



