@extends('admin.dashboard')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-center">Detalles de la Tarea</h2>

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
                <div class="col-12 col-md-6"><strong>Encargado:</strong> {{ $tarea->encargado->name ?? 'No asignado' }}</div>
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

            <div class="mt-3 text-center">
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Volver</a>
            </div>
        </div>
    </div>
</div>
@endsection
