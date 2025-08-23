<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SIRMU - Sistema de Gestión de Sedes</title>
  <!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="{{ asset('css\welcome.css') }}">
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">SIRMU</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link active" href="#inicio">Inicio</a></li>
          <li class="nav-item"><a class="nav-link" href="#proyecto">Proyecto</a></li>
          <li class="nav-item"><a class="nav-link" href="#funcionalidades">Funcionalidades</a></li>
          <li class="nav-item"><a class="nav-link" href="/login">Inicio de Sesion</a></li>
          <li class="nav-item"><a class="nav-link" href="#contacto">Contacto</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Sirmu nombre completo -->
  <section id="inicio" class="hero text-center py-5">
    <div class="container">
      <h1 class="display-4">Sistema de Infraestructura y Reformas de Mantenimiento Universitario</h1>
    </div>
  </section>

  <!-- Seccion de Proyecto -->
  <section id="proyecto" class="py-5 bg-light">
    <div class="container">
      <h2 class="mb-4">¿En qué consiste el proyecto?</h2>
      <p>
        SIRMU es un sistema interno de gestión para universidades con múltiples sedes en distintas provincias de Argentina.
        Su objetivo es centralizar y optimizar el control de infraestructura y mantenimiento, permitiendo registrar, programar
        y seguir intervenciones técnicas y reformas en cada sede.
      </p>
      <p>
        El sistema está diseñado para personal administrativo y técnico, con distintos niveles de acceso según el rol.
        Incluye funcionalidades como historial de tareas, cronograma de mantenimiento, alertas por fechas críticas, adjunto
        de documentación y métricas por sede.
      </p>
    </div>
  </section>

  <!-- Seccion de Funcionalidades -->
  <section id="funcionalidades" class="py-5">
    <div class="container">
      <h2 class="mb-4 text-center">Funcionalidades principales</h2>
      <div class="row g-4">
        <div class="col-md-4 text-center">
          <i class="bi bi-building fs-1 mb-2"></i>
          <h5>Gestión de Sedes</h5>
          <p>Registro, historial y detalles de cada sede universitaria.</p>
        </div>
        <div class="col-md-4 text-center">
          <i class="bi bi-tools fs-1 mb-2"></i>
          <h5>Mantenimiento y Reformas</h5>
          <p>Control de tareas, reformas, seguimiento de intervenciones y adjunto de documentación.</p>
        </div>
        <div class="col-md-4 text-center">
          <i class="bi bi-calendar-check fs-1 mb-2"></i>
          <h5>Calendario y Alertas</h5>
          <p>Cronograma de tareas, fechas de control y alertas por vencimientos.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Contacto -->
  <section id="contacto" class="py-5 bg-light">
    <div class="container text-center">
      <h2 class="mb-4">Contacto</h2>
      <p>Correo: contacto@sirmu.com</p>
      <p>Teléfono: +54 11 1234-5678</p>
    </div>
  </section>

  <!-- Footer -->
  <footer class="text-center py-3 bg-dark text-white">
    &copy; 2025 SIRMU | Todos los derechos reservados
  </footer>

</body>
</html>
