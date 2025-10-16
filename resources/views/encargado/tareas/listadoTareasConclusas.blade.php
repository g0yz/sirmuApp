@extends('encargado.dashboard')

@section('content')
  <!-- Estilos -->
  <link rel="stylesheet" href="{{ asset('css/filtro-tabla.css') }}">
  <link rel="stylesheet" href="{{ asset('css/index.css') }}">

  <div class="container mt-4">
    <div class="card shadow-sm mb-4 bg-dark">
      <div class="card-body text-center p-3">
        <h3 class="mb-0 text-white">Historial de Tareas Concluidas</h3>
      </div>
    </div>
  </div>

  <div class="container mt-4">
    <!-- Mensajes de éxito -->
    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{route ('encargado.tareas.exportarConclusas')}}" class="btn btn-primary mb-3">Exportar a Excel</a>


    <div class="table-responsive">
      <table class="table table-bordered table-striped table-responsive">
        <thead class="table-dark">
          <tr>
            <th>Título <i class="bi bi-funnel filter-icon" data-col="0"></i></th>
            <th>Técnico <i class="bi bi-funnel filter-icon" data-col="1"></i></th>
            <th>Prioridad <i class="bi bi-funnel filter-icon" data-col="2"></i></th>
            <th>Tipo <i class="bi bi-funnel filter-icon" data-col="3"></i></th>
            <th>Estado <i class="bi bi-funnel filter-icon" data-col="4"></i></th>
            <th>Fecha Estimada <i class="bi bi-funnel filter-icon" data-col="5"></i></th>
            <th>Fecha Finalización <i class="bi bi-funnel filter-icon" data-col="6"></i></th>
          </tr>
        </thead>
        <tbody>
          @forelse($tareasConclusas as $tarea)
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
              <td>{{ $tarea->fecha_finalizacion ?? '-' }}</td>
            </tr>
          @empty
            <tr>
              <td colspan="7" class="text-center">No hay tareas concluidas.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <div class="mt-3 text-center">
    <a href="{{ url()->previous() }}" class="btn btn-secondary">Volver</a> 
  </div>

  <!-- Script del filtro -->
  <script src="{{ asset('js/filtro-tabla.js') }}"></script>
@endsection
