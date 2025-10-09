<!DOCTYPE html>
<html>
<head>
    <title>Seguimiento Estado de Tarea</title>
</head>
<body>
    <h2>Seguimiento del Estado de una Tarea</h2>
        <p>Hola {{ $encargado->name }},</p>
        <p>su tarea <strong>{{ $tarea->titulo }}
        </strong> ha sido {{ $tarea->estado }} 

        @if($tarea->estado == 'finalizada')
            por el tecnico: {{ $tecnico->persona->nombre }} {{ $tecnico ->persona ->apellido}}.

        @elseif($tarea->estado == 'validada' || $tarea->estado == 'rechazada')
            por un auditor del sistema.

        @endif </p>

        <p>Revisa la información de la tarea en el sistema.</p>
</body>
</html>
