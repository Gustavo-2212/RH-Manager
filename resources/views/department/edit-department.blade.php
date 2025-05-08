<x-layout-app pageTitle="Editar Departamento">

    <div class="w-25 p-4">
        <h3>Editar departamento</h3>
        <hr>
        <form action="{{ route("department.update_department") }}" method="POST">
            @csrf

            <input type="hidden" name="id" value="{{ $department["id"] }}">

            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $department["name"] }}">
                @error("name")
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <a href="{{ route("departments") }}" class="btn btn-outline-danger">Voltar</a>
                <button type="submit" class="btn btn-primary">Editar</button>
            </div>
        </form>
    </div>

</x-layout-app>
