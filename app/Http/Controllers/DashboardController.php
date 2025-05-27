<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pizza;
use App\Models\OrderItem;
use App\Models\Order;

class DashboardController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard'); // View principal sem dados
    }
    
    public function bestSellers(){
        $pizzasBestSellers = OrderItem::getBestSellers();
        return $pizzasBestSellers;
    }

    public function showReport($type){
        if($type === 'pizzas'){
            $pizzasBestSellers = OrderItem::getBestSellers();
            return view("admin.reports.{$type}", ['pizzasBestSellers' =>  $pizzasBestSellers ]);
        }elseif($type === 'clients'){
            $bestClients = Order::getBestClients();
            return view("admin.reports.{$type}", ['bestClients' =>  $bestClients ]);
        }

    
    }



}
