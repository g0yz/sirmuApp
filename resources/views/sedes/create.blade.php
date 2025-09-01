

@extends('admin.dashboard')

 <link rel="stylesheet" href="{{ asset('css/register.css') }}">

@section('content')

  <!-- Formulario centrado -->
<div class="registration-container">
  <div class="registration-form">
    <h2 class="h2">Ingresar Datos De La Sede</h2>
    <form method="POST" action="{{route('sedes.store')}}">
      @csrf
      <input type="text" name="nombre" class="form-control mb-2" placeholder="Nombre de la Sede" required>
      <input type="text" name="direccion" class="form-control mb-2" placeholder="Direccion" required>

      <select name="encargado_id" class="form-select mb-2">
      <option value="">-- Seleccione al encargado --</option>
            @foreach($encargados as $encargado)
      <option value="{{ $encargado->id }}">{{ $encargado->id }}</option>
            @endforeach
      </select>
      <input type="text" name="capacidad_estudiantes" class="form-control mb-2" placeholder="Capacidad de Estudiantes" required>
      <input type="text" name="carreras_ofrecidas" class="form-control mb-2" placeholder="Carreras de la Sede(Detalle)" required>
      <label for="opciones">Tipo de Sede:</label>
      <select name="tipo" class="form-select form-select-sm-2">
      <option value="campus">Campus</option>
      <option value="virtual">Virtual</option>
      <option value="regional">Regional</option>
      <option value="especial">Especial</option>
      </select>
      <button type="submit" class="registration-btn">Registrar</button>
    </form>
  </div>
</div>

@endsection