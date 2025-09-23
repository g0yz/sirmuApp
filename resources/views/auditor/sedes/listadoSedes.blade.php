@extends('auditor.dashboard')

@section('content')
 <link rel="stylesheet" href="{{ asset('css/index.css') }}">

<div class="container mt-4 responsive">
    <div class="card shadow-sm mb-4 bg-dark">
        <div class="card-body text-center p-3">
            <h3 class="mb-0 text-white">Sedes del Sistema</h3>
        </div>
    </div>
</div>


<div class="container mt-4">

    <!-- Mensajes de éxito -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-responsive table-striped">
        <thead class="table-dark">
            <tr>
                <th>Nombre</th>
                <th>Direccion</th>
                <th>Tipo</th>
                <th>Encargado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($sedes as $sede)
            <tr>
                <td>{{ $sede->nombre ?? '-' }}</td>
                <td>{{ $sede->direccion ?? '-' }}</td>
                <td>{{ $sede->tipo }}</td>
                <td>{{ $sede->encargado_id }}</td>
                <td>
                    <a href="{{ route('auditor.sedes.verSede', $sede) }}" class="btn btn-info btn-sm">Ver</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">No hay sedes registradas</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
