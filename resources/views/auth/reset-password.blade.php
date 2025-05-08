<x-layout-guest page-title="Recuperar senha">
    <div class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-5">
                <div class="text-center mb-5">
                    <img src="{{ asset("assets/images/logo.png") }}" alt="logo" width="200px">
                </div>

                <div class="card p-5">
                    <form action="{{ route("password.update") }}" method="POST">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="mb-3">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control">
                            @error("email")
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password">Senha</label>
                            <input type="password" name="password" id="password" class="form-control">
                            @error("password")
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation">Confirme sua senha</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                            @error("password_confirmation")
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-center align-items-center">
                            <button type="submit" class="btn btn-primary px-4">Salvar</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-layout-guest>
