@extends('templates.templateLogin') 
@section('title', 'cadastro de usúario')
@section('content')
   <div class="form-box">
        <h1 class="text-center">Crie sua conta:</h1>
        <form action="{{route('user.store')}}" method="post">
            @csrf
             
            <div class="form-group">
                <label for="firstName">Nome:</label>
                <input type="text" name="firstName" id="firstName" class="form-control">
            </div>
            <div class="form-group">
                <label for="lastName">Sobrenome:</label>
                <input type="text" name="lastName" id="lastName" class="form-control">
            </div>
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" name="email" id="email" class="form-control">
            </div>
            <div class="form-group">
                <label for="password">Crie uma senha:</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>
            <div class="form-group">
                <label for="remember">Lembrar-me</label>
                <input type="checkbox" name="remember" id="remember">
            </div>
            <button class="btn btn-success mt-4 form-control">Criar</button>
        </form>
   </div>


@endsection