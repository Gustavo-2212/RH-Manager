<div class="col-3">
    <div class="border p-5 shadow-sm">
        <form action="{{ route("user.profile.change_password") }}" method="POST">
            @csrf

            <h3>Alterar a senha</h3>

            <div class="mb-3">
                <label for="current_password" class="form-label">Senha atual</label>
                <input type="password" name="current_password" id="current_password" class="form-control">
            </div>
            @error("currrent_password")
                <div class="text-danger">{{ $message }}</div>
            @enderror

            <div class="mb-3">
                <label for="new_password" class="form-label">Nova senha</label>
                <input type="password" name="new_password" id="new_password" class="form-control">
            </div>
            @error("password")
                <div class="text-danger">{{ $message }}</div>
            @enderror

            <div class="mb-3">
                <label for="new_password_confirmation" class="form-label">Confirme a nova senha</label>
                <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control">
            </div>
            @error("new_password_confirmation")
                <div class="text-danger">{{ $message }}</div>
            @enderror

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Alterar</button>
            </div>

        </form>

        @if(session("error"))
            <div class="alert alert-danger mt-3">
                {{ session("error") }}
            </div>
        @endif

        @if(session("success"))
            <div class="alert alert-success mt-3">
                {{ session("success") }}
            </div>
        @endif

    </div>
</div>
