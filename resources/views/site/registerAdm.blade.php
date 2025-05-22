   @extends('templates.templateAdmin') 
   @section('title', 'cadastro')
   @section('content')
   
    <div class="container mt-3">
        <div class=" row">
        
            <h3 class="text-center text-black">Cadastro de Administrador:</h3>
            <p class="text-danger text-center">Tal cadastro dará permissão total ao usuário</p>
        <form action="{{route('adm.store')}}" method="post">
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
                <label for="remember">Lembrar-me</label>
                <input type="checkbox" name="remember" id="remember" value="1">
            </div>
            <button class="btn btn-success mt-4 form-control">Criar</button>
        </form>
        </div>
    </div>

    @endsection