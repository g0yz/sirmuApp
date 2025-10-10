
@extends('auditor.dashboard')

@section('content')

 <link rel="stylesheet" href="{{ asset('css/detalle.css') }}">





<div class="container mt-4">
    <div class="card shadow-sm">
                <div class="card-header bg-dark text-white">
                 Descripcion de la Tarea
                </div>
                    <div class="card-body">
                        <div class="row mb-2">
                    <div class="col-12 col-md-6">
                        {{ $tarea->descripcion}}
                </div>
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
                            <img src="{{ $imagen->getUrl() }}" class="card-img-top" alt="{{ $imagen->file_name }}">
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
            Documentos
        </div>
        <div class="card-body">
            @if($tarea->getMedia('documentos')->isEmpty())
                <p>No hay documentos cargados.</p>
            @else
                <div class="row">
                    @foreach($tarea->getMedia('documentos') as $documento)
                        <div class="col-md-3 mb-3">
                            <div class="card">
                                <div class="card-body p-2 text-truncate">
                                    <a href="{{ $documento->getUrl() }}" target="_blank">{{ $documento->file_name }}</a>
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
    <div class="card shadow-sm">
                <div class="card-header bg-dark text-white">
                 Descripcion de Resolucion
                </div>
                    <div class="card-body">
                        <div class="row mb-2">
                    <div class="col-12 col-md-6">
                        {{ $tarea->resolucion_desc}}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mt-4">
    {{-- Card para Imágenes resolucion --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-dark text-white">
            Imágenes de la resolucion
        </div>
        <div class="card-body">
            @if($tarea->getMedia('imagenes-resoluciones')->isEmpty())
                <p>No hay imágenes de la resolcion cargadas.</p>
            @else
                <div class="row">
                    @foreach($tarea->getMedia('imagenes-resoluciones') as $imagen)
                        <div class="col-md-3 mb-3">
                            <div class="card">
                                <img src="{{ $imagen->getUrl() }}" class="card-img-top" alt="{{ $imagen->file_name }}">
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
    {{-- Card para Documentos resolucion --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-dark text-white">
            Imágenes de la resolucion
        </div>
        <div class="card-body">
            @if($tarea->getMedia('documentos-resoluciones')->isEmpty())
                <p>No hay imágenes de la resolcion cargadas.</p>
            @else
                <div class="row">
                    @foreach($tarea->getMedia('documentos-resoluciones') as $imagen)
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
    
<div class="registration-container">
    
  <div class="registration-form p-4 bg-white rounded shadow-sm">

<form method="POST" action="{{route('auditor.tareas.procesarResolucion' , $tarea->id)}}" enctype="multipart/form-data">
    @csrf

    <label>Fecha de Observacion:</label>
    <input type="text" id="fecha_observacion" name="fecha_observacion" class="form-control form-control-sm w-auto"
    value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" readonly>

    <label for="observacion">Observación:</label>
    <input type="text" name="observacion" class="form-control mb-2" required>

    <!-- Botones de acción -->
    <button type="submit" name="accion" value="validar" class="btn btn-success">Validar</button>
    <button type="submit" name="accion" value="rechazar" class="btn btn-danger">Rechazar</button>
</form>
</div>
</div>
</div>



<div class="text-center mt-3">
    <a href="{{ url()->previous() }}" class="btn btn-secondary">Volver</a>
</div>

@endsection
