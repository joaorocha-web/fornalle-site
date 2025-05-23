<?php

namespace App\Http\Controllers;
use App\Models\Pizza;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function show(){
        $cart = session()->get('cart', []);
        $total = 0;
        foreach ($cart as $item){
            $total += ($item['price']) * ($item['quantity']);
        }
        
        $totalFormated = number_format($total, 2, ',','.');
        if($total === 0){
            return redirect()->route('main')->with('error', 'Seu carrinho está vazio.');
        }
        return view('site.cart', [
            'cart' => $cart,
            'total' => $totalFormated
        ]);
    }

    public function add($id){
        $pizza = Pizza::findorfail($id);
        $cart = session()->get('cart', []);
        if(isset($cart[$id])){
            $cart[$id]['quantity']+=1;
        }else{
            $cart[$id] = [
            'name' => $pizza->name,
            'quantity' => 1,
            'price' => $pizza->price
        ];
        }
        session()->put('cart', $cart);
        $total = session()->get('total');
        $total++;
        session()->put('total', $total);
        return redirect()->route('main');
        
   }

   public function remove($id){
    
    $cart = session()->get('cart');
    if(isset($cart[$id]) && $cart[$id]['quantity'] > 1){
        $cart[$id]['quantity']-=1;
    }else{
        unset($cart[$id]);
    }
    $total = session()->get('total');
    $total--;
    session()->put('total', $total);
    session()->put('cart', $cart);
    return redirect()->route('cart.show');
   }
}
