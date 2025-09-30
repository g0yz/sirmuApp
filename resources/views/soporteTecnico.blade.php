@extends($layout)

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Soporte Técnico</h2>

    <!-- Contacto rápido -->
    <div class="card mb-4">
        <div class="card-body">
            <h5>Contacto Rápido</h5>
            <p><i class="bi bi-telephone-fill"></i> Teléfono: 0800-123-4567</p>
            <p><i class="bi bi-envelope-fill"></i> Email: soporte@sirmu.com</p>
            <p><i class="bi bi-clock-fill"></i> Horario: Lunes a Viernes de 9 a 18 hs</p>
        </div>
    </div>

    <!-- Formulario -->
    <div class="card mb-4">
        <div class="card-body">
            <h5>Enviar Consulta</h5>
            <form method="POST" action="{{ route('admin.soporteTecnico') }}">
                @csrf
                <div class="mb-3">
                    <label for="asunto" class="form-label">Asunto</label>
                    <input type="text" class="form-control" id="asunto" name="asunto" required>
                </div>
                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Enviar</button>
            </form>
        </div>
    </div>

    <!-- Mapa -->
    <div id="map" style="height:400px; width:100%;"></div>

</div>

<script>
function initMap() {
    const laPlata = { lat: -34.9214, lng: -57.9545 }; // Coordenadas de La Plata
    const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 14, // nivel de zoom (más alto = más cerca)
        center: laPlata,
    });

    new google.maps.Marker({
        position: { lat: -34.9195, lng: -57.9457 },
        map: map,
        title: "Oficina de Soporte Tecnico 'Buri'"
    });

    new google.maps.Marker({
        position: { lat: -34.9181736, lng: -57.9756731 },
        map: map,
        title: "Oficina de Soporte Tecnico IPS"        
    });
}
</script>

<script async
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCaGcAce1OqHIJdTRharn_9HZEuHqqwIP8&callback=initMap">
</script>


@endsection

