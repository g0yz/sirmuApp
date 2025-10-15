@extends('admin.dashboard')

@section('content')
  <!-- Estilos -->
  <link rel="stylesheet" href="{{ asset('css/filtro-tabla.css') }}">
  <link rel="stylesheet" href="{{ asset('css/index.css') }}">

  <div class="container mt-4">
    <div class="card shadow-sm mb-4 bg-dark">
      <div class="card-body text-center p-3">
        <h3 class="mb-0 text-white">Tareas del Sistema</h3>
      </div>
    </div>
  </div>

  <div class="container mt-4">
    <!-- Mensajes de éxito -->
    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.tareas.create') }}" class="btn btn-primary mb-3">Nueva Tarea</a>

    <div class="table-responsive">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>ID <i class="bi bi-funnel filter-icon" data-col="0"></i></th>
            <th>Sede <i class="bi bi-funnel filter-icon" data-col="1"></i></th>
            <th>Título <i class="bi bi-funnel filter-icon" data-col="2"></i></th>
            <th>Técnico <i class="bi bi-funnel filter-icon" data-col="3"></i></th>
            <th>Prioridad <i class="bi bi-funnel filter-icon" data-col="4"></i></th>
            <th>Tipo <i class="bi bi-funnel filter-icon" data-col="5"></i></th>
            <th>Estado <i class="bi bi-funnel filter-icon" data-col="6"></i></th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          @forelse($tareas as $tarea)
          <tr>
            <td>{{ $tarea->id }}</td>
            <td>{{ $tarea->sede ? $tarea->sede->nombre : '-' }}</td>
            <td>{{ ucfirst($tarea->titulo) }}</td>
            <td>
              {{ $tarea->tecnico && $tarea->tecnico->persona 
                  ? $tarea->tecnico->persona->nombre . ' ' . $tarea->tecnico->persona->apellido 
                  : 'Sin técnico' }}
            </td>
            <td>{{ ucfirst($tarea->prioridad) }}</td>
            <td>{{ ucfirst($tarea->tipo) }}</td>
            <td>{{ ucfirst($tarea->estado) }}</td>
            <td>
              <a href="{{ route('admin.tareas.show', $tarea) }}" class="btn btn-info btn-sm">Ver</a>
              <a href="{{ route('admin.tareas.edit', $tarea) }}" class="btn btn-warning btn-sm">Editar</a>
              <form action="{{ route('admin.tareas.destroy', $tarea) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar Tarea?')">Eliminar</button>
              </form>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="8" class="text-center">No hay tareas registradas</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <!-- Script del filtro -->
  <script src="{{ asset('js/filtro-tabla.js') }}"></script>
@endsection
