<?php

namespace App\Http\Controllers;
use App\Models\Pizza;


class CartController extends Controller
{
    public function showCart(){
        $cart = $this->getCartItems();
        $total = $this->getCartTotal($cart);
        $totalFormated = number_format($total, 2, ',','.');
        if($total === 0){
            return redirect()->route('main')->with('error', 'Seu carrinho está vazio.');
        }
        return view('site.cart', [
            'cart' => $cart,
            'total' => $totalFormated
        ]);
    }

    public function getCartItems(){
        $cart = session()->get('cart', []);
        return $cart;
    }

    public function getCartTotal($cart){
        $total = 0;
        foreach ($cart as $item){
            $total += ($item['price']) * ($item['quantity']);
        }
        return $total;
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


        $total = array_sum(array_column($cart, 'quantity'));
        session()->put('total', $total);


         return response()->json([
        'success' => true,
        'total' => $total,
        'cart' => $cart
         ]);
        
   }


    
   public function remove($id)
{
    try {
        $cart = session()->get('cart', []);
        $responseData = [];

        if (!isset($cart[$id])) {
            return response()->json([
                'success' => false,
                'message' => 'Item não encontrado no carrinho'
            ], 404);
        }

        if ($cart[$id]['quantity'] > 1) {
            $cart[$id]['quantity']--;
            $responseData['quantity'] = $cart[$id]['quantity'];
        } else {
            unset($cart[$id]);
            $responseData['quantity'] = 0;
        }

        // Calcula o total corretamente
        $totalPrice = 0;
        foreach ($cart as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }

        $total = 0;
        foreach ($cart as $item) {
            $total +=  $item['quantity'];
        }

        session()->put('total', $total);
        session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'total' => $totalPrice,
            'quantity' => $responseData['quantity'] ?? 0
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Erro interno: ' . $e->getMessage()
        ], 500);
    }
}
}
