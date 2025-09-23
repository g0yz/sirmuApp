
@extends('tecnico.dashboard')

@section('content')

  <link rel="stylesheet" href="{{ asset('css/detalle.css') }}">


<div class="container mt-4">
    <div class="card shadow-sm mb-4 bg-dark">
        <div class="card-body text-center p-3">
            <h3 class="mb-0 text-white">Detalle de la Tarea</h2>
        </div>
    </div>
</div>

<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <p><strong>Titulo:</strong> {{ $tarea->titulo ?? 'Sin Titulo' }}</p>
            <p><strong>Sede:</strong> {{ $tarea->sede->nombre ?? 'Sin sede' }}</p>
            <p><strong>Tipo:</strong> {{ ucfirst($tarea->tipo) }}</p>
            <p><strong>Prioridad:</strong> {{ ucfirst($tarea->prioridad) }}</p>
            <p><strong>Estado:</strong> {{ ucfirst($tarea->estado) }}</p>
            <p><strong>Encargado:</strong> {{ $tarea->encargado->name ?? 'No asignado' }}</p>
            <p><strong>Fecha estimada:</strong> {{ $tarea->fecha_estimada }}</p>
            <p><strong>Fecha creación:</strong> {{ $tarea->fecha_creacion }}</p>
            <p><strong>Fecha finalización:</strong> {{ $tarea->fecha_finalizacion ?? 'Pendiente' }}</p>
            <p><strong>Descripción:</strong> {{ $tarea->descripcion }}</p>
        </div>
    </div>
</div>


<div class="container mt-4">
    {{-- Card para Imágenes --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-dark text-white">
            Imágenes
        </div>
        <div class="card-body">
            @if($tarea->getMedia('imagenes')->isEmpty())
                <p>No hay imágenes cargadas.</p>
            @else
                <div class="row">
                    @foreach($tarea->getMedia('imagenes') as $imagen)
                        <div class="col-md-3 mb-3">
                            <div class="card">
                                <div class="card-body p-2 text-truncate">
                                    <a href="{{ $imagen->getUrl() }}" target="_blank">{{ $imagen->file_name }}</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>


<div class="container mt-4">
    {{-- Card para Documentos --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-dark text-white">
            Archivos
        </div>
        <div class="card-body">
            @if($tarea->getMedia('documentos')->isEmpty())
                <p>No hay archivos cargados.</p>
            @else
                <div class="row">
                    @foreach($tarea->getMedia('documentos') as $doc)
                        <div class="col-md-3 mb-3">
                            <div class="card">
                                <div class="card-body p-2 text-truncate">
                                    <a href="{{ $doc->getUrl() }}" target="_blank">{{ $doc->file_name }}</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>


<div class="text-center mt-3">
    <a href="{{ url()->previous() }}" class="btn btn-secondary">Volver</a>
</div>
@endsection
