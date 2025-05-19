   @extends('templates.templateAdmin') 
   @section('title', 'cadastro')
   @section('content')
    <div class="container mt-3">
        <div class=" row">
        
            <form method="POST" action="{{route('pizza.update', ['id' => $pizza->id])}}">
                @csrf
                @method('PUT')
                <div class="form-group mt-3  col-md-6">
                    <label for="name">Sabor</label>
                    <input type="text" name="name" id="name" value="{{$pizza->name}}" placeholder="Adicione o nome do novo sabor" class="form-control">
                </div>
                <div class="form-group mt-3  col-md-6">
                    <label for="category">Selecione a Categoria</label>
                    <select name="category" id="category" class="form-control">
                        <option value="Tradicional">Tradicional</option>
                        <option value="Especial" @if ($pizza->category == 'Especial') selected  @endif>Especial</option>
                        <option value="Doce"  @if ($pizza->category == 'Doce') selected  @endif>Doce</option>
                    </select>
                </div>
                <div class="form-group my-3  col-md-6">
                    <label for="description">Descrição</label>
                    <textarea name="description" id="description"  rows="3" class="form-control">{{$pizza->description}}</textarea>
                </div>
                <div class="form-group my-3  col-md-6">
                    <label for="price">Valor:</label>
                    <input type="number" step="0.01" name="price" id="price"  rows="3" class="form-control" placeholder="Ex: 77.69" value="{{$pizza->price}}"></input>
                </div>
                <div class="form-group mt-3  col-md-6">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="ativo">Ativo</option>
                        <option value="inativo"
                         @if ($pizza->status == 'inativo') selected  @endif>Inativo</option>
                    </select>
                </div>
                <div class="text-end  col-md-6 my-3">
                    <button class="btn btn-primary text-end">Salvar</button>
                </div>
            </form>
        </div>
    </div>

    @endsection