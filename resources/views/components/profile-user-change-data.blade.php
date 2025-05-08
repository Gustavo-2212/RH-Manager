<div class="col-3">
    <div class="border p-5 shadow-sm">
        <form action="{{ route("user.profile.change_data") }}" method="POST">
            @csrf

            <h3>Alterar dados</h3>

            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input type="text" name="name" id="name" class="form-control">
                @error("name")
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" name="email" id="email" class="form-control">
            </div>

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
