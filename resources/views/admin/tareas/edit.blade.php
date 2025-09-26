 <link rel="stylesheet" href="{{ asset('css/formulario.css') }}">

@extends('admin.dashboard')

@section('content')
<div class="registration-container">
    <div class="registration-form p-4 bg-white rounded shadow-sm">
                <h2 class="h2">Editar Tarea</h2>
        <form method="POST" action="{{ route('admin.tareas.update', $tarea) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <label for="sede_id">Titulo:</label>
            <input type="text" name="titulo" class="form-control mb-2" placeholder="Título de la tarea" required value="{{ $tarea->titulo }}">

            <select name="sede_id" class="form-select mb-2" required>
            <option value="">Seleccione la Sede</option>
            @foreach($sedes as $sede)
            <option value="{{ $sede->id }}">{{ $sede->nombre }}</option>
            @endforeach
            </select>

            <select name="encargado_id" class="form-select mb-2">
            <option value="">Seleccione al Encargado</option>
            @foreach($encargados as $encargado)
            <option value="{{ $encargado->id }}">{{ $encargado->persona->nombre }} {{ $encargado->persona->apellido }}</option>
            @endforeach
            </select>

            <select name="tecnico_id" class="form-select mb-2">
            <option value="">Seleccione al Tecnico</option>
                    @foreach($tecnicos as $tecnico)
            <option value="{{ $tecnico->id }}">{{ $tecnico->persona->nombre }} {{ $tecnico->persona->apellido }}</option>
                    @endforeach
            </select>

            <label for="prioridad">Prioridad:</label>
            <select name="prioridad" class="form-select mb-2" required>
                <option value="alta" @if($tarea->prioridad == 'alta') selected @endif>Alta</option>
                <option value="media" @if($tarea->prioridad == 'media') selected @endif>Media</option>
                <option value="baja" @if($tarea->prioridad == 'baja') selected @endif>Baja</option>
            </select>

            <label for="tipo">Tipo de tarea:</label>
            <select name="tipo" class="form-select mb-2" required>
                <option value="mantenimiento" @if($tarea->tipo == 'mantenimiento') selected @endif>Mantenimiento</option>
                <option value="presupuesto" @if($tarea->tipo == 'presupuesto') selected @endif>Presupuesto</option>
                <option value="instalacion" @if($tarea->tipo == 'instalacion') selected @endif>Instalación</option>
            </select>

            <label for="estado">Estado:</label>
            <select name="estado" class="form-select mb-2" required>
                <option value="pendiente" @if($tarea->estado == 'pendiente') selected @endif>Pendiente</option>
                <option value="finalizada" @if($tarea->estado == 'finalizada') selected @endif>Finalizada</option>
                <option value="validada" @if($tarea->estado == 'validada') selected @endif>Validada</option>
                <option value="rechazada" @if($tarea->estado == 'rechazada') selected @endif>Rechazada</option>
            </select>

            <label for="sede_id">Descripcion:</label>
            <textarea name="descripcion" class="form-control mb-2" rows="3" placeholder="Descripción de la tarea">{{ $tarea->descripcion }}</textarea>

            <label for="fecha_estimada">Fecha estimada:</label>
            <input type="date" name="fecha_estimada" class="form-control mb-2" value="{{ $tarea->fecha_estimada }}">

            <label for="fecha_finalizacion">Fecha finalización:</label>
            <input type="date" name="fecha_finalizacion" class="form-control mb-2" value="{{ $tarea->fecha_finalizacion }}">

            <label for="imagenes">Imágenes:</label>
            <input type="file" name="imagenes[]" class="form-control mb-2" accept="image/*" multiple>

            <label for="documentos">Documentos:</label>
            <input type="file" name="documentos[]" class="form-control mb-2" accept=".pdf,.doc,.docx" multiple>

            <button type="submit" class="registration-btn">Actualizar</button>
        </form>
    </div>
</div>
<div class="mt-3 text-center">
    <a href="{{ url()->previous() }}" class="btn btn-secondary">Volver</a> 
</div>
@endsection
