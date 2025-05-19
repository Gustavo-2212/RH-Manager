<div class="d-flex flex-column sidebar pt-4">
    <a href="{{ route("home") }}"><i class="fas fa-home me-3"></i>Home</a>

    @can("admin")
        <a href="{{ route("colaborators") }}"><i class="fas fa-users me-3"></i>Colaboradores</a>
        <a href="{{ route("rh_users") }}"><i class="fas fa-user-gear me-3"></i>RH Colaboradores</a>
        <a href="{{ route("departments") }}"><i class="fas fa-industry me-3"></i>Departamentos</a>
    @endcan
    <a href="{{ route("chat") }}"><i class="fas fa-comments me-3"></i>Chat</a>
    <hr>
    <a href="{{ route("user.profile") }}"><i class="fas fa-cog me-3"></i>Perfil Usuário</a>
    <hr>

    <div class="text-center mt-3">
        <form action="{{ route("logout") }}" method="POST">
            @csrf
            <button type="submit" class="btn-sm btn-outline-dark me-3">
                <i class="fas fa-sign-out alt me-3"></i>Sair
            </button>
        </form>
    </div>

</div>
