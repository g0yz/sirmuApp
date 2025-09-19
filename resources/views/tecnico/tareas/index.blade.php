@extends('tecnico.dashboard')

@section('content')
<div class="container mt-4">
    <h2>Próximas tareas asignadas</h2>

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
                        <a href="{{ route('tecnico.tareas.show', $tarea->id) }}" class="btn btn-primary btn-sm">Ver</a>
                      </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection