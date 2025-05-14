<x-layout-app pageTitle="Colaboradores">
    <div class="w-100 p-4">

        <h3>Colaboradores</h3>

        <hr>

        @if($colaborators->count() === 0)
            <div class="text-center my-5">
                <p>Nenhum colaborador encontrado.</p>
            </div>
        @else
            <table class="table" id="table">
                <thead class="table-dark">
                    <th>Colaborador</th>
                    <th>E-mail</th>
                    <th>Função</th>
                    <th>Ativo</th>
                    <th>Departamento</th>
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

                            <td>
                                @empty($colaborator->email_verified_at)
                                    <span class="badge bg-danger">Não</span>
                                @else
                                    <span class="badge bg-success">Sim</span>
                                @endif
                            </td>

                            <td>{{ $colaborator->department->name }}</td>
                            <td>R$ {{ $colaborator->detail->salary }}</td>
                            <td>{{ $colaborator->detail->admission_date }}</td>
                            <td>{{ $colaborator->detail->city }}</td>

                            <td>
                                <div class="d-flex gap-3 justify-content-end">
                                    @if(empty($colaborator->deleted_at)) 
                                        <a href="{{ route("colaborator.detail", ["id" => $colaborator->id]) }}" class="btn btn-sm btn-outline-dark"><i class="fas fa-eye me-2"></i>Detalhes</a>
                                        <a href="{{ route("colaborator.delete", ["id" => $colaborator->id]) }}" class="btn btn-sm btn-outline-dark"><i class="fa-regular fa-trash-can me-2"></i>Deletar</a>
                                    @else
                                        <a href="{{ route("colaborator.restore", ["id" => $colaborator->id]) }}" class="btn btn-sm btn-outline-danger"><i class="fa-solid"></i>Restaurar</a>
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
