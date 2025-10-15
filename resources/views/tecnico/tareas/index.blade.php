@extends('tecnico.dashboard')

@section('content')
  <!-- Estilos -->
  <link rel="stylesheet" href="{{ asset('css/filtro-tabla.css') }}">
  <link rel="stylesheet" href="{{ asset('css/index.css') }}">

  <div class="container mt-4">
    <div class="card shadow-sm mb-4 bg-dark">
      <div class="card-body text-center p-3">
        <h3 class="mb-0 text-white">Tareas Asignadas</h3>
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
            <th>Sede <i class="bi bi-funnel filter-icon" data-col="0"></i></th>
            <th>Tipo <i class="bi bi-funnel filter-icon" data-col="1"></i></th>
            <th>Prioridad <i class="bi bi-funnel filter-icon" data-col="2"></i></th>
            <th>Estado <i class="bi bi-funnel filter-icon" data-col="3"></i></th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          @if($tareasAsignadas->isEmpty())
            <tr>
              <td colspan="5" class="text-center text-muted py-3">
                No tienes tareas asignadas.
              </td>
            </tr>
          @else
            @foreach($tareasAsignadas as $tarea)
              <tr>
                <td>{{ $tarea->sede->nombre ?? 'Sin sede' }}</td>
                <td>{{ ucfirst($tarea->tipo) }}</td>
                <td>{{ ucfirst($tarea->prioridad) }}</td>
                <td>{{ ucfirst($tarea->estado) }}</td>
                <td>
                  <a href="{{ route('tecnico.tareas.show', $tarea->id) }}" class="btn btn-primary btn-sm">Información</a>
                  <a href="{{ route('tecnico.tareas.resolucion', $tarea->id) }}" class="btn btn-primary btn-sm">Finalizar</a>
                </td>
              </tr>
            @endforeach
          @endif
        </tbody>
      </table>
    </div>
  </div>

  <!-- Script del filtro -->
  <script src="{{ asset('js/filtro-tabla.js') }}"></script>
@endsection