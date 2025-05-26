<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;



class CheckOutController extends Controller
{
    public function showCheckoutForm(){
        return view('site.checkout');
    }

   public function finishCheckout(Request $request){
        DB::transaction(function() use ($request){
            $total = 0;
            $cartItems = session('cart', []);
            foreach($cartItems as $item){
                $total += $item['quantity'] * $item['price'];
            }

            $checkOut = $request->all();
            $order = Order::create([
                'customer_name' => $checkOut['name'],
                'customer_phone' => $checkOut['number'],
                'total' => $total,
                'delivery_adress' => $checkOut['adress'],
                'delivery_city' => 'Juiz de Fora',
                'delivery_neighborhood' => $checkOut['neighborhood'],
                'payment_method' => $checkOut['payment_method'],
                'user_id' => auth()->user()->id
                  
            ]);

            
            foreach( $cartItems as $id => $item){
                $orderItem = OrderItem::create([
                    'order_id' => $order['id'],
                    'pizza_id' => $id,
                    'quantity'=> $item['quantity'],
                    'unit_price' => $item['price'],
                ]);
            }  
            
            session()->forget('cart');
            session()->forget('total');
            
        });
        return redirect()->route('main');
    }
}
