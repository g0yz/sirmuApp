{{-- resources/views/tareas/show.blade.php --}}
@extends('tecnico.dashboard')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-center">Detalles de la Tarea</h2>

    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="card-title text-primary">{{ $tarea->titulo }}</h5>
            <p><strong>Sede:</strong> {{ $tarea->sede->nombre ?? 'Sin sede' }}</p>
            <p><strong>Tipo:</strong> {{ ucfirst($tarea->tipo) }}</p>
            <p><strong>Prioridad:</strong> {{ ucfirst($tarea->prioridad) }}</p>
            <p><strong>Estado:</strong> {{ ucfirst($tarea->estado) }}</p>
            <p><strong>Encargado:</strong> {{ $tarea->encargado->name ?? 'No asignado' }}</p>
            <p><strong>Fecha estimada:</strong> {{ $tarea->fecha_estimada }}</p>
            <p><strong>Fecha creación:</strong> {{ $tarea->fecha_creacion }}</p>
            <p><strong>Fecha finalización:</strong> {{ $tarea->fecha_finalizacion ?? 'Pendiente' }}</p>
            <p><strong>Descripción:</strong> {{ $tarea->descripcion }}</p>

            <div class="text-center mt-3">
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Volver</a>
            </div>
        </div>
    </div>
</div>
@endsection
