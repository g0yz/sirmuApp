@extends('auditor.dashboard')

@section('content')
  <!-- Estilos -->
  <link rel="stylesheet" href="{{ asset('css/filtro-tabla.css') }}">
  <link rel="stylesheet" href="{{ asset('css/index.css') }}">

  <div class="container mt-4">
    <div class="card shadow-sm mb-4 bg-dark">
      <div class="card-body text-center p-3">
        <h3 class="mb-0 text-white">Listado de Tareas Finalizadas</h3>
      </div>
    </div>
  </div>

  <div class="container mt-4">
    <!-- Mensajes de éxito -->
    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Título <i class="bi bi-funnel filter-icon" data-col="0"></i></th>
            <th>Sede <i class="bi bi-funnel filter-icon" data-col="1"></i></th>
            <th>Encargado <i class="bi bi-funnel filter-icon" data-col="2"></i></th>
            <th>Técnico <i class="bi bi-funnel filter-icon" data-col="3"></i></th>
            <th>Tipo <i class="bi bi-funnel filter-icon" data-col="4"></i></th>
            <th>Acción</th>
          </tr>
        </thead>
        <tbody>
          @forelse($tareasFinalizadas as $tarea)
          <tr>
            <td>{{ $tarea->titulo ?? '-' }}</td>
            <td>{{ $tarea->sede ? $tarea->sede->nombre : '-' }}</td>
            <td>
              {{ $tarea->encargado && $tarea->encargado->persona 
                  ? $tarea->encargado->persona->nombre . ' ' . $tarea->encargado->persona->apellido 
                  : ($tarea->encargado ? $tarea->encargado->email : '-') }}
            </td>
            <td>
              {{ $tarea->tecnico && $tarea->tecnico->persona 
                  ? $tarea->tecnico->persona->nombre . ' ' . $tarea->tecnico->persona->apellido 
                  : ($tarea->tecnico ? $tarea->tecnico->email : '-') }}
            </td>
            <td>{{ ucfirst($tarea->tipo) }}</td>
            <td>
              <a href="{{ route('auditor.tareas.visualizar', $tarea->id) }}" class="btn btn-info btn-sm">Visualizar</a>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="6" class="text-center">No hay tareas registradas en el sistema</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <!-- Script del filtro -->
  <script src="{{ asset('js/filtro-tabla.js') }}"></script>
@endsection