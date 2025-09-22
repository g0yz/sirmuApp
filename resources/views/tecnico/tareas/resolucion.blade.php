@extends('tecnico.dashboard')

@section('content')
<div class="container">
    <h2>Resolución de Tarea: {{ $tarea->titulo }}</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('tecnico.tareas.guardarResolucion', $tarea->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Fecha actual --}}
        <div class="mb-3">
            <label for="fecha" class="form-label">Fecha de Finalizacion:</label>
            <input type="text" id="fecha" class="form-control form-control-sm w-auto" 
            value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" readonly>
        </div>

        {{-- Resolución (comentario) --}}
        <div class="mb-3">
            <label for="resolucion_texto" class="form-label">Descripción de la resolución:</label>
            <textarea name="resolucion_texto" id="resolucion_texto" class="form-control" rows="4" required>{{ old('resolucion_texto') }}</textarea>
            @error('resolucion_texto')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        {{-- Subida de archivos --}}
        <div class="mb-3">
            <label for="resolucion" class="form-label">Adjuntar archivos:</label>
            <input type="file" name="resolucion" id="resolucion" class="form-control" accept=".pdf,.doc,.docx" required>
            @error('resolucion')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Enviar resolución</button>
        <a href="{{ route('tecnico.tareas.index')}}" class="btn btn-secondary">Volver</a>
    </form>

    {{-- Mostrar archivos existentes --}}
    @if($tarea->listarArchivos('resoluciones')->count())
        <h4 class="mt-4">Archivos subidos:</h4>
        <ul>
            @foreach($tarea->listarArchivos('resoluciones') as $archivo)
                <li><a href="{{ $archivo->getUrl() }}" target="_blank">{{ $archivo->file_name }}</a></li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
