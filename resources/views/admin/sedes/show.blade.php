@extends('admin.dashboard')

@section('content')
  <link rel="stylesheet" href="{{ asset('css/detalle.css') }}">

<div class="container mt-4">
    <div class="card shadow-sm mb-4 bg-dark">
        <div class="card-body text-center p-3">
            <h3 class="mb-0 text-white">Detalle de la Sede</h3>
        </div>
    </div>
</div>


<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-body">
        <div class="row mb-2">
                <div class="col-12 col-md-6">
                    <strong>Nombre:</strong> {{ $sede->nombre}}
                </div>
        </div>
        
        <div class="row mb-2">
                <div class="col-12 col-md-6">
                    <strong>Direccion:</strong> {{ $sede->direccion}}
                </div>
        </div>

        <div class="row mb-2">
                <div class="col-12 col-md-6">
                    <strong>Tipo de Sede:</strong> {{ $sede->tipo}}
                </div>
        </div>

        <div class="row mb-2">
                <div class="col-12 col-md-6">
                    <strong>Encargado:</strong> {{ $sede->encargado && $sede->encargado->persona ? $sede->encargado->persona->nombre . ' ' . $sede->encargado->persona->apellido : 'Sin encargado'}}
                </div>
        </div>

        <div class="row mb-2">
                <div class="col-12 col-md-6">
                    <strong>Capacidad:</strong> {{ $sede->capacidad_estudiantes}}
                </div>
        </div>

        <div class="row mb-2">
                <div class="col-12 col-md-6">
                    <strong>Carreras:</strong> {{ $sede->carreras_ofrecidas}}
                </div>
        </div>
</div>
</div>
</div>

<div class="container mt-4">
    {{-- Card para Imágen --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-dark text-white">
            Imagen de la Sede
        </div>
        <div class="card-body text-center">
            @if($sede->getFirstMedia('imagenes'))
                <img src="{{ $sede->getFirstMediaUrl('imagenes') }}" 
                     alt="Imagen de la sede" 
                     class="img-fluid rounded shadow-sm" 
                     style="max-height: 250px; object-fit: cover;">
            @else
                <p>No hay imagen cargada.</p>
            @endif
        </div>
    </div>
</div>



<div class="mt-3 text-center">
    <a href="{{ url()->previous() }}" class="btn btn-secondary">Volver</a>
</div>

@endsection