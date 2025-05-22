@extends('templates.template')
@section('title', 'carrinho')
@section('content')
  
        <div class="out-cart">
            <div class="my-cart">
                <h2 class="text-center"><i class="bi bi-cart-plus "></i> Seu Pedido:</h2>
                @foreach ($cart as $id => $item)
                  <div class="items">
                    <span>
                        {{$item['name']}} - R$
                        {{number_format($item['price'], 2, ',', '.')}} 
                        [{{$item['quantity']}}]
                    </span>
                    <div class="space"></div>
                        <form action="{{route('cart.remove', ['id' => $id])}}" method="POST">
                            @csrf 
                            @method('DELETE')
                        <button type="submit" class="cancel">Cancelar</button>
                    </form>
                  </div>
                  
                @endforeach
                <p><strong>Total: R${{$total}}</strong></p>
                <a class="back" href="{{route('main')}}">Voltar</a>
                <a class="order" href="{{route('main')}}"> Finalizar  Pedido</a>
            </div>
        </div>
 @endsection