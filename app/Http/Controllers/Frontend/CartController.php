<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Wishlist;
use Gloudemans\Shoppingcart\Facades\Cart;
use Auth;
use Carbon\Carbon;
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
            'qty' => $request->quantity, 'price' => $product->discount_price,
            'weight' =>1, 'options' => [
                'image' => $product->product_thambnail,
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
        // new idea
        // Add to wishlist
        public function AddToWishlist(Request $request, $id){
            if(Auth::check()){
                $exist = Wishlist::where('user_id',Auth::id())->where('product_id',$id)->first();
                if(!$exist){
                    Wishlist::insert([
                        'user_id' => Auth::id(),
                        'product_id' => $id,
                        'created_at' => Carbon::now(),
                    ]);
                    return response()->json(['success' => 'Added to wishlist successfully']);
                }else{
                    return response()->json(['error' => 'This product is already in your wishlist']);
                }
            }else{
                return response()->json(['error' => 'You need to be logged in']);
            }
        }
}
