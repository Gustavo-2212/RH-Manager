<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="user-id" content="{{ auth()->id() }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ env("APP_NAME") }} @isset($pageTitle) - {{ $pageTitle }} @endisset</title>

    <link rel="icon" href="{{ asset("assets/images/favicon.png") }}" type="image/png">
    <link rel="stylesheet" href="{{ asset("assets/bootstrap/bootstrap.min.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/css/main.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/datatables/datatables.min.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/fontawesome/css/all.min.css") }}">
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.css" rel="stylesheet"> --}}

</head>
<body>

    <x-user-bar />

    <div class="d-flex">

        <x-sidebar />

        {{ $slot }}

    </div>

    <script src="{{ asset("assets/bootstrap/bootstrap.bundle.min.js") }}"></script>
    <script src="{{ asset("assets/datatables/jquery.min.js") }}"></script>
    <script src="{{ asset("assets/datatables/datatables.min.js") }}"></script>
    <script src="{{ asset("assets/js/main.js") }}"></script>
    {{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.js"></script> --}}

    @vite(['resources/js/chat-loader.js'])

</body>
</html>
