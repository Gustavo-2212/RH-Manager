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
                            
                            <td class="align-middle">
                                <div class="d-flex justify-content-start gap-5 align-items-center">
                                    @if ($colaborator->image)
                                        <img src="{{ url("storage/{$colaborator->image}") }}" class="rounded-circle d-block" style="width: 60px; height: 60px; object-fit: cover;" alt="profile_{{$colaborator->name}}">
                                    @else
                                        <img src="{{ url("storage/users/default.png") }}" class="rounded-circle d-block" style="width: 60px; height: 60px; object-fit: cover;" alt="profile_{{$colaborator->name}}">
                                    @endif
                                    [{{ $colaborator["name"] }}]
                                </div>
                            </td>
                            <td class="align-middle">{{ $colaborator["email"] }}</td>
                            <td class="align-middle">{{ $colaborator["role"] }}</td>

                            @php
                                $permissions = json_decode($colaborator["permissions"]);
                            @endphp

                            <td class="align-middle">{{ implode(", ", $permissions) }}</td>
                            <td class="align-middle">R$ {{ $colaborator->detail->salary }}</td>
                            <td class="align-middle">{{ $colaborator->detail->admission_date }}</td>
                            <td class="align-middle">{{ $colaborator->detail->city }}</td>

                            <td class="align-middle">
                                <div class="d-flex gap-1 justify-content-end">
                                    @if(empty($colaborator->deleted_at))
                                        <a href="{{ route("rh_user.edit_rh_user", ["id" => $colaborator->id]) }}" class="btn btn-sm btn-outline-dark"><i class="fa-regular fa-pen-to-square me-2"></i>Editar</a>
                                        <a href="{{ route("rh_user.delete", ["id" => $colaborator->id]) }}" class="btn btn-sm btn-outline-dark"><i class="fa-regular fa-trash-can me-2"></i>Deletar</a>
                                        
                                    @else
                                        
                                            <a href="{{ route("rh_user.restore", ["id" => $colaborator->id]) }}" class="btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash-arrow-up me-2"></i>Restaurar</a>
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

