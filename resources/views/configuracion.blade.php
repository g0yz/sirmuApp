@extends($layout)

@section('content')
<link rel="stylesheet" href="{{ asset('css/formulario.css') }}">

  <div class="container mt-4">
    <div class="card shadow-sm mb-4 bg-dark">
      <div class="card-body text-center p-3">
        <h3 class="mb-0 text-white">Tareas Asignadas</h3>
      </div>
    </div>

  {{-- Alertas de éxito --}}
  @if(session('success_perfil'))
    <div class="alert alert-success">{{ session('success_perfil') }}</div>
  @endif
  @if(session('success_password'))
    <div class="alert alert-success">{{ session('success_password') }}</div>
  @endif
  @if(session('success_prefs'))
    <div class="alert alert-success">{{ session('success_prefs') }}</div>
  @endif

  <div class="row g-4">
    {{-- PERFIL PERSONAL --}}
    <div class="col-lg-6">
      <div class="card shadow-sm h-100 {{ (isset($userTheme) && $userTheme==='dark') ? 'bg-dark text-white' : '' }}">
        <div class="card-body">
          <h5 class="card-title mb-3">Perfil personal</h5>
          <form method="POST" action="{{ route('config.update.profile') }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
              <label class="form-label">Nombre</label>
              <input type="text" name="nombre" class="form-control"
                     value="{{ old('nombre', optional(auth()->user()->persona)->nombre) }}" required>
              @error('nombre')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
              <label class="form-label">Apellido</label>
              <input type="text" name="apellido" class="form-control"
                     value="{{ old('apellido', optional(auth()->user()->persona)->apellido) }}" required>
              @error('apellido')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="email" name="email" class="form-control"
                     value="{{ old('email', auth()->user()->email) }}" required>
              @error('email')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>

            <button type="submit" class="btn btn-primary">Guardar perfil</button>
          </form>
        </div>
      </div>
    </div>

    {{-- CAMBIAR CONTRASEÑA --}}
    <div class="col-lg-6">
      <div class="card shadow-sm h-100 {{ (isset($userTheme) && $userTheme==='dark') ? 'bg-dark text-white' : '' }}">
        <div class="card-body">
          <h5 class="card-title mb-3">Cambiar contraseña</h5>
          <form method="POST" action="{{ route('config.update.password') }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
              <label class="form-label">Contraseña actual</label>
              <div class="input-group">
                <input type="password" name="current_password" id="current_password" class="form-control" required>
                <button type="button" class="btn btn-outline-secondary toggle-password" data-target="current_password">
                  <i class="bi bi-eye"></i>
                </button>
              </div>
              @error('current_password')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
              <label class="form-label">Nueva contraseña</label>
              <div class="input-group">
                <input type="password" name="password" id="password" class="form-control" required>
                <button type="button" class="btn btn-outline-secondary toggle-password" data-target="password">
                  <i class="bi bi-eye"></i>
                </button>
              </div>
              @error('password')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
              <label class="form-label">Confirmar nueva contraseña</label>
              <div class="input-group">
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                <button type="button" class="btn btn-outline-secondary toggle-password" data-target="password_confirmation">
                  <i class="bi bi-eye"></i>
                </button>
              </div>
            </div>

            <button type="submit" class="btn btn-warning">Actualizar contraseña</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- Script para alternar visibilidad de contraseñas --}}
<script>
  document.querySelectorAll('.toggle-password').forEach(btn => {
    btn.addEventListener('click', function() {
      const targetId = this.getAttribute('data-target');
      const input = document.getElementById(targetId);
      const icon = this.querySelector('i');

      if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('bi-eye');
        icon.classList.add('bi-eye-slash');
      } else {
        input.type = 'password';
        icon.classList.remove('bi-eye-slash');
        icon.classList.add('bi-eye');
      }
    });
  });
</script>

@endsection
