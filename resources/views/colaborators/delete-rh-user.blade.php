<x-layout-app pageTitle="Deletar RH Colaborador">
    <div class="w-4 p-4">
        <h3>Deletar colaborador</h3>
        <hr>
        <p>Você tem certeza que quer deletar o seguinte colaborador?</p>

        <div class="text-center">
            <h3>{{ $colaborator["name"] }}</h3>
            <a href="{{ route("rh_users") }}" class="btn btn-secondary px-5">Não</a>
            <a href="{{ route("rh_user.delete_confirm", ["id" => $colaborator["id"]]) }}" class="btn btn-danger px-5">Sim</a>
        </div>
    </div>
</x-layout-app>

