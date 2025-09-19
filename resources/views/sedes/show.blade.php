@extends('admin.dashboard')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-center">Detalles de la Sede</h2>

    <div class="card shadow-sm">

        <div class="row mb-2">
                <div class="col-12 col-md-6">
                    <strong>Nombre:</strong> {{ $sede->nombre}}
                </div>
        </div>
        
        <div class="row mb-2">
                <div class="col-12 col-md-6">
                    <strong>Direccion:</strong> {{ $sede->direccion}}
                </div>
        </div>

        <div class="row mb-2">
                <div class="col-12 col-md-6">
                    <strong>Tipo:</strong> {{ $sede->tipo}}
                </div>
        </div>

        <div class="row mb-2">
                <div class="col-12 col-md-6">
                    <strong>Encargado:</strong> {{ $sede->encargado_id ?? 'Sin encargado'}}
                </div>
        </div>

        <div class="row mb-2">
                <div class="col-12 col-md-6">
                    <strong>Capacidad:</strong> {{ $sede->capacidad_estudiantes}}
                </div>
        </div>

        <div class="row mb-2">
                <div class="col-12 col-md-6">
                    <strong>Carreras:</strong> {{ $sede->carreras_ofrecidas}}
                </div>
        </div>

                <div class="row mb-2">
                <div class="col-12 col-md-6">
                    <strong>Descripcion:</strong> {{ $sede->Descripcion ?? 'sin Descripcion '}}
                </div>
        </div>



</div>
@endsection