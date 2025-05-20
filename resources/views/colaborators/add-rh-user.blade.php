<x-layout-app pageTitle="Novo Colaborador RH">

    <div class="w-40 p-4">

        <h3>Novo Colaborador (Recursos Humanos)</h3>

        <hr>

        <form action="{{ route("rh_user.create_colaborator") }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="container-fluid">
                <div class="row gap-3">

                    <div class="col border border-black p-4">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                            @error("name")
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                            @error("email")
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div class="d-flex">
                                <div class="flex-grow-1 pe-3">

                                    <label for="select_department" class="form-label">Departamento</label>
                                    <select name="select_department" class="form-select" id="select_department">
                                        @foreach ($departments as $department)
                                            @if($department["id"] == 2)
                                                <option value="{{ $department["id"] }}">{{ $department["name"] }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error("select_department")
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror

                                </div>

                                <div>
                                    <a href="{{ route("department.add_department") }}" class="btn btn-outline-primary mt-4"><i class="fas fa-plus"></i></a>
                                </div>
                            </div>
                        </div>

                        <p class="mb-3">Perfil: <strong>Recursos Humanos</strong></p>
                    </div>

                    <div class="border border-black p-4">
                        <div class="mb-3">
                            <label for="address" class="form-label">Endereço</label>
                            <input type="text" class="form-control" id="address" name="address" value="{{ old("address") }}">
                            @error("address")
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="zip_code" class="form-label">CEP</label>
                                    <input type="text" class="form-control" id="zip_code" name="zip_code" value="{{ old("zip_code") }}">
                                    @error("zip_code")
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col">
                                <div class="mb-3">
                                    <label for="city" class="form-label">Cidade</label>
                                    <input type="text" class="form-control" id="city" name="city" value="{{ old("city") }}">
                                    @error("city")
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col">
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Telefone</label>
                                    <input type="number" class="form-control" id="phone" name="phone" value="{{ old("phone") }}">
                                    @error("phone")
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col">
                                <div class="mb-3">
                                    <label for="salary" class="form-label">Salário</label>
                                    <input type="number" class="form-control" id="salary" name="salary" step="0.01" placeholder="0,00" value="{{ old("salary") }}">
                                    @error("salary")
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col">
                                <div class="mb-3">
                                    <label for="admission_date" class="form-label">Data de admissão</label>
                                    <input type="text" class="form-control" id="admission_date" name="admission_date" placeholder="YYYY-mm-dd" value="{{ old("admission_date") }}">
                                    @error("admission_date")
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="col border border-black p-4">
                        <h4>Imagem de perfil</h4>
                        <hr>
                        <div class="wrapper d-flex justify-content-start align-items-center">
                            <div class="image position-relative" style="width: 150px; height: 150px;">
                            <img src="{{ url("storage/users/default.png") }}"
                                class="w-100 h-100 object-fit-cover rounded-circle border border-3 border-white"
                                id="image"
                                alt="profile image">

                            <label for="file_image_path"
                                    class="position-absolute bottom-0 end-0 translate-middle d-flex justify-content-center align-items-center rounded-circle border border-2 border-white"
                                    style="width: 40px; height: 40px; background-color: #0d6efd; cursor: pointer;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="white" class="bi bi-camera" viewBox="0 0 16 16">
                                        <path d="M15 12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1h1.172a3 3 0 0 0 2.12-.879l.83-.828A1 1 0 0 1 6.827 3h2.344a1 1 0 0 1 .707.293l.828.828A3 3 0 0 0 12.828 5H14a1 1 0 0 1 1 1zM2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4z"/>
                                        <path d="M8 11a2.5 2.5 0 1 1 0-5 2.5 2.5 0 0 1 0 5m0 1a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7M3 6.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0"/>
                                    </svg>
                            </label>

                            <input type="file"
                                    name="file_image_path"
                                    id="file_image_path"
                                    class="d-none"
                                    accept="image/jpeg,image/png,image/jpg">
                            </div>
                        </div>
                        @error("file_image_path")
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>


                 <div class="mb-3 mt-2">
                    <a href="{{ route("rh_users") }}" class="btn btn-outline-danger">Voltar</a>
                    <button type="submit" class="btn btn-primary">Criar colaborador</button>
                </div>

            </div>
        </form>

    </div>

    <script>
        const img_elem = document.querySelector("#image");
        const file_img = document.querySelector("#file_image_path");

        file_img.onchange = function () {
            img_elem.src = URL.createObjectURL(file_img.files[0]);
        }
    </script>

</x-layout-app>
