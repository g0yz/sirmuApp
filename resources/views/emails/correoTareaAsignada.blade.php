<!DOCTYPE html>
<html>
<head>
    <title>Nueva Tarea Asignada</title>
</head>
<body>
    <h2>Nueva Tarea Asignada</h2>
    <p><strong>Estimado/a {{$tecnico->persona->nombre}}, se le ha asignado una nueva tarea para realizar</p>
    <p><strong>Sede Correspondiente: </strong> {{$encargado->sede->nombre}}</p>
    <p><strong>Título:</strong> {{ $tarea->titulo }}</p>
    <p><strong>Descripción:</strong> {{ $tarea->descripcion }}</p>
    <p><strong>Prioridad:</strong> {{ ucfirst($tarea->prioridad) }}</p>
    <p><strong>Fecha estimada:</strong> {{ \Carbon\Carbon::parse($tarea->fecha_estimada)->format('d/m/Y') }}</p>
</body>
</html>