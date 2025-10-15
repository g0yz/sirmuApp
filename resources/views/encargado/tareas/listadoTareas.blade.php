@extends('encargado.dashboard')

@section('content')
  <!-- Estilos -->
  <link rel="stylesheet" href="{{ asset('css/filtro-tabla.css') }}">
  <link rel="stylesheet" href="{{ asset('css/index.css') }}">

  <div class="container mt-4">
    <div class="card shadow-sm mb-4 bg-dark">
      <div class="card-body text-center p-3">
        <h3 class="mb-0 text-white">Mis Tareas</h3>
      </div>
    </div>
  </div>

  <div class="container mt-4">
    <!-- Mensajes de éxito -->
    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('encargado.tareas.crearTarea') }}" class="btn btn-primary mb-3">Nueva Tarea</a>
    <a href="{{ route ('encargado.tareas.listadoTareasConclusas') }}" class="btn btn-primary mb-3">Historial de Tareas</a>

    <div class="table-responsive">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Título <i class="bi bi-funnel filter-icon" data-col="0"></i></th>
            <th>Técnico <i class="bi bi-funnel filter-icon" data-col="1"></i></th>
            <th>Prioridad <i class="bi bi-funnel filter-icon" data-col="2"></i></th>
            <th>Tipo <i class="bi bi-funnel filter-icon" data-col="3"></i></th>
            <th>Estado <i class="bi bi-funnel filter-icon" data-col="4"></i></th>
            <th>Fecha Estimada <i class="bi bi-funnel filter-icon" data-col="5"></i></th>
            <th>Fecha Finalización <i class="bi bi-funnel filter-icon" data-col="6"></i></th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          @forelse($tareas as $tarea)
          <tr>
            <td>{{ ucfirst($tarea->titulo) }}</td>
            <td>
              {{ $tarea->tecnico && $tarea->tecnico->persona
                  ? $tarea->tecnico->persona->nombre . ' ' . $tarea->tecnico->persona->apellido
                  : ($tarea->tecnico->name ?? '-') }}
            </td>
            <td>{{ ucfirst($tarea->prioridad) }}</td>
            <td>{{ ucfirst($tarea->tipo) }}</td>
            <td>{{ ucfirst($tarea->estado) }}</td>
            <td>{{ $tarea->fecha_estimada }}</td>
            <td>{{ $tarea->fecha_finalizacion ?? 'No asignado' }}</td>
            <td>
              <a href="{{ route('encargado.tareas.verTarea', $tarea) }}" class="btn btn-info btn-sm">Ver</a>
              <a href="{{ route('encargado.tareas.editarTarea', $tarea) }}" class="btn btn-warning btn-sm">Editar</a>
              <form action="{{ route('encargado.tareas.destroy', $tarea) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar Tarea?')">Eliminar</button>
              </form>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="8" class="text-center">No hay tareas creadas.</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <!-- Script del filtro -->
  <script src="{{ asset('js/filtro-tabla.js') }}"></script>
@endsection
