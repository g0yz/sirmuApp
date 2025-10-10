@extends('auditor.dashboard')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">Métricas de las tareas del Mes</h2>

    <div class="row">
        <div class="col-md-6 offset-md-3">
            <canvas id="tareasChart"></canvas>
        </div>
    </div>

    <div class="mt-4 text-center">
        <p><strong>Tareas Pendientes:</strong> {{ $pendientes }}</p>
        <p><strong>Tareas Finalizadas:</strong> {{ $finalizadas }}</p>
        <p><strong>Tareas Validadas:</strong> {{ $validadas }}</p>
        <p><strong>Tareas Rechazadas:</strong> {{ $rechazadas }}</p>
        <p><strong>Total de Tareas:</strong> {{ $totales }}</p>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('tareasChart').getContext('2d');

    const tareasChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Pendientes','Finalizadas','Validadas', 'Rechazadas', 'Totales'],
            datasets: [{
                label: 'Cantidad de tareas',
                data: [{{$pendientes}},{{$finalizadas}},{{ $validadas }}, {{ $rechazadas }}, {{ $totales }}],
                backgroundColor: [
                    'rgba(75, 192, 192, 0.7)',
                    'rgba(255, 99, 132, 0.7)',
                    'rgba(54, 162, 235, 0.7)'
                ],
                borderColor: [
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)'
                ],
                borderWidth: 2,
                borderRadius: 8
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                title: {
                    display: true,
                    text: 'Tareas concluidas en el mes {{ $mesActual }}'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { precision: 0 }
                }
            }
        }
    });
</script>
@endsection
