<link rel="stylesheet" href="{{ asset('css\calendario.css') }}">

<script type="text/javascript">
  var baseURL={!! json_encode(url('/')) !!}
</script>

@extends('encargado.dashboard')


@section('content')

  <div class="container mt-4">
    <div class="card shadow-sm mb-4 bg-dark">
      <div class="card-body text-center p-3">
        <h3 class="mb-0 text-white">Calendario</h3>
      </div>
    </div>
  </div>

<div class="container">
    <div id="agenda"></div>
</div>

<!-- Modal -->
<div class="modal fade" id="evento" tabindex="-1" aria-labelledby="eventoLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="eventoLabel">Datos del Evento</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">


    <form id ="formEvento" method="POST">

    @csrf

    <div class="mb-3 d-none">
        <label for="id" class="form-label">ID:</label>
        <input type="text" class="form-control" id="id" name="id" aria-describedby="helpId" placeholder="">
        <div id="helpId" class="form-text">Ayuda o indicación adicional</div>
    </div>

    <div class="mb-3">
        <label for="title" class="form-label">Titulo</label>
        <input type="text" class="form-control" id="title" name="title" placeholder="Ingrese el Titulo del Evento">
        <div id="helpId" class="form-text">Ayuda o indicación adicional</div>
    </div>

    <div class="mb-3">
        <label for="descripcion" class="form-label">Descripcion</label>
        <textarea class="form-control" name="descripcion" id="descripcion" rows="3"></textarea>
    </div>
    
    <div class="mb-3">
        <label for="start" class="form-label">Fecha de Inicio</label>
        <input type="date" class="form-control" id="start" name="start">
        <div id="helpId" class="form-text text-muted">Ayuda o indicación adiciona</div>
    </div>

    <div class="mb-3">
        <label for="end" class="form-label">Fecha de Finalizacion</label>
        <input type="date" class="form-control" id="end" name="end">
        <div id="helpId" class="form-text">Ayuda o indicación adicional</div>
    </div>

    </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="btnGuardar">Guardar</button>
        <button type="button" class="btn btn-warning" id="btnModificar">Modificar</button>
        <button type="button" class="btn btn-danger" id="btnEliminar">Eliminar</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>




@endsection