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


<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <!-- Logo / marca -->
    <a class="navbar-brand">Tecnico</a>

    <!-- Botón colapsable en móviles -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
      aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Contenido horizontal -->
    <div class="collapse navbar-collapse" id="navbarContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">

        <li class="nav-item navSelect">
          <a class="nav-link @if(request()->routeIs('tecnico.dashboard')) active @endif" 
          href="{{ route('tecnico.dashboard') }}">Inicio</a>
        </li>

        <li class="nav-item navSelect">
          <a class="nav-link @if(request()->routeIs('tecnico.configuracion')) active @endif" 
          href="{{ route('tecnico.configuracion') }}">Configuracion</a>
        </li>


        <li class="nav-item navSelect">
          <a class="nav-link @if(request()->routeIs('tecnico.soporteTecnico')) active @endif" 
          href="{{ route('tecnico.soporteTecnico') }}">Soporte Tecnico</a>
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



<div class="container mt-4">
    <h2>Próximas tareas asignadas</h2>

    @if($tareasAsignadas->isEmpty())
        <p>No tienes tareas asignadas.</p>
    @else
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Sede</th>
                    <th>Tipo</th>
                    <th>Prioridad</th>
                    <th>Estado</th>
                    <th>Acciones </th>
                </tr>
            </thead>
            <tbody>
                @foreach($tareasAsignadas as $tarea)
                    <tr>
                        <td>{{ $tarea->sede->nombre ?? 'Sin sede' }}</td>
                        <td>{{ ucfirst($tarea->tipo) }}</td>
                        <td>{{ ucfirst($tarea->prioridad) }}</td>
                        <td>{{ ucfirst($tarea->estado) }}</td>
                        <td>
                        <a href="{{ route('tecnico.tareas.show', $tarea->id) }}" class="btn btn-primary btn-sm">Ver</a>
                      </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>


