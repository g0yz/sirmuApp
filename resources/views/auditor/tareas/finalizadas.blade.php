@extends('auditor.dashboard')

@section('content')
 <link rel="stylesheet" href="{{ asset('css/index.css') }}">

<div class="container mt-4">
    <div class="card shadow-sm mb-4 bg-dark">
        <div class="card-body text-center p-3">
            <h3 class="mb-0 text-white">Listado De Tareas Finalizadas</h3>
        </div>
    </div>
</div>


<div class="container mt-4">
    <!-- Mensajes de éxito -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('auditor.tareas.listadoTareasResueltasGlobal') }}" class="btn btn-primary mb-3">Historial de Tareas</a>

    <table class="table table-bordered table-responsive table-striped">
        <thead class="table-dark">
            <tr>
                <th>Titulo</th>
                <th>Sede</th>
                <th>Encargado</th>
                <th>Técnico</th>
                <th>Tipo</th>
                <th>Accion</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tareasFinalizadas as $tarea)
            <tr>
                <td>{{ $tarea->titulo ? : '-' }}</td>
                <td>{{ $tarea->sede ? $tarea->sede->nombre : '-' }}</td>
                <td>{{ $tarea->encargado ? $tarea->encargado->email : '-' }}</td>
                <td>{{ $tarea->tecnico ? $tarea->tecnico->email : '-' }}</td>
                <td>{{ ucfirst($tarea->tipo) }}</td>
                <td>
                    <a href="{{route('auditor.tareas.visualizar' , $tarea->id)}}" class="btn btn-info btn-sm">Visualizar</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="10" class="text-center">No hay tareas registradas en el Sistema</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
