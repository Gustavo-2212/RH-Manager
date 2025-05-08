<x-layout-guest page-title="Recuperar senha">

    <div class="container mt-5">

        <div class="row justify-content-center">
            <div class="col-5">

                @if(!session("status"))

                    <div class="text-center mb-5">
                        <img src="{{ asset("assets/images/logo.png") }}" width="200px" alt="logo" />
                    </div>

                    <div class="card p-5">
                        <p>Informe seu email para a recuperação da sua senha. Assim que clicar no botão, verifique sua caixa de email.</p>

                        <form action="{{ route("password.email") }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="email">Email:</label>
                                <input type="email" name="email" id="email" class="form-control"/>
                                @error("email")
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="d-flex mb-3 justify-content-between align-items-center">
                                <a href="{{ route("login") }}">Lembrei da minha senha</a>
                                <button type="submit" class="btn btn-primary px-4">Recuperar</button>
                            </div>
                        </form>

                    </div>

                @else
                    <div class="text-center mb-5">
                        <p class="mb-5">Verifique sua caixa de email!</p>
                        <a href="{{ route("login") }}" class="btn btn-primary px-4">Voltar</a>
                    </div>
                @endif
            </div>
        </div>

    </div>

</x-layout-guest>
