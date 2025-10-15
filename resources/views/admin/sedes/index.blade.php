@extends('admin.dashboard')

@section('content')
  <!-- Estilos -->
  <link rel="stylesheet" href="{{ asset('css/filtro-tabla.css') }}">
  <link rel="stylesheet" href="{{ asset('css/index.css') }}">

  <div class="container mt-4">
    <div class="card shadow-sm mb-4 bg-dark">
      <div class="card-body text-center p-3">
        <h3 class="mb-0 text-white">Sedes del Sistema</h3>
      </div>
    </div>
  </div>

  <div class="container mt-4">

    <!-- Mensajes de éxito -->
    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Mensajes de error -->
    @if($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <a href="{{ route('admin.sedes.create') }}" class="btn btn-primary mb-3">Nueva Sede</a>

    <div class="table-responsive">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>ID <i class="bi bi-funnel filter-icon" data-col="0"></i></th>
            <th>Nombre <i class="bi bi-funnel filter-icon" data-col="1"></i></th>
            <th>Dirección <i class="bi bi-funnel filter-icon" data-col="2"></i></th>
            <th>Tipo <i class="bi bi-funnel filter-icon" data-col="3"></i></th>
            <th>Encargado <i class="bi bi-funnel filter-icon" data-col="4"></i></th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          @forelse($sedes as $sede)
          <tr>
            <td>{{ $sede->id }}</td>
            <td>{{ $sede->nombre ?? '-' }}</td>
            <td>{{ $sede->direccion ?? '-' }}</td>
            <td>{{ ucfirst($sede->tipo) }}</td>
            <td>
              {{ $sede->encargado && $sede->encargado->persona 
                  ? $sede->encargado->persona->nombre . ' ' . $sede->encargado->persona->apellido 
                  : 'Sin encargado' }}
            </td>
            <td>
              <a href="{{ route('admin.sedes.show', $sede) }}" class="btn btn-info btn-sm">Ver</a>
              <a href="{{ route('admin.sedes.edit', $sede) }}" class="btn btn-warning btn-sm">Editar</a>
              <form action="{{ route('admin.sedes.destroy', $sede) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar Sede?')">Eliminar</button>
              </form>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="6" class="text-center">No hay sedes registradas</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <!-- Script del filtro -->
  <script src="{{ asset('js/filtro-tabla.js') }}"></script>
@endsection
