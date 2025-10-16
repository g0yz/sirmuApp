@extends('encargado.dashboard')

@section('content')
  <div class="container mt-4">
    <div class="card shadow-sm mb-4 bg-dark">
      <div class="card-body text-center p-3">
        <h3 class="mb-0 text-white">Metricas de las Tareas del Mes</h3>
      </div>
    </div>
  </div>

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
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Pendientes','Finalizadas','Validadas','Rechazadas','Totales'],
            datasets: [{
                label: 'Cantidad de tareas',
                data: [{{ $pendientes }}, {{ $finalizadas }}, {{ $validadas }}, {{ $rechazadas }}, {{ $totales }}],
                backgroundColor: [
                    'rgba(255, 205, 86, 0.7)',
                    'rgba(75, 192, 192, 0.7)',
                    'rgba(153, 102, 255, 0.7)',
                    'rgba(255, 99, 132, 0.7)',
                    'rgba(54, 162, 235, 0.7)'
                ],
                borderColor: [
                    'rgba(255, 205, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
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
                    text: 'Tareas Acutales de la sede en el mes {{ $mesActual }}'
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
