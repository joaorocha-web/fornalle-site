@extends('templates.template')
@section('title', 'fornalle')
@section('content')
    <section id="traditional">
        <h2>Tradicionais</h2>
        <div class="pizzas">
            @foreach ($pizzas as $pizza)
                @if ($pizza->category === 'Tradicional' && $pizza->status === 'ativo')
                    <div class="pizza">
                    <img class="img-pizza" src="/images/pizza-especial-250px.jpg" alt="">
                    <div class="description">
                        <h3>{{$pizza->name}}</h3>
                        <p>{{$pizza->description}}</p>
                        <div>
                            <strong>
                                <p>R${{number_format($pizza->price, 2, ',', '.')}}</p>
                            </strong>
                            
                            <button class="btn btn-success btn-md mb-3">Pedir</button>
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
                    <img class="img-pizza" src="/images/pizza-especial-250px.jpg" alt="">
                    <div class="description">
                        <h3>{{$pizza->name}}</h3>
                        <p>{{$pizza->description}}</p>
                        <div>
                            <strong>
                                <p>R${{number_format($pizza->price, 2, ',', '.')}}</p>
                            </strong>
                            <button class="btn btn-success btn-md mb-3">Pedir</button>
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
                    <img class="img-pizza" src="/images/pizza-especial-250px.jpg" alt="">
                    <div class="description">
                        <h3>{{$pizza->name}}</h3>
                        <p>{{$pizza->description}}</p>
                        <div>
                            <strong>
                                <p>R${{number_format($pizza->price, 2, ',', '.')}}</p>
                            </strong>
                            <button class="btn btn-success btn-md mb-3">Pedir</button>
                        </div>
                    </div>
                    </div>
                @endif
            @endforeach
        </div>
    </section>
    
        
        
        
            
    
@endsection