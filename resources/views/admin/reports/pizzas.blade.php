@foreach ($pizzasBestSellers as $item)
    <p>Pizza: {{$item->pizza->name}} - Vendidas: {{$item->total}}</p>
@endforeach
