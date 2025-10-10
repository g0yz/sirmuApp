@extends('auditor.dashboard')

@section('content')
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

    <table class="table table-bordered table-striped table-responsive">
        <thead class="table-dark">
            <tr>
                <th>Titulo</th>
                <th>Técnico</th>
                <th>Prioridad</th>
                <th>Tipo</th>
                <th>Estado</th>
                <th>Fecha Estimada</th>
                <th>Fecha Finalización</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tareasResueltasGlobales as $tarea)
                <tr>
                    <td>{{ ucfirst($tarea->titulo) }}</td>
                    <td>{{ $tarea->tecnico->persona->nombre ?? $tarea->tecnico->name ?? '-' }}</td>
                    <td>{{ ucfirst($tarea->prioridad) }}</td>
                    <td>{{ ucfirst($tarea->tipo) }}</td>
                    <td>{{ ucfirst($tarea->estado) }}</td>
                    <td>{{ $tarea->fecha_estimada }}</td>
                    <td>{{ $tarea->fecha_finalizacion}}</td>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center">No hay tareas concluidas.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-3 text-center">
    <a href="{{ url()->previous() }}" class="btn btn-secondary">Volver</a> 
</div>
@endsection
