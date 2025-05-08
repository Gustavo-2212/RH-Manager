<x-layout-app pageTitle="Departamentos">

    <div class="w-100 p-4">

        <h3>Departamentos</h3>

        <hr>

        @if($departments->count() === 0)
            <div class="text-center my-5">
                <p>No departments found.</p>
                <a href="{{ route("department.add_department") }}" class="btn btn-primary">Create a new department</a>
            </div>
        @else
            <hr>

            <div class="mb-3">
                <a href="{{ route("department.add_department") }}" class="btn btn-primary">Criar um novo departamento</a>
            </div>

            <table class="table w-50" id="table">
                <thead class="table-dark">
                    <th>Departamento</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($departments as $department)
                        <tr class="table-light">
                            <td>[{{ $department["name"] }}]</td>
                            <td>
                                <div class="d-flex gap-3 justify-content-end">
                                    @if($department["id"] === 1 && $department["name"] === "Administração")
                                        <i class="fa-solid fa-lock"></i>
                                    @else
                                        <a href="{{ route("department.edit_department", ["id" => $department["id"]]) }}" class="btn btn-sm btn-outline-dark"><i class="fa-regular fa-pen-to-square me-2"></i>Editar</a>
                                        <a href="{{ route("department.delete", ["id" => $department["id"]]) }}" class="btn btn-sm btn-outline-dark"><i class="fa-regular fa-trash-can me-2"></i>Deletar</a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        @endif
    </div>

</x-layout-app>
