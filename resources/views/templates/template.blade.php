<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/general.css">
    <title>@yield('title')</title>
</head>
<body>
    <header>
        <i class="bi bi-list" id="open-menu"></i>
        <menu id="menu">
            <div>
                <i class="bi bi-list" id="close-menu"></i>
            </div>
            <ul id="links">
                @if (auth()->user())
                <li>{{auth()->user()->name}}</li>
                @endif
                <li><a href="{{route('pizza.index')}}">Area Adm</a></li>
                <li><a href="{{route('login')}}">Entrar</a></li>
                <li><a href="#sweet">Doces</a></li>
                <li><a href="#special">Especiais</a></li>
            </ul>
        </menu>
        
        <div class="boas-vindas">
            <h1>Fornalle Tratoria</h1>
            <p>Um pedaço da Itália perto de você</p> 
        </div>  
          
    </header>
    <main>
        <div class="cart">
            <div class="ico-Cart">
                <i class="bi bi-cart-plus "></i>
                <div class="qtd">1</div>
            </div>
        </div>
        @yield('content')
    </main>
    <footer>

    </footer>
    <script src="js/app.js"></script>
</body>
</html>