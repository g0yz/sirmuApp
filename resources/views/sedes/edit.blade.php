<link rel="stylesheet" href="{{ asset('css/register.css') }}">

@extends('admin.dashboard')

@section('content')

<div class="registration-container">
    <div class="registration-form">
        <h2 class="h2">Editar Sede</h2>
        <form method="POST" action="{{ route('sedes.update', $sede) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <input type="text" name="nombre" class="form-control mb-2" placeholder="Nombre de la sede" required value="{{ $sede->nombre }}">
            <input type="text" name="direccion" class="form-control mb-2" placeholder="Dirección de la sede" required value="{{ $sede->direccion }}">

            <label for="tipo">Tipo de Sede:</label>
            <select name="tipo" class="form-select mb-2">
                <option value="campus" @if($sede->tipo == 'campus') selected @endif>Campus</option>
                <option value="virtual" @if($sede->tipo == 'virtual') selected @endif>Virtual</option>
                <option value="regional" @if($sede->tipo == 'regional') selected @endif>Regional</option>
                <option value="especial" @if($sede->tipo == 'especial') selected @endif>Especial</option>
            </select>

            <input type="text" name="capacidad_estudiantes" class="form-control mb-2" placeholder="Capacidad de estudiantes"required value="{{ $sede->capacidad_estudiantes }}">
            <input type="text" name="carreras_ofrecidas" class="form-control mb-2" placeholder="Carreras ofrecidas" required value="{{ $sede->carreras_ofrecidas }}">

            <label for="imagen">Imagen de la Sede:</label>
            <input type="file" name="imagen" class="form-control mb-2" accept="image/*">

            <button type="submit" class="registration-btn">Actualizar</button>
        </form>
    </div>
</div>

@endsection
