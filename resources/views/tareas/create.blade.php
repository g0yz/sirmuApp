
@extends('admin.dashboard')

 <link rel="stylesheet" href="{{ asset('css/register.css') }}">

@section('content')

  <!-- Formulario centrado -->
<div class="registration-container">
  <div class="registration-form">
    <h2 class="h2">Ingresar Datos De La Tarea</h2>
    <form method="POST" action="{{route('tareas.store')}}">
      @csrf
      <input type="text" name="titulo" class="form-control mb-2" placeholder="Titulo de la Tarea" required>

      <select name="sede_id" class="form-select mb-2" required>
      <option value="">Seleccione la Sede</option>
            @foreach($sedes as $sede)
      <option value="{{ $sede->id }}">{{ $sede->id }}</option>
            @endforeach
      </select>

      <select name="encargado_id" class="form-select mb-2">
      <option value="">Seleccione al Encargado</option>
            @foreach($encargados as $encargado)
      <option value="{{ $encargado->id }}">{{ $encargado->id }}</option>
            @endforeach
      </select>
      

      <select name="tecnico_id" class="form-select mb-2">
      <option value="">Seleccione al Tecnico</option>
            @foreach($tecnicos as $tecnico)
      <option value="{{ $tecnico->id }}">{{ $tecnico->id }}</option>
            @endforeach
      </select>

      <label>Tipo</label>
      <select name="tipo" class="form-select form-select-sm-2">
      <option value="mantenimiento">Mantenimiento</option>
      <option value="presupuesto">Presupuesto</option>
      <option value="instalacion">Instalacion</option>
      </select>


      <label>Prioridad</label>
      <select name="prioridad" class="form-select form-select-sm-2">
      <option value="alta">Alta</option>
      <option value="media">Media</option>
      <option value="baja">Baja</option>
      </select>

      <label>Estado</label>
      <select name="estado" class="form-select form-select-sm-2">
      <option value="pendiente">Pendiente</option>
      <option value="finalizada">Finalizado</option>
      <option value="validada">Validado</option>
      <option value="rechazada">Rechazado</option>
      </select>

      <label>Fecha Estimada</label>
      <input type="date" name="fecha_estimada" class="form-control mb-2" required>

      <input type="text" name="descripcion" class="form-control mb-2" placeholder="Descripcion" required>


      <button type="submit" class="registration-btn">Registrar</button>
    </form>
  </div>
</div>

@endsection