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

  
        <div class="out-cart">
            <div class="my-cart">
                <h2 class="text-center"><i class="bi bi-cart-plus "></i> Seu Pedido:</h2>
                @foreach ($cart as $id => $item)
                  <div class="items" data-item-id="{{ $id }}">
                    <span>
                        {{$item['name']}} - R$
                        {{number_format($item['price'], 2, ',', '.')}} 
                        [<span class="item-quantity">{{$item['quantity']}}</span>]
                    </span>
                    <div class="space"></div>
                        <button class="cancel remove-item" data-item-id="{{ $id }}">Cancelar</button>
                  </div>
                  
                  
                @endforeach
                <p><strong class="valor-total">Total: R$<span id="cart-total">{{$total}}</span></strong></p>
                <a class="back" href="{{route('main')}}">Voltar</a>
                <a class="order" href="{{route('main')}}"> Finalizar  Pedido</a>
            </div>
        </div>

        <script>
            document.querySelectorAll('.remove-item').forEach(button => {
                button.addEventListener('click', async (e) => {
                    const itemId = button.dataset.itemId;
                    const itemElement = button.closest('.items');

                    try {
                        button.disabled = true;
                        button.textContent = 'Removendo...';

                        const response = await fetch(`/cart/remove/${itemId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                'Accept': 'application/json'
                            }
                        });

                        if (!response.ok) throw new Error('Falha ao remover item');

                        const data = await response.json();

                        // Atualiza a interface
                        document.getElementById('cart-total').textContent = 
                            Number(data.total).toLocaleString('pt-BR', {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2
                            });

                        data.quantity > 0 ?
                            itemElement.querySelector('.item-quantity').textContent = data.quantity :
                            itemElement.remove();

                        Toast.show('Item atualizado ✔️');

                    } catch (error) {
                        Toast.show('Erro ao remover ❌', false);
                    } finally {
                        button.disabled = false;
                        button.textContent = 'Cancelar';
                    }
                });
            });
        </script>
 @endsection