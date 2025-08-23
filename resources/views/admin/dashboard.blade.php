<form action="{{ route('logout') }}" method="POST" style="display:inline;">
    @csrf
    <button type="submit" class="btn btn-danger">
        Cerrar sesión
    </button>
</form>
