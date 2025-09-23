@extends('tecnico.dashboard')
 <link rel="stylesheet" href="{{ asset('css/formulario.css') }}">
@section('content')
<div class="container mt-4">
  <!-- Formulario centrado -->
<div class="registration-container">
    
  <div class="registration-form p-4 bg-white rounded shadow-sm">
        <h2 class="h2">Ingresar Datos Resolucion:</h2>

     <form method="POST" action="{{route('admin.tareas.store')}}"  enctype="multipart/form-data">
        @csrf
        <label>Fecha de finalización:</label>
        <input type="text" id="fecha" name="fecha" class="form-control form-control-sm w-auto"
            value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" readonly>

      <label for="text">Descripcion:</label>
      <input type="text" name="descripcion" class="form-control mb-2"required>
      <label for="text">Imagenes:</label>
      <input name="imagenes[]" type='file' class="form-control" id="imagenes" multiple>
      <label for="text">Documentos:</label>
      <input name="documentos[]" type='file' class="form-control" id="documentos" multiple>
      <button type="submit" class="registration-btn">Registrar</button>
    </form>
  </div>
</div>
<div class="mt-3 text-center">
    <a href="{{ url()->previous() }}" class="btn btn-secondary">Volver</a> 
</div>


@endsection
