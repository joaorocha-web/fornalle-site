@extends('templates.templateAdmin')
@section('title', 'Pizzas')
@section('content')
        <h2>Tabela de Pizzas Cadastradas</h2>
        
            <table class="table table-hover table-bordered table-striped m-3">
                <thead>
                    <th>Sabor</th>
                    <th>Descrição</th>
                    <th>Valor</th>
                    <th>Categoria</th>
                    <th>Status</th>
                    <th>Alterar/delete</th>
                </thead>
                <tbody>
                    @foreach ($pizzas as $pizza)
                        <tr>
                            <td>{{$pizza->name}}</td>
                            <td class="reticence">{{$pizza->description}}</td>
                            <td>R$ {{number_format($pizza->price, 2, ",", ".")}}</td>
                            <td>{{$pizza->category}}</td>
                            <td>{{$pizza->status}}</td>
                            <td class="d-flex">
                                <a class="btn btn-outline-primary btn-sm me-3" href="{{route('pizza.edit' , ['id' => $pizza->id])}}"><i class="bi bi-pencil"></i></a>
                                <form action="{{route('pizza.destroy' , ['id' => $pizza->id])}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm ml-2"><i class="bi bi-trash3"></i></button>
                                </form>
                            </td>
                            
                        </tr>
                    @endforeach
            
                </tbody>
            </table>
            <button class="btn btn-success mb-4"><a class="text-white" href="{{route('pizza.create')}}">Novo Sabor +</a></button>
        
    
@endsection
    

