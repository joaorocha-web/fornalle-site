@extends('templates.template')
@section('title', 'fornalle')
@section('content')
    
    @foreach ($categories as $category)
        <section class="category-{{$category}}">
            <h2>{{$category}}</h2>
            <div class="pizzas">
                @foreach ($pizzas->where('category', $category) as $pizza)
                
                        <div class="pizza {{$category}}">
                        <img class="img-pizza" src="{{asset("storage/{$pizza->image_url}")}}" alt="">
                        <div class="description">
                            <h3>{{$pizza->name}}</h3>
                            <p>{{$pizza->description}}</p>
                            <div>
                                <strong>
                                    <p>R${{number_format($pizza->price, 2, ',', '.')}}</p>
                                </strong>
                                    <form class="add-to-cart-form" data-pizza-id="{{ $pizza->id }}">
                                        @csrf
                                        <button type="submit" class="btn btn-success mb-3">
                                            <i class="fas fa-cart-plus"></i> Pedir
                                        </button>
                                    </form>
                            </div>
                        </div>
                        </div>
                
                @endforeach
            </div>
        </section>

    @endforeach
    
    <div class="cart">
            <div class="ico-Cart">
                <a href="{{route('cart.show')}}"><i class="bi bi-cart-plus "></i></a>
                <div class="qtd cart-counter">
                    {{session()->get('total', 0)}}
                </div>
            </div>
        </div>
    

   <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Configuração do Toast (opcional)
            const Toast = {
                show: (message) => {
                    const toast = document.createElement('div');
                    toast.className = 'toast-message';
                    toast.textContent = message;
                    document.body.appendChild(toast);
                    setTimeout(() => toast.remove(), 2000);
                }
            };

            // Manipula o envio do formulário
            document.querySelectorAll('.add-to-cart-form').forEach(form => {
                form.addEventListener('submit', async (e) => {
                    e.preventDefault();
                    const button = form.querySelector('button');
                    const originalText = button.innerHTML;
                    const pizzaId = form.dataset.pizzaId;

                    try {
                        button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Adicionando...';
                        
                        const response = await fetch(`/cart/${pizzaId}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            }
                        });

                        if (!response.ok) throw new Error('Falha ao adicionar');
                        
                        const data = await response.json();
                        
                        // Atualiza o contador
                        document.querySelector('.cart-counter').textContent = data.total;
                        
                        // Feedback visual
                        Toast.show('Item adicionado ao carrinho! ✔️');
                        
                    } catch (error) {
                        Toast.show('Erro ao adicionar item! ❌');
                        console.error(error);
                    } finally {
                        button.innerHTML = originalText;
                    }
                });
            });
        });
    </script>
 
        

@endsection