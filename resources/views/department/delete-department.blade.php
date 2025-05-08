<x-layout-app pageTitle="Deletar Departamento">
    <div class="w-4 p-4">
        <h3>Deletar departamento</h3>
        <hr>
        <p>Você tem certeza que quer deletar o seguinte departamento?</p>

        <div class="text-center">
            <h3>{{ $department["name"] }}</h3>
            <a href="{{ route("departments") }}" class="btn btn-secondary px-5">Não</a>
            <a href="{{ route("department.delete_confirm", ["id" => $department["id"]]) }}" class="btn btn-danger px-5">Sim</a>
        </div>
    </div>
</x-layout-app>
