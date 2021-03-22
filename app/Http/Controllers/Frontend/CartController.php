<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Cart;
use App\model\Product;
use Session;

class CartController extends Controller
{   
    public function __construct(){
        $this->middleware('auth:member');
    }
    
    public function getAddToCart(Request $request, $id ) {
        $product = Product::findOrFail($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $product->id);
        $request->session()->put('cart', $cart);    

        return redirect()->route('cart.index', ['id' => $product->id]);
    }

    public function getCart() {

        if (!Session::has('cart')) {
            $productRecommends = Product::where('product_recommend','ใช่')->get();
            return view('/frontend/cart/shopping-cart',['products' => 'null','productRecommends' => $productRecommends]);
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        return view('/frontend/cart/shopping-cart', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice]);   
    }

    public function getRemoveItem($id) {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);

        if(count($cart->items) > 0 ) {
            Session::put('cart', $cart);
        }
        else {
            Session::forget('cart');
        }
        
        return redirect()->route('cart.index');
    }

    public function getCheckout() {
        if (!Session::has('cart')) {
            return view('/frontend/cart/shopping-cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $total = $cart->totalPrice;
        return view('/frontend/cart/checkout', ['total' => $total]);
    }

}
