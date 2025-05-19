<x-layout-app pageTitle="Editar Colaborador RH">

    <div class="w-40 p-4">

        <h3>Editar Colaborador</h3>

        <hr>

        <div class="d-flex gap-5">
            <p>Colaborador: <strong>{{ $colaborator->name }}</strong></p>
            <p>E-mail: <strong>{{ $colaborator->email }}</strong></p>
        </div>

        <form action="{{ route("rh_user.management.update_colaborator") }}" method="post">
            @csrf

            <input type="hidden" id="id" name="id" value="{{ $colaborator->id }}" />

            <div class="container-fluid">
                <div class="row gap-3">

                    <div class="col border border-black p-4">

                            <div class="col">
                                <div class="mb-3">
                                    <label for="salary" class="form-label">Salário</label>
                                    <input type="number" class="form-control" id="salary" name="salary" step="0.01" placeholder="0,00" value="{{ old("salary", $colaborator->detail->salary) }}">
                                    @error("salary")
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col">
                                <div class="mb-3">
                                    <label for="admission_date" class="form-label">Data de admissão</label>
                                    <input type="text" class="form-control" id="admission_date" name="admission_date" placeholder="YYYY-mm-dd" value="{{ old("admission_date", $colaborator->detail->admission_date) }}">
                                    @error("admission_date")
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col">
                                <div class="mb-3">
                                    <label for="select_department" class="form-label">Departamento</label>
                                    <select class="form-select" name="select_department" id="select_department">
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->id }}" {{ $colaborator->department_id == $department->id ? "selected" : "" }}>{{ $department->name }}</option>
                                        @endforeach
                                    </select>
                                    @error("selected_department")
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                    </div>

                </div>

                 <div class="mb-3 mt-2">
                    <a href="{{ route("rh_user.management.colaborators") }}" class="btn btn-outline-danger">Voltar</a>
                    <button type="submit" class="btn btn-primary">Editar colaborador</button>
                </div>

            </div>
        </form>

    </div>

</x-layout-app>

