<div class="d-flex justify-content-between bg-color-1 text-white py-1 px-3">
    <div class="d-flex align-items-center">
        <a href="{{ route("home") }}">
            <img src="{{ asset("assets/images/favicon.png") }}" alt="logo" width="50px" class="img-fluid">
        </a>
        <h4 class="ms-3 text-primary-white m-0 p-0">
            {{ config("app.name") }}
        </h4>
    </div>

    <div class="d-flex align-items-center">
        {{-- <i class="fas fa-user-circle me-3"></i> --}}
        <div class="d-flex justify-content-start gap-5 align-items-center">
            @if (auth()->user()->image)
                @php
                    $image = auth()->user()->image;    
                @endphp
                <img src="{{ url("storage/{$image}") }}" class="rounded-circle d-block me-3 text-white" style="width: 30px; height: 30px; object-fit: cover;" alt="profile_{{auth()->user()->name}}">
            @else
                <img src="{{ url("storage/users/default.png") }}" class="rounded-circle me-2 d-block" style="width: 30px; height: 30px; object-fit: cover; filter: invert(1);" alt="profile_{{auth()->user()->name}}">
            @endif
        </div>
        <a href="{{ route("user.profile") }}" class="text-primary-white me-3">
            {{ auth()->user()->name }}
        </a>
        <form action="{{ route("logout") }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-sm btn-danger">
                <i class="fas fa-sign-out-alt"></i>
            </button>
        </form>
    </div>
</div>
