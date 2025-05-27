
    @foreach ($bestClients as $client)
        <div class="item">
            <p><span class="pizza-name">{{$client->user->name}}:</span> Vendidas- {{$client->total}}</p>
        </div>
    @endforeach

<style>
    span.pizza-name{
        background-color: #00796B;
        color: #fff;
        padding: 5px;
        font-weight: 600;
    }
</style>


