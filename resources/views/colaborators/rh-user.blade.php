<x-layout-app pageTitle="Colaboradores RH">

    <div class="w-100 p-4">

        <h3>Recursos Humanos</h3>

        <hr>

        @if($colaborators->count() === 0)
            <div class="text-center my-5">
                <p>Nenhum colaborador encontrado.</p>
                <a href="{{ route("rh_user.add_colaborator") }}" class="btn btn-primary">Criar um novo colaborador</a>
            </div>
        @else
            <div class="mb-3">
                <a href="{{ route("rh_user.add_colaborator") }}" class="btn btn-primary">Criar um novo colaborador</a>
            </div>

            <table class="table" id="table">
                <thead class="table-dark">
                    <th>Colaborador</th>
                    <th>E-mail</th>
                    <th>Função</th>
                    <th>Permissões</th>
                    <th>Salário</th>
                    <th>Data de Adimissão</th>
                    <th>Cidade</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($colaborators as $colaborator)
                        <tr class="table-light">
                            <td>[{{ $colaborator["name"] }}]</td>
                            <td>{{ $colaborator["email"] }}</td>
                            <td>{{ $colaborator["role"] }}</td>

                            @php
                                $permissions = json_decode($colaborator["permissions"]);   
                            @endphp

                            <td>{{ implode(", ", $permissions) }}</td>
                            <td>R$ {{ $colaborator->detail->salary }}</td>
                            <td>{{ $colaborator->detail->admission_date }}</td>
                            <td>{{ $colaborator->detail->city }}</td>

                            <td>
                                <div class="d-flex gap-3 justify-content-end">
                                        <a href="{{ route("rh_user.edit_rh_user", ["id" => $colaborator->id]) }}" class="btn btn-sm btn-outline-dark"><i class="fa-regular fa-pen-to-square me-2"></i>Editar</a>
                                        <a href="{{ route("rh_user.delete", ["id" => $colaborator->id]) }}" class="btn btn-sm btn-outline-dark"><i class="fa-regular fa-trash-can me-2"></i>Deletar</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        @endif
    </div>

</x-layout-app>

