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
        return view('admin.dashboard'); 
    }
    
    public function showBestSellers(){
        $pizzasBestSellers = OrderItem::getBestSellers();
        return $pizzasBestSellers;
    }

    public function showReport($type){
        if($type === 'pizzas'){
            $pizzasBestSellers = OrderItem::getBestSellers();
            return view("admin.reports.{$type}", ['pizzasBestSellers' =>  $pizzasBestSellers ]);
        }
    
    }



}
