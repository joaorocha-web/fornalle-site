<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\DB;



class CheckOutController extends Controller
{
    public function showCheckoutForm(){
        return view('site.checkout');
    }

   public function finishCheckout(Request $request){
        DB::transaction(function() use ($request){
            $checkOut = $request->all();
            $order = Order::create([
                'customer_name' => $checkOut['name'],
                'customer_phone' => $checkOut['number'],
                'total' => 554,
                'delivery_adress' => $checkOut['adress'],
                'delivery_city' => 'Juiz de Fora',
                'delivery_neighborhood' => $checkOut['neighborhood'],
                'payment_method' => $checkOut['payment_method'],
                'user_id' => auth()->user()->id
                  
            ]);

            
            
            
            
        });
        
    }
}
