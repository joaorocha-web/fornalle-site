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
                                <button class="btn btn-outline-danger btn-sm ml-2 delete-btn" 
                                        data-id="{{ $pizza->id }}" 
                                        data-url="{{ route('pizza.destroy', ['pizza' => $pizza->id]) }}">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </td>
                            
                        </tr>
                    @endforeach
            
                </tbody>
            </table>
            <button class="btn btn-success mb-4 btn-lg"><a class="text-white" href="{{route('pizza.create')}}">Novo Sabor +</a></button>
            
            <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
            <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>



            <script>
            $(document).ready(function() {
                $('.delete-btn').click(function() {
                    const button = $(this);
                    const pizzaId = button.data('id');
                    const url = button.data('url');
                    const row = button.closest('tr');

                    if(confirm('Tem certeza que deseja excluir esta pizza permanentemente?')) {
                        $.ajax({
                            url: url,
                            type: 'POST', 
                            data: {
                                _token: '{{ csrf_token() }}',
                                _method: 'DELETE' // Laravel vai processar como DELETE
                            },
                            success: function(response) {
                                // visual effect
                                row.fadeOut(800, function() {
                                    $(this).remove();
                                });
                                
                                // Toast de sucesso (opcional)
                                Toastify({
                                    text: "Pizza removida com sucesso!",
                                    duration: 3000,
                                    close: true,
                                    gravity: "top",
                                    position: "right",
                                    backgroundColor: "#4CAF50",
                                }).showToast();
                            },
                            error: function(xhr) {
                                console.error(xhr.responseText);
                                alert("Erro ao remover. Verifique o console para detalhes.");
                            }
                        });
                    }
                });
            });
    </script>




            {{-- <script>
                $(function(){
                    $('form[name="remove"]').submit(function(event){
                        event.preventDefault()
                        $.ajax({
                            url: "{{route('pizza.destroy'}}",
                            type: 'post',
                            data: $(this),
                            dataType: 'json',
                            success: function(answer){
                                console.log(answer)
                            }
                        })
                    })
                })
            </script> --}}
    {{-- action="{{route('pizza.destroy' , ['id' => $pizza->id])}}" method="POST" --}}
@endsection
    

