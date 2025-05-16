   @extends('site.template') 
   @section('title', 'cadastro')
   @section('content')
    <div class="container mt-3">
        <div class=" row">
        
            <form method="POST" action="{{route('pizza.store')}}">
                @csrf
                <div class="form-group mt-3  col-md-6">
                    <label for="flavor">Sabor</label>
                    <input type="text" name="flavor" id="flavor" placeholder="Adicione o nome do novo sabor" class="form-control">
                </div>
                <div class="form-group mt-3  col-md-6">
                    <label for="category">Selecione a Categoria</label>
                    <select name="category" id="category" class="form-control">
                        <option value="traditional">Tradicional</option>
                        <option value="special">Especial</option>
                        <option value="sweet">Doce</option>
                    </select>
                </div>
                <div class="form-group my-3  col-md-6">
                    <label for="description">Descrição</label>
                    <textarea name="description" id="description"  rows="3" class="form-control"></textarea>
                </div>
                <div class="text-end  col-md-6 mb-4">
                    <button class="btn btn-primary text-end">Criar</button>
                </div>
            </form>
        </div>
    </div>

    @endsection