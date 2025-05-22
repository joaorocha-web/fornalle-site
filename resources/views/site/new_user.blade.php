@extends('templates.templateLogin') 
@section('title', 'cadastro de usúario')
@section('content')
   <div class="form-box">
        <h1 class="text-center">Crie sua conta:</h1>
        <form action="{{route('user.store')}}" method="post">
            @csrf
             
            <div class="form-group">
                <label for="name">Nome:</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="last_name">Sobrenome:</label>
                <input type="text" name="last_name" id="last_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Crie uma senha:</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="remember_token">Lembrar-me</label>
                <input type="checkbox" name="remember_token" id="remember_token">
            </div>
            <button class="btn btn-success mt-4 form-control">Criar</button>
        </form>
   </div>


@endsection