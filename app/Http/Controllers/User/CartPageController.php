<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartPageController extends Controller
{
    // View cart page
    public function ViewMyCart(){
        return view('frontend.wishlist.view_mycart');
    }

    // get my cart data
    public function GetMyCartProduct(){
        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json(array(
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartTotal' => $cartTotal,
        ));
    }

    public function RemoveMyCart($rowId){
        Cart::remove($rowId);
        return response()->json(['success' => 'Product Remove from Cart']);
    }
    //increse items by one
    public function IncrementCart($rowId){
        // new idea these are build in methods of CART package
        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty + 1);
        return response()->json('success');
    }
    //decrese items by one
    public function DecrementCart($rowId){
        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty - 1);
        return response()->json('success');
    }
}
