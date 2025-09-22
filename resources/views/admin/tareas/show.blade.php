@extends('admin.dashboard')

@section('content')


<div class="container mt-4">
    <div class="card shadow-sm mb-4 bg-dark">
        <div class="card-body text-center p-3">
            <h3 class="mb-0 text-white">Detalle de la Tarea</h3>
        </div>
    </div>
</div>

<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-body">

            <div class="row mb-2">
                <div class="col-12 col-md-6"><strong>Titulo:</strong> {{ $tarea->titulo ?? 'Sin nombre' }}</div>
            </div>
            
            <div class="row mb-2">
                <div class="col-12 col-md-6"><strong>Sede:</strong> {{ $tarea->sede->nombre ?? 'Sin sede' }}</div>
            </div>

             <div class="row mb-2">
                <div class="col-12 col-md-6"><strong>Tipo:</strong> {{ ucfirst($tarea->tipo) }}</div>
            </div>

            <div class="row mb-2">
                <div class="col-12 col-md-6"><strong>Prioridad:</strong> {{ ucfirst($tarea->prioridad) }}</div>
            </div>

            <div class="row mb-2">
                <div class="col-12 col-md-6"><strong>Estado:</strong> {{ ucfirst($tarea->estado) }}</div>
            </div>
            
            <div class="row mb-2">
                <div class="col-12 col-md-6"><strong>Encargado:</strong> {{ $tarea->encargado->id ?? 'No asignado' }}</div>
            </div>

            <div class="row mb-2">
                <div class="col-12 col-md-6"><strong>Tencnico Asignado:</strong> {{ $tarea->tecnico->id ?? 'No asignado' }}</div>
            </div>

            <div class="row mb-2">
                <div class="col-12 col-md-6"><strong>Fecha estimada:</strong> {{ $tarea->fecha_estimada }}</div>
            </div>

            <div class="row mb-2">
                <div class="col-12 col-md-6"><strong>Fecha creación:</strong> {{ $tarea->fecha_creacion }}</div>
            </div>

            <div class="row mb-2">
                <div class="col-12 col-md-6"><strong>Fecha finalización:</strong> {{ $tarea->fecha_finalizacion ?? 'Pendiente' }}</div>
            </div>

            <div class="row mb-2">
                <div class="col-12"><strong>Descripción:</strong> {{ $tarea->descripcion }}</div>
            </div>
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
<div class="mt-3 text-center">
    <a href="{{ url()->previous() }}" class="btn btn-secondary">Volver</a> 
</div>
@endsection
