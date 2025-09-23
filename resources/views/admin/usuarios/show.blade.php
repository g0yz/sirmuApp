
@extends('admin.dashboard')

@section('content')
<link rel="stylesheet" href="{{ asset('css/detalle.css') }}">

<div class="container mt-4">
    <div class="card shadow-sm mb-4 bg-dark">
        <div class="card-body text-center p-3">
            <h3 class="mb-0 text-white">Detalle del Usuario</h3>
        </div>
    </div>
</div>


<div class="container mt-4">
    <div class="card shadow-sm">

    <div class="card-body">
        <div class="row mb-2">
                <div class="col-12 col-md-6">
                    <strong>ID:</strong> {{ $user->id}}
                </div>
        </div>
        
        <div class="row mb-2">
                <div class="col-12 col-md-6">
                    <strong>Nombre:</strong> {{ $user->persona->nombre}}
                </div>
        </div>

        <div class="row mb-2">
                <div class="col-12 col-md-6">
                    <strong>Apellido:</strong> {{ $user->persona->apellido}}
                </div>
        </div>

        <div class="row mb-2">
                <div class="col-12 col-md-6">
                    <strong>Email:</strong> {{ $user->email}}
                </div>
        </div>

        <div class="row mb-2">
                <div class="col-12 col-md-6">
                    <strong>Rol Asignado:</strong> {{ $user->rol}}
                </div>
        </div>
</div>
</div>

<div class="mt-3 text-center">
    <a href="{{ url()->previous() }}" class="btn btn-secondary">Volver</a>
</div>
@endsection