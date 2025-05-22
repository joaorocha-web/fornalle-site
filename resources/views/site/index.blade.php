@extends('templates.template')
@section('title', 'fornalle')
@section('content')
    <section id="traditional">
        <h2>Tradicionais</h2>
        <div class="pizzas">
            @foreach ($pizzas as $pizza)
                @if ($pizza->category === 'Tradicional' && $pizza->status === 'ativo')
                    <div class="pizza">
                    <img class="img-pizza" src="{{asset("storage/{$pizza->image_url}")}}" alt="">
                    <div class="description">
                        <h3>{{$pizza->name}}</h3>
                        <p>{{$pizza->description}}</p>
                        <div>
                            <strong>
                                <p>R${{number_format($pizza->price, 2, ',', '.')}}</p>
                            </strong>
                                <button type="submit" class="btn btn-success mb-3">
                                    <i class="fas fa-cart-plus"></i> <a href="{{route('cart.add',['id' => $pizza->id])}}">Pedir</a>
                                </button>
                        </div>
                    </div>
                    </div>
                @endif
            @endforeach
        </div>
    </section>
    
    <section id="sweet">
        <h2>Doces:</h2>
        <div class="pizzas">
            @foreach ($pizzas as $pizza)
                @if ($pizza->category === 'Doce' && $pizza->status === 'ativo')
                    <div class="pizza">
                    <img class="img-pizza" src="{{asset("storage/{$pizza->image_url}")}}" alt="">
                    <div class="description">
                        <h3>{{$pizza->name}}</h3>
                        <p>{{$pizza->description}}</p>
                        <div>
                            <strong>
                                <p>R${{number_format($pizza->price, 2, ',', '.')}}</p>
                            </strong>
                            <button class="btn btn-success btn-md mb-3"><a href="{{route('cart.add',['id' => $pizza->id])}}">Pedir</a></button>
                        </div>
                    </div>
                    </div>
                @endif
            @endforeach
        </div>
    </section>
    
    <section id="special">
        <h2>Especiais:</h2>
        <div class="pizzas">
            @foreach ($pizzas as $pizza)
                @if ($pizza->category === 'Especial' && $pizza->status === 'ativo')
                    <div class="pizza">
                    <img class="img-pizza" src="{{asset("storage/{$pizza->image_url}")}}" alt="">
                    <div class="description">
                        <h3>{{$pizza->name}}</h3>
                        <p>{{$pizza->description}}</p>
                        <div>
                            <strong>
                                <p>R${{number_format($pizza->price, 2, ',', '.')}}</p>
                            </strong>
                                <button class="btn btn-success btn-md mb-3"><a href="{{route('cart.add',['id' => $pizza->id])}}">Pedir</a></button>
                        </div>
                    </div>
                    </div>
                @endif
            @endforeach
        </div>
    </section>
    <div class="cart">
            <div class="ico-Cart">
                <a href="{{route('cart.show')}}"><i class="bi bi-cart-plus "></i></a>
                <div class="qtd">1</div>
            </div>
        </div>
    
        
        
        
            
    
@endsection