    
    <div class="main">
        <div class="dashboard-resume">
            <div class="title">
                <h3>Best Seller</h3>
            </div>
            
                <div class="pizza">
                    <span>{{$pizzasBestSellers[0]->pizza->name}}</span>
                </div>
                <img src="{{ asset('storage/' . $pizzasBestSellers[0]->pizza->image_url) }}">
            
        </div>
        <div class="grafic">
             @for ($i = 0; $i <= 4; $i++)
                <div class="item">
                    <p><span class="pizza-name">{{$pizzasBestSellers[$i]->pizza->name}}:</span> <strong>{{$pizzasBestSellers[$i]->total}}</strong></p>
                </div>
            @endfor
         
        </div>
        <div class="card">
            @php
               $n=1; 
            @endphp
           <table>
                <thead>
                    <th>N°</th>
                    <th>Nome:</th>
                    <th>Total de vendas:</th>   
                </thead>
                <tbody>
                    @foreach ($pizzasBestSellers as $item)
                        <tr>
                            <td>{{$n++}}°</td>
                            <td>{{$item->pizza->name}}</td>
                            <td>{{$item->total}}</td>
                        </tr>
                    @endforeach
                </tbody>
           </table>
        </div>
    </div>
    
    

<style>
    .main{
        display: grid;
        grid-template-rows: 250px 1fr;
        grid-template-columns: 40% 60%;
        grid-template-areas: "resume grafic" "report report";
        gap: 40px;
    }

    .dashboard-resume{
        grid-area: resume;
        display: flex;
        flex-flow: column;
        align-items: center;
        padding: 5px;
        background-color: 	#7D3C98;
        border: 1px solid rgba(0, 0, 0, 0.183);
        margin-top: 30px;
        box-shadow: 2px 5px 12px rgba(0, 0, 0, 0.094);
        border-radius: 10px;
    }

    .grafic{
        grid-area: grafic;
        display: flex;
        flex-flow: column;
        justify-content: space-around;
        padding: 10px 0px;
        background-color: #fff;
        border: 1px solid rgba(0, 0, 0, 0.183);
        margin-top: 30px;
        margin-right: 40px;
        box-shadow: 2px 5px 12px rgba(0, 0, 0, 0.094);
        border-radius: 10px;
        color: #000;
    }

    .card{
        grid-area: report;
        margin-bottom: 30px;
        margin-right: 40px;
        min-width: 500px;
        box-shadow: 2px 5px 12px rgba(0, 0, 0, 0.094);
        padding: 30px 15px;
    }

    .pizza{
        font-size: 1.1rem;
        
    }

    img{
        width: 120px;
        height: auto;
    }


    span.pizza-name{
        background-color: #27AE60;
        color: #fff;
        padding: 5px;
        font-weight: 600;
    }

    strong{
        font-size: 1.1rem;
    }
</style>


