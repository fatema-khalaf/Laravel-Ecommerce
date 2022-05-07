<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;
use App\Models\Coupon;

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
        if(Session::has('coupon')){
            Session::forget('coupon');
        }
        return response()->json(['success' => 'Product Remove from Cart']);
    }
    //increse items by one
    public function IncrementCart($rowId){
        // new idea these are build in methods of CART package
        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty + 1);
        if (Session::has('coupon')) {
            
            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupon = Coupon::where('coupon_name',$coupon_name)->first();

            $total = str_replace(',','',Cart::total());
            $discount_amount = intval($total)  * $coupon->coupon_discount / 100;
            Session::put("coupon", [
                "coupon_name" => $coupon->coupon_name,
                "coupon_discount" => $coupon->coupon_discount,
                "discount_amount" => round($discount_amount),
                "total_amount" => round(intval($total) - $discount_amount),
            ]);
        }
        return response()->json('success');
    }
    //decrese items by one
    public function DecrementCart($rowId){
        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty - 1);
        if (Session::has('coupon')) {
            
            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupon = Coupon::where('coupon_name',$coupon_name)->first();

            $total = str_replace(',','',Cart::total());
            $discount_amount = intval($total)  * $coupon->coupon_discount / 100;
            Session::put("coupon", [
                "coupon_name" => $coupon->coupon_name,
                "coupon_discount" => $coupon->coupon_discount,
                "discount_amount" => round($discount_amount),
                "total_amount" => round(intval($total) - $discount_amount),
            ]);
        }
        return response()->json('success');
    }
}
