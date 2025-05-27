<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pizza;
use App\Models\OrderItem;

class DashboardController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard'); // View principal sem dados
    }
    
    public function bestSellers(){
        $pizzasBestSellers = OrderItem::getBestSellers();
        return view('admin.reports.pizzas',['pizzasBestSellers' =>  $pizzasBestSellers ]);
    }



}
