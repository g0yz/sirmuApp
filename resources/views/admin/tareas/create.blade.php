
@extends('admin.dashboard')

 <link rel="stylesheet" href="{{ asset('css/formulario.css') }}">

@section('content')

  <!-- Formulario centrado -->
<div class="registration-container">
  <div class="registration-form p-4 bg-white rounded shadow-sm">
    <h2 class="h2">Ingresar Tarea</h2>
    <form method="POST" action="{{route('admin.tareas.store')}}">
      @csrf
      <label for="text">Titulo:</label>
      <input type="text" name="titulo" class="form-control mb-2" required>

      <select name="sede_id" class="form-select mb-2" required>
      <option value="">Seleccione la Sede</option>
            @foreach($sedes as $sede)
      <option value="{{ $sede->id }}">{{ $sede->nombre }}</option>
            @endforeach
      </select>

<label for="encargado_nombre">Encargado de la sede:</label>
<input type="text" id="encargado_nombre" class="form-control mb-2" value="" disabled>

<script>
  // Mapeo Sede -> Encargado (nombre completo) generado desde el backend
  const sedeEncargados = @json(
    $sedes->mapWithKeys(fn($s) => [
      $s->id => optional(optional($s->encargado)->persona)->nombre . ' ' . optional(optional($s->encargado)->persona)->apellido
    ])
  );

  const sedeSelect = document.querySelector('select[name="sede_id"]');
  const encargadoNombre = document.getElementById('encargado_nombre');

  function actualizarEncargado() {
    const sid = sedeSelect.value;
    encargadoNombre.value = sedeEncargados[sid] || '—';
  }

  sedeSelect.addEventListener('change', actualizarEncargado);
  // Inicializar al cargar
  actualizarEncargado();
</script>
      

      <select name="tecnico_id" class="form-select mb-2">
      <option value="">Seleccione al Tecnico</option>
            @foreach($tecnicos as $tecnico)
      <option value="{{ $tecnico->id }}">{{ $tecnico->persona->nombre }} {{ $tecnico->persona->apellido }}</option>
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