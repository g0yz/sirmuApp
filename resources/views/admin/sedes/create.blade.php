

@extends('admin.dashboard')

 <link rel="stylesheet" href="{{ asset('css/register.css') }}">

@section('content')

  <!-- Formulario centrado -->
<div class="registration-container">
  <div class="registration-form p-4 bg-white rounded shadow-sm">
    <h2 class="h2">Ingresar Datos De La Sede</h2>
    <form method="POST" action="{{route('admin.sedes.store')}}" enctype="multipart/form-data">
      @csrf
      <label for="text">Nombre</label>
      <input type="text" name="nombre" class="form-control mb-2" required>
      <label for="text">Direccion</label>
      <input type="text" name="direccion" class="form-control mb-2" required>

      <select name="encargado_id" class="form-select mb-2">
      <option value="">Seleccione al encargado</option>
            @foreach($encargados as $encargado)
      <option value="{{ $encargado->id }}">{{ $encargado->id }}</option>
            @endforeach
      </select>
      <label for="text">Capacidad de Estudiantes:</label>
      <input type="text" name="capacidad_estudiantes" class="form-control mb-2" required>
      <label for="text">Carreras de la Sede:</label>
      <input type="text" name="carreras_ofrecidas" class="form-control mb-2" required>
      <label for="opciones">Tipo de Sede:</label>
      <select name="tipo" class="form-select form-select-sm-2">
      <option value="campus">Campus</option>
      <option value="virtual">Virtual</option>
      <option value="regional">Regional</option>
      <option value="especial">Especial</option>
      </select>
      <label for="imagen" class="form-label">Imagen de la Sede:</label>
      <input type="file" name="imagen" class="form-control mb-2" accept="image/*">
      <button type="submit" class="registration-btn">Registrar</button>
    </form>
  </div>
</div>
<div class="mt-3 text-center">
    <a href="{{ url()->previous() }}" class="btn btn-secondary">Volver</a> 
</div>
@endsection