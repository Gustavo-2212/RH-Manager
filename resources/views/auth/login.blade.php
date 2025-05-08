<x-layout-guest pageTitle="Login">

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-4">
                <div class="text-center mb-5">
                    <img src="{{ asset("assets/images/logo.png") }}" alt="logo" width="200px">
                </div>

                <div class="card p-5">
                    <form action="{{ route("login") }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="email">

                            @error("email")
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control">

                            @error("password")
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between align-items center">
                            <a href="{{ route("password.request") }}">Esqueceu sua senha?</a>
                            <button type="submit" class="btn btn-primary px-4">Login</button>
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
