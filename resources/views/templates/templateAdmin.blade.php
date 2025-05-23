<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/admin.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
</head>
<body>
    <header>
        <div class="header">
             <a class="logout" href="{{route('logout')}}"><i class="bi bi-box-arrow-right"></i> Sair</a>
             <a class="view" href="{{route('main')}}"><i class="bi bi-eye"></i> View</a>
            <h1>Fornalle Tratoria</h1>
            <p>Área administrativa</p> 
            
    </header>
    <nav class="nav">
            <a href="{{route('pizza.index')}}">Cadastro de Pizzas</a>
            <a href="{{route('adm.register')}}">Cadastro de Adm</a>
    </nav>
    <main>
        
        @yield('content')
    </main>
    <footer>

    </footer>
    
</body>
</html>