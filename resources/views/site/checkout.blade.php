@extends('templates.template')
@section('title', 'carrinho')
@section('content')
<style>
    @media (min-width:900px){
         body{
            height: 100vh;
            display: grid;
            grid-template-rows:  180px 1fr 30px;
            grid-template-columns: 1fr;
            grid-template-areas: "header" "content" "footer";
        }
    }
   
</style>

    <h2 class="text-center mt-3">Preencha essas informações:</h2>
    <div class="d-flex justify-content-center">
        <form action="{{route('checkout.finish')}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Nome:</label>
                <input type="text" name="name" id="name" value="{{auth()->user()->name}} {{auth()->user()->last_name}}" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="number">Celular:</label>
                <input type="tel" name="number" id="number" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="neighborhood">Bairro: </label>
                <input type="text" name="neighborhood" id="neighborhood" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="adress">Rua: </label>
                <input type="text" name="adress" id="adress" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="adress-number">Número: </label>
                <input type="text" name="adress-number" id="adress-number" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="adress-details">Complemento: </label>
                <input type="text" name="adress-details" id="adress-details" class="form-control" required>
            </div>
           
            <div class="form-group">
                <label for="payment_method">Escolha a forma de pagamento</label>
                <select name="payment_method" id="payment_method" class="form-control" required>
                    <option value="Pix" >Pix</option>
                    <option value="Cartão" >Cartão</option>
                    <option value="Dinheiro">Dinheiro</option>
                </select>
            </div>
            <button class="btn btn-success my-3 form-control">Enviar Pedido</button>
        
        </form>
    </div>
        
 @endsection