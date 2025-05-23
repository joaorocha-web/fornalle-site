@extends('templates.templateLogin') 
@section('title', 'cadastro de usúario')
@section('content')
    <div class="card">
        <div class="card-header p-2 d-flex justify-content-center "><h1>Login</h1></div>
        <div class="card-body">
            
                <form name="test">
                    @csrf
                    <label for="email">E-mail:</label>
                    <input type="email" name="email" id="email" placeholder="Insira seu e-mail" class="form-control">
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" placeholder="Insira sua senha" class="form-control">
                    <label for="remember">Lembrar-me</label>
                    <input type="checkbox" name="remember" id="remember">           
                    <div class="d-flex flex-column">
                        <button class="btn btn-danger mt-3">Entrar</button>
                        
                           <div class=" d-none text-danger text-center mt-2 message-box">
                               
                           </div>
                        
                        <a class="text-success mt-3" href="{{route('user.register')}}">Cadastre-se</a>
                    </div>
                </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>

    <script>
        $(function(){
            $('form[name="test"]').submit(function(event){
                event.preventDefault()
                $.ajax({
                    url: "{{route('verifyLogin')}}",
                    type: "post",
                    data:$(this).serialize(),
                    dataType: 'json',
                    success: function (response){
                        if(response.success === true){
                            //redirecionar
                            window.location.href = "{{route('pizza.index')}}"
                        }else{
                            $('.message-box').removeClass('d-none').html(response.message)
                        }
                    }
                })
            })
        })
        // action="{{route('verifyLogin')}}" method="POST"
    </script>
@endsection