<x-layout-app pageTitle="Deletar Colaborador">
    <div class="w-25 p-4">
        <h3>Deletar colaborador</h3>
        <hr>
        <p>Tem certeza que quer deletar o seguinte colaborador?</p>
        <div class="text-center">
            <h3>[{{$colaborator->name }}]</h3>
            <p>{{ $colaborator->email }}</p>
            <a href="{{ route("rh_user.management.colaborators") }}" class="btn btn-secondary px-5">Não</a>
            <a href="{{ route("rh_user.management.delete_confirm", ["id" => $colaborator->id]) }}" class="btn btn-danger px-5">Sim</a>
        </div>
    </div>
</x-layout-app>
