<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
class CartController extends Controller
{
    public function AddToCart(Request $request ,$id){
        $product = Product::findOrFail($id);
        if($product->discount_price == Null){
            // dd($product, $request); 
            // return $request;
            // die();
            Cart::add(['id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => $product->selling_price,
                'weight' =>1,
                'options' => [
                    'image' => $product->product_thambnail,
                    'size' => $request->size,
                    'color' => $request->color,
                    ]
                ]);
                return response()->json(['success' => 'Successfully added to your cart']);

        }else{
            Cart::add(['id' => $id, 'name' => $request->product_name,
            'qty' => $request->qty, 'price' => $product->discount_price,
            'weight' =>1, 'options' => [
                'image' => $product->thambnail,
                'size' => $request->size,
                'color' => $request->color,
                ]
               ]);
               return response()->json(['success' => 'Successfully added to your cart']);
        }
    }

        // Mini Cart Section
        public function AddMiniCart(){

            $carts = Cart::content();
            $cartQty = Cart::count();
            $cartTotal = Cart::total();
    
            return response()->json(array(
                'carts' => $carts,
                'cartQty' => $cartQty,
                'cartTotal' => $cartTotal,
            ));
        } // end method 

        // remove mini cart item
        public function RemoveMiniCart($rowId){
            Cart::remove($rowId);
            return response()->json(['success' => 'Product Remove from Cart']);
    
        } // end mehtod 
    
}
