<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand; 
use App\Models\Product;


class ShopController extends Controller
{
    // View shop page
    public function ShopView(Request $request){
        $products = Product::where('status',1)->orderBy('id','DESC')->paginate(3);
        $categories = Category::orderBy('category_name_en','ASC')->get();
        
        return view('frontend.shop.shop_view',compact('products','categories'));
    }
}
