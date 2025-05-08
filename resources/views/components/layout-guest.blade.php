<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env("APP_NAME") }} @isset($pageTitle) - {{ $pageTitle }} @endisset</title>

    <link rel="icon" href="{{ asset("assets/images/favicon.png") }}" type="image/png">
    <link rel="stylesheet" href="{{ asset("assets/bootstrap/bootstrap.min.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/css/main.css") }}">
</head>
<body>

    {{ $slot }}

    <script src="{{ asset("assets/bootstrap/bootstrap.bundle.min.js") }}"></script>

</body>
</html>
