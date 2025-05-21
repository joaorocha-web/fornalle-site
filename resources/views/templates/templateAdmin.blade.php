<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/admin.css">
    <title>@yield('title')</title>
</head>
<body>
    <header>
        <div class="header">
            <h1>Fornalle Tratoria</h1>
            <p>Área administrativa</p> 
            <button class="btn btn-success btn-sm"><a href="{{route('main')}}">view</a></button>
    </header>
    <main>
        @yield('content')
    </main>
    <footer>

    </footer>
</body>
</html>