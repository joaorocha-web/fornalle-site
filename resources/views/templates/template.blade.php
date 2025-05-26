<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/general.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
</head>
<body>
    <header>
        @if (auth()->user())
                <div class="user-logged">
                   <i class="bi bi-person-circle"></i> {{auth()->user()->name}} 
                </div>
        @endif
        <i class="bi bi-list" id="open-menu"></i>
        <menu id="menu">
            <div>
                <i class="bi bi-list" id="close-menu"></i>
            </div>
            <ul id="links">
                {{-- @can('area-admin') --}}
                <li><a href="{{route('pizza.index')}}">Area Adm</a></li>    
                {{-- @elseif(!auth()->user()) --}}
                <li><a href="{{route('login')}}">Entrar</a></li>   
                {{-- @endcan                --}}
                <li><a href="#sweet">Doces</a></li>
                <li><a href="#special">Especiais</a></li>
            </ul>
        </menu>
        
        <div class="boas-vindas">
            <h1>Fornalle Tratoria</h1>
            <p>Um pedaço da Itália perto de você</p> 
        </div>  
        @if (session('error'))
          <div class="error">{{session('error')}}</div>
        @endif
    </header>
    <main>
        
        @yield('content')
    </main>
    <footer>

    </footer>
    <script src="js/app.js"></script>
</body>
</html>