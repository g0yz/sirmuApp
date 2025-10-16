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
  <!-- Estilos personalizados -->
  <link rel="stylesheet" href="{{ asset('css\dashboard.css') }}">

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>



<script src="{{ asset('js\app.js')}}" defer ></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.6.0/main.css">

<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.6.0/main.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.6.0/locales-all.js"></script>



<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <!-- Logo / marca -->
    <a class="navbar-brand">Encargado</a>

    <!-- Botón colapsable en móviles -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
      aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Contenido horizontal -->
    <div class="collapse navbar-collapse" id="navbarContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item navSelect">
          <a class="nav-link @if(request()->routeIs('encargado.dashboard')) active @endif" 
          href="{{ route('encargado.dashboard') }}">Inicio</a>
        </li>
        <li class="nav-item navSelect">
          <a class="nav-link @if(request()->routeIs('encargado.tareas.listadoTareas')) active @endif" 
          href="{{ route ('encargado.tareas.listadoTareas') }}">Tareas</a>
        </li>
        <li class="nav-item navSelect">
          <a class="nav-link @if(request()->routeIs('encargado.metricas.proyeccion')) active @endif" 
          href="{{ route ('encargado.metricas.proyeccion') }}">Metricas</a>
        </li>
        <li class="nav-item navSelect">
          <a class="nav-link @if(request()->routeIs('encargado.calendario.index')) active @endif" 
          href="{{ route('encargado.calendario.index') }}">Calendario</a>
        </li>
        <li class="nav-item navSelect">
          <a class="nav-link @if(request()->routeIs('encargado.configuracion')) active @endif" 
          href="{{ route('encargado.configuracion') }}">Configuracion</a>
        </li>
        <li class="nav-item navSelect">
          <a class="nav-link @if(request()->routeIs('encargado.soporteTecnico')) active @endif" 
          href="{{ route('encargado.soporteTecnico') }}">Soporte Tecnico</a>
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
<script src="{{ asset('js\calendario\agenda.js')}}" defer ></script>
</body>     
</html>


@if(request()->routeIs('encargado.dashboard'))
<div class="container mt-4">
    <div class="card shadow-sm mb-4 bg-dark">
        <div class="card-body text-center p-3">
            <h3 class="mb-0 text-white">Inicio</h3>
        </div>
    </div>
</div>
@endif
