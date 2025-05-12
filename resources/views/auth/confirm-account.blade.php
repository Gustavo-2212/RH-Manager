<x-layout-guest pageTitle="Criação de senha">

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-4">
                <div class="text-center mb-5">
                    <img src="{{ asset("assets/images/logo.png") }}" alt="logo" width="200px">
                </div>

                <div class="card p-5">
                    <form action="{{ route("confirm_account_submit") }}" method="POST">
                        @csrf

                        <input type="hidden" id="token" name="token" value="{{ $user->confirmation_token }}" >

                        <div class="mb-3">
                            <label for="password">Senha</label>
                            <input type="password" name="password" id="password" class="form-control">

                            @error("password")
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation">Confirmar Senha</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">

                            @error("password_confirmation")
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end align-items center">
                            <button type="submit" class="btn btn-primary px-4">Confirmar</button>
                        </div>
                    </form>

                    {{-- Senha redefinida com sucesso --}}
                    @if(session("status"))
                        <div class="alert alert-success mt-3 text-center">
                            <p>{{ session("status") }}</p>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

</x-layout-guest>

