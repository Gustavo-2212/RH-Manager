<div class="col-6">
    <div class="border p-5 shadow-sm">
        <form action="{{ route("user.profile.change_details") }}" method="POST">
            @csrf

            <h3>Alterar detalhes</h3>

            <div class="mb-3">
                <label for="address" class="form-label">Endereço</label>
                <input type="text" name="address" id="address" class="form-control" value="{{ old("address", $colaborator->detail->address) }}">
                @error("address")
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex gap-3">
            <div class="mb-3">
                <label for="zip_code" class="form-label">CEP</label>
                <input type="text" name="zip_code" id="zip_code" class="form-control" value="{{ old("zip_code", $colaborator->detail->zip_code) }}">
                @error("zip_code")
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="city" class="form-label">Cidade</label>
                <input type="text" class="form-control" id="city" name="city" value="{{ old("city", $colaborator->detail->city) }}">
                @error("city")
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Telefone</label>
                <input type="number" class="form-control" id="phone" name="phone" value="{{ old("phone", $colaborator->detail->phone) }}">
                @error("phone")
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="salary" class="form-label">Salário</label>
                <input type="number" class="form-control" id="salary" name="salary" step="0.01" placeholder="0,00" value="{{ old("salary", $colaborator->detail->salary) }}">
                @error("salary")
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="admission_date" class="form-label">Data de admissão</label>
                <input type="text" class="form-control" id="admission_date" name="admission_date" placeholder="YYYY-mm-dd" value="{{ old("admission_date", $colaborator->detail->admission_date) }}">
                @error("admission_date")
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Alterar</button>
            </div>

        </form>

        @if(session("success_change_details"))
            <div class="alert alert-success mt-3">
                {{ session("success_change_details") }}
            </div>
        @endif

    </div>
</div>
