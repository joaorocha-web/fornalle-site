<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="css/login.css">
    <title>Login</title>
</head>
<body>
    <div class="card shadow">
        <div class="card-header p-2 d-flex justify-content-center "><h1>Login</h1></div>
        <div class="card-body">
            
                <form action="{{route('verifyLogin')}}" method="POST">
                    @csrf
                    <label for="email">E-mail:</label>
                    <input type="email" name="email" id="email" placeholder="Insira seu e-mail" class="form-control">
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" placeholder="Insira sua senha" class="form-control">
                                
                    <button class="btn btn-danger mt-3">Entrar</button>
                    @if (session('error'))
                       <p class="mt-2 text-danger">{{session('error')}}</p>
                    @endif
                </form>
        </div>
    </div>
</body>
</html>