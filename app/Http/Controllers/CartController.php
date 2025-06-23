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

    private function isCartEmpty(array $cartItems){
        if(empty($cartItems) || $this->getCartTotalPrice($cartItems) === 0) return true;
    }

    private function getCartTotalPrice(array $cartItems):float{
        $total = 0;
        foreach ($cartItems as $item){
            $total += ($item['price']) * ($item['quantity']);
        }
        return $total;
    }

    private function redirectToMainWithEmptyCartMessage(){
        return redirect()->route('main')->with('error', 'Seu carrinho está vazio.');
    }

    private function renderCartView(array $cartItems){
        $total = $this->getCartTotalPrice($cartItems);
        $formatedTotal = FormatHelper::money($total);
         return view('site.cart', [
            'cart' => $cartItems,
            'total' => $formatedTotal
        ]);
    }

    public function addItemToCart(int $id){
        $cart = $this->getCartItems();
        
        if(isset($cart[$id])){
            $cart = $this->cartSumQuantity($cart, $id);
        }else{
            $cart = $this->cartCreateNewItem($cart, $id);
        }        
        
        $this->saveCartToSession($cart);

        return $this->createCartResponse($cart);   
   }

   private function cartSumQuantity(array $cart, int $id):array{
        $cart[$id]['quantity']+=1;
        return $cart;
   }

   private function cartCreateNewItem(array $cart, int $id):array{
        $pizza = Pizza::findorfail($id);
        
        $cart[$id] = [
            'name' => $pizza->name,
            'quantity' => 1,
            'price' => $pizza->price
        ];
        
        return $cart;
   }

   private function saveCartToSession(array $cartUpdated){
        session()->put('cart', $cartUpdated);
   }

    private function createCartResponse(array $cart){
        $totalItems = $this->getCartTotalItems($cart);

        return response()->json([
        'success' => true,
        'total' => $totalItems,
        'cart' => $cart
         ]);
    }

   private function getCartTotalItems(array $cart):int{
        return array_sum(array_column($cart, 'quantity'));
   }
   


   
   public function removeItemFromCart($id)
    {
        try {
            $cart = $this->getCartItems();
            $responseData = [];

            if ( $this->isInvalidItem($cart, $id)) {
                return $this->responseItemDoesNotExist();
            }

            if ($this->isValidItem($cart, $id)) {
                $this->cartMinusQuantity($cart, $id);
                $responseData['quantity'] = $cart[$id]['quantity'];
            } else {
                $this->excludeItem($cart, $id);
            }

            $totalPrice = $this->getCartTotalPrice($cart);
            $totalItems = $this->getCartTotalItems($cart);

            session()->put('total', $totalItems);
            $this->saveCartToSession($cart);

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

    private function isInvalidItem(array $cart, int $id):bool{
        return !isset($cart[$id]);
    }

    private function responseItemDoesNotExist(){
        return response()->json([
                    'success' => false,
                    'message' => 'Item não encontrado no carrinho'
                ], 404);
    }

    private function isValidItem(array $cart, int $id):bool{
        return $cart[$id]['quantity'] > 1;
    }

    private function cartMinusQuantity(array &$cart, int $id){
        $cart[$id]['quantity']--;
    }

    private function excludeItem(array &$cart, int $id){
        unset($cart[$id]);
    }
}
