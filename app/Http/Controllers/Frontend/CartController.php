<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Coupon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function AddToCart(Request $request, $id)
    {
        if(Session::has('coupon')){
            Session::forget('coupon');
        }
        $product = Product::findOrFail($id);
        if ($product->discount_price == null) {
            // dd($product, $request);
            // return $request;
            // die();
            Cart::add([
                "id" => $id,
                "name" => $request->product_name,
                "qty" => $request->quantity,
                "price" => $product->selling_price,
                "weight" => 1,
                "options" => [
                    "image" => $product->product_thambnail,
                    "size" => $request->size,
                    "color" => $request->color,
                ],
            ]);
            return response()->json([
                "success" => "Successfully added to your cart",
            ]);
        } else {
            Cart::add([
                "id" => $id,
                "name" => $request->product_name,
                "qty" => $request->quantity,
                "price" => $product->discount_price,
                "weight" => 1,
                "options" => [
                    "image" => $product->product_thambnail,
                    "size" => $request->size,
                    "color" => $request->color,
                ],
            ]);
            return response()->json([
                "success" => "Successfully added to your cart",
            ]);
        }
    }

    // Mini Cart Section
    public function AddMiniCart()
    {
        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json([
            "carts" => $carts,
            "cartQty" => $cartQty,
            "cartTotal" => $cartTotal,
        ]);
    } // end method

    // remove mini cart item
    public function RemoveMiniCart($rowId)
    {
        Cart::remove($rowId);
        return response()->json(["success" => "Product Remove from Cart"]);
    } // end mehtod

    // Apply coupon
    public function ApplyCoupon(Request $request)
    {
        // New idea
        $coupon = Coupon::where("coupon_name", $request->coupon_name)
            ->where("coupon_validity", ">=", Carbon::now()->format("Y-m-d"))
            ->first(); //request->coupon_name >> sent fron ajax script
        if ($coupon) {
            $total = str_replace(',','',Cart::total());
            $discount_amount = intval($total)  * $coupon->coupon_discount / 100;
            Session::put("coupon", [
                "coupon_name" => $coupon->coupon_name,
                "coupon_discount" => $coupon->coupon_discount,
                "discount_amount" => round($discount_amount),
                "total_amount" => round(intval($total) - $discount_amount),
            ]);
           
            return response()->json([
                "success" => "Coupon Applied Successfully",
            ]);
        } else {
            return response()->json(["error" => "Inavlid coupon"]);
        }

    }
    // coupon calculation new idea
    public function CouponCalculation(){
        if(Session::has('coupon')){
            return response()->json(array(
                'subtotal' => Cart::total(),
                'coupon_name' => session()->get('coupon')['coupon_name'],
                'coupon_discount' => session()->get('coupon')['coupon_discount'],
                'discount_amount' => session()->get('coupon')['discount_amount'],
                'total_amount' => session()->get('coupon')['total_amount']
            ));
        }else{
            return response()->json(["total" => Cart::total()]);
        }
    }

    // Remove coupon new idea
    public function CouponRemove(){
        Session::forget('coupon');
        return response()->json(['success'=>'Coupon removed successfully']);
    }
}
