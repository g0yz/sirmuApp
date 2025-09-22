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
  <link rel="stylesheet" href="{{ asset('css\dashboard.css') }}">


<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <!-- Logo / marca -->
    <a class="navbar-brand">Auditor</a>

    <!-- Botón colapsable en móviles -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
      aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Contenido horizontal -->
    <div class="collapse navbar-collapse" id="navbarContent">@yield('nav')
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">

        <li class="nav-item navSelect">
          <a class="nav-link @if(request()->routeIs('auditor.dashboard')) active @endif" 
          href="{{ route('auditor.dashboard') }}">Inicio</a>
        </li>

        <li class="nav-item navSelect">
          <a class="nav-link @if(request()->routeIs('auditor.tareas.finalizadas')) active @endif" 
          href="{{ route('auditor.tareas.finalizadas') }}">Tareas</a>
        </li>

        <li class="nav-item navSelect">
          <a class="nav-link @if(request()->routeIs('auditor.sedes.listadoSedes')) active @endif" 
          href="{{ route('auditor.sedes.listadoSedes') }}">Sedes</a>
        </li>

        <li class="nav-item navSelect">
          <a class="nav-link @if(request()->routeIs('auditor.configuracion')) active @endif" 
          href="{{ route('auditor.configuracion') }}">Configuracion</a>
        </li>

        <li class="nav-item navSelect">
          <a class="nav-link @if(request()->routeIs('auditor.soporteTecnico')) active @endif" 
          href="{{ route('auditor.soporteTecnico') }}">Soporte Tecnico</a>
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

@if(request()->routeIs('auditor.dashboard'))
<div class="container mt-4">
    <div class="card shadow-sm mb-4 bg-dark">
        <div class="card-body text-center p-3">
            <h3 class="mb-0 text-white">Inicio</h3>
        </div>
    </div>
</div>
@endif