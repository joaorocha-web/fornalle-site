@extends('templates.templateLogin') 
@section('title', 'cadastro de usúario')
@section('content')

    <div class="card">
        <div class="card-header p-2 d-flex justify-content-center "><h1>Login</h1></div>
        <div class="card-body">
            
                <form action="{{route('verifyLogin')}}" method="POST">
                    @csrf
                    <label for="email">E-mail:</label>
                    <input type="email" name="email" id="email" placeholder="Insira seu e-mail" class="form-control">
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" placeholder="Insira sua senha" class="form-control">
                    <label for="remember">Lembrar-me</label>
                    <input type="checkbox" name="remember" id="remember">           
                    <div class="d-flex flex-column">
                        <button class="btn btn-danger mt-3">Entrar</button>
                        @if (session('error'))
                           <p class="mt-2 text-danger">{{session('error')}}</p>
                        @endif
                        <a class="text-success mt-3" href="{{route('user.register')}}">Cadastre-se</a>
                    </div>
                </form>
        </div>
    </div>
@endsection