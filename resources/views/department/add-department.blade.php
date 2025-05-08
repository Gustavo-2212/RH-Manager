<x-layout-app pageTitle="Novo Departamento">

    <div class="w-25 p-4">

        <h3>Novo departamento</h3>

        <hr>

        <form action="{{ route("department.create_department") }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input type="text" class="form-control" id="name" name="name" required>
                @error("name")
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <a href="{{ route("departments") }}" class="btn btn-outline-danger">Voltar</a>
                <button type="submit" class="btn btn-primary">Criar departamento</button>
            </div>

        </form>

    </div>

</x-layout-app>
