<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use App\Models\Wishlist;

class WishlistController extends Controller
{
    // view wishlist
    public function ViewWishlist(){
        return view('frontend.wishlist.view_wishlist');
    }

// new idea
    public function GetWishlistProduct(){
        $products = Wishlist::with('product')->where('user_id',Auth::id())->latest()->get();
        return response()->json($products);
    }


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
    // remove from wishlist
    public function RemoveWishlist($id){
        Wishlist::where('user_id',Auth::id())->where('id',$id)->delete();
        return response()->json(['success' => 'Product removed from your wishlist successfully']);
    }
}
