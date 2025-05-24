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

    <h2>Preencha essas informações:</h2>
    <div class="d-flex justify-content-center">
        <form action="#" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Nome:</label>
                <input type="text" name="name" id="name" value="{{auth()->user()->name}}" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="number">Celular:</label>
                <input type="tel" name="number" id="number" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="adress">Endereço</label>
                <input type="text" name="adress" id="adress" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="payment-method">Escolha a forma de pagamento</label>
                <select name="payment-method" id="payment-method" class="form-control" required>
                    <option value="">Pix</option>
                    <option value="">Cartão</option>
                    <option value="">Dinheiro</option>
                </select>
            </div>
            <button class="btn btn-success mt-3 form-control">Enviar Pedido</button>
        
        </form>
    </div>
        
 @endsection