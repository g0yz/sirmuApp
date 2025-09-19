@extends('admin.dashboard')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-center">Detalles del Usuario</h2>

    <div class="card shadow-sm">

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


        <div class="mt-3 text-center">
            <a href="{{ url()->previous() }}" class="btn btn-secondary">Volver</a>
        </div>

</div>
@endsection