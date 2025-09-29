@extends('tecnico.dashboard')

@section('content')

 <link rel="stylesheet" href="{{ asset('css/index.css') }}">


<div class="container mt-4">
    <div class="card shadow-sm mb-4 bg-dark">
        <div class="card-body text-center p-3">
            <h3 class="mb-0 text-white">Tareas Asignadas</h3>
        </div>
    </div>
</div>


<div class="container mt-4">

      <!-- Mensajes de éxito -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    @if($tareasAsignadas->isEmpty())
        <p>No tienes tareas asignadas.</p>
    @else
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Sede</th>
                    <th>Tipo</th>
                    <th>Prioridad</th>
                    <th>Estado</th>
                    <th>Acciones </th>
                </tr>
            </thead>
            <tbody>
                @foreach($tareasAsignadas as $tarea)
                    <tr>
                        <td>{{ $tarea->sede->nombre ?? 'Sin sede' }}</td>
                        <td>{{ ucfirst($tarea->tipo) }}</td>
                        <td>{{ ucfirst($tarea->prioridad) }}</td>
                        <td>{{ ucfirst($tarea->estado) }}</td>
                        <td>
                        <a href="{{ route('tecnico.tareas.show', $tarea->id) }}" class="btn btn-primary btn-sm">Informacion Tarea</a>
                        <a href="{{ route('tecnico.tareas.resolucion', $tarea->id) }}" class="btn btn-primary btn-sm">Finalizar Tarea</a>
                      </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection