@extends('site.template')
@section('title', 'Pizzas')
@section('content')
        <h2>Tabela de Pizzas Cadastradas</h2>
        <div class="container mt-3">
            <table class="table table-hover table-bordered table-striped">
                <thead>
                    <th>Sabor</th>
                    <th>Descrição</th>
                </thead>
                <tbody>
                    @foreach ($pizzas as $pizza)
                        <tr>
                            <td>{{$pizza->flavor}}</td>
                            <td>{{$pizza->description}}</td>
                        </tr>
                    @endforeach
            
                </tbody>
            </table>
            <button class="btn btn-success"><a class="text-white" href="{{route('pizza.create')}}">Novo Sabor +</a></button>
        </div>
    
@endsection
    

