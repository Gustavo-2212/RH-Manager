<div class="col-3">
    <div class="border p-5 shadow-sm">
        <form action="{{ route("user.profile.change_data") }}" method="POST" enctype="multipart/form-data">
            @csrf

            <h3>Alterar dados</h3>

            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old("name", $colaborator->name) }}">
                @error("name")
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old("email", $colaborator->email) }}">
                @error("email")
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <x-profile-user-change-image :image="$colaborator->image"/>
                @error("file_image_path")
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Alterar</button>
            </div>

        </form>

        @if(session("success_change_data"))
            <div class="alert alert-success mt-3">
                {{ session("success_change_data") }}
            </div>
        @endif

    </div>
</div>
