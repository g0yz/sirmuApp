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

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                </div>
            @endif

            <form method="POST" action="{{ route('soporteTecnico.enviar') }}">
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


    <!-- Preguntas Frecuentes -->
    <div class="card mb-4">
        <div class="card-body">
            <h5>Preguntas Frecuentes (FAQ)</h5>
            <div class="accordion" id="faqAccordion">

                <!-- General -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading1">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1" aria-expanded="true" aria-controls="faq1">
                            ¿Cómo recupero mi contraseña si la olvidé?
                        </button>
                    </h2>
                    <div id="faq1" class="accordion-collapse collapse show" aria-labelledby="heading1" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Debés ir a la opción "Olvidé mi contraseña" en la pantalla de login. Recibirás un correo con un enlace para restablecerla.
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading2">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2" aria-expanded="false" aria-controls="faq2">
                            ¿Qué hago si no puedo acceder al sistema?
                        </button>
                    </h2>
                    <div id="faq2" class="accordion-collapse collapse" aria-labelledby="heading2" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Primero verificá que tus credenciales sean correctas. Sino, revisa si tenes algún problema de conexón.
                            Si el problema persiste, contactá al área de soporte técnico a través del formulario de esta página.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading3">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3" aria-expanded="false" aria-controls="faq3">
                            ¿Qué navegador debo usar para acceder al sistema?
                        </button>
                    </h2>
                    <div id="faq3" class="accordion-collapse collapse" aria-labelledby="heading3" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Se recomienda usar Google Chrome, Mozilla Firefox o Microsoft Edge actualizados para garantizar el correcto funcionamiento.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading4">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4" aria-expanded="false" aria-controls="faq4">
                            ¿Qué hago si veo mensajes de error en la pantalla?
                        </button>
                    </h2>
                    <div id="faq4" class="accordion-collapse collapse" aria-labelledby="heading4" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Anotá el mensaje de error y, si es posible, hacé una captura de pantalla. Enviá la información al soporte técnico mediante el formulario de esta página.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading5">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq5" aria-expanded="false" aria-controls="faq5">
                            ¿Cómo actualizo mis datos personales en el sistema?
                        </button>
                    </h2>
                    <div id="faq5" class="accordion-collapse collapse" aria-labelledby="heading5" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Podes modificar tus datos en el apartado Configuración > Editar Perfil.
                        </div>
                    </div>
                </div>
    
            </div>
        </div>
    </div>


    <!-- Mapa -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <div id="map" style="height:400px; width:100%;"></div>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <script>
    const centro = [-34.9214, -57.9545];
    const map = L.map('map').setView(centro, 14);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap'
    }).addTo(map);
    const sedes = [
        { nombre: "Oficina de Soporte Tecnico 'Sede Buri'", lat: -34.9195, lng: -57.9457 },
        { nombre: "Oficina de Soporte Tecnico 'Sede 38'", lat: -34.9181736, lng: -57.9756731 },
    ];
    const bounds = [];
    sedes.forEach(s => {
        const marker = L.marker([s.lat, s.lng]).addTo(map).bindPopup(s.nombre);
        bounds.push([s.lat, s.lng]);
    });
    if (bounds.length > 1) {
        map.fitBounds(bounds, { padding: [30, 30] });
    }
    </script>




@endsection

