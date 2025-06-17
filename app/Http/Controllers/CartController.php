<?php

namespace App\Http\Controllers;
use App\Models\Pizza;
use App\Utilities\FormatHelper;


class CartController extends Controller
{
    public function showCart(){
        $cartItems = $this->getCartItems();
        
        if($this->isCartEmpty($cartItems)){
            return $this->redirectToMainWithEmptyCartMessage();
        }

        return $this->renderCartView($cartItems);
    }

    private function getCartItems():array{
        $cart = session()->get('cart', []);
        return $cart;
    }

    private function getCartTotal($cartItems):float{
        $total = 0;
        foreach ($cartItems as $item){
            $total += ($item['price']) * ($item['quantity']);
        }
        return $total;
    }

    private function isCartEmpty($cartItems){
        if(empty($cartItems) || $this->getCartTotal($cartItems) === 0) return true;
    }

    private function redirectToMainWithEmptyCartMessage(){
        return redirect()->route('main')->with('error', 'Seu carrinho está vazio.');
    }

    private function renderCartView($cartItems){
        $total = $this->getCartTotal($cartItems);
        $formatedTotal = FormatHelper::money($total);
         return view('site.cart', [
            'cart' => $cartItems,
            'total' => $formatedTotal
        ]);
    }

    public function addItemToCart($id){
        $cart = $this->getCartItems();
        if(isset($cart[$id])){
            $cartUpdated = $this->cartSumQuantity($cart, $id);
        }else{
            $cartUpdated = $this->cartCreateNewItem($cart, $id);
        }
    
        session()->put('cart', $cartUpdated);


        $total = array_sum(array_column($cartUpdated, 'quantity'));
        session()->put('total', $total);


         return response()->json([
        'success' => true,
        'total' => $total,
        'cart' => $cartUpdated
         ]);
        
   }

   private function cartSumQuantity($cart, $id){
        $cart[$id]['quantity']+=1;
        return $cart;
   }

   private function cartCreateNewItem($cart, $id){
        $pizza = Pizza::findorfail($id);
        $cart[$id] = [
            'name' => $pizza->name,
            'quantity' => 1,
            'price' => $pizza->price
        ];
        return $cart;
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
