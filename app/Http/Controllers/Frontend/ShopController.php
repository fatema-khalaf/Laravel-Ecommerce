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
        $categories = Category::orderBy('category_name_en','ASC')->get();
        $brands = Brand::orderBy('brand_name_en','ASC')->get();

        // new idea video 467
        $products = Product::query();

        if (!empty($_GET['category'])) {
            $slugs = explode(',',$_GET['category']);
            $catIds = Category::select('id')->whereIn('category_slug_en',$slugs)->pluck('id')->toArray();
            $products = $products->whereIn('category_id',$catIds)->paginate(3);
        }
        if (!empty($_GET['brand'])) {
            $slugs = explode(',',$_GET['brand']);
            $brandIds = Brand::select('id')->whereIn('brand_slug_en',$slugs)->pluck('id')->toArray();
            $products = $products->whereIn('brand_id',$brandIds)->paginate(3);
        }
        else{
             $products = Product::where('status',1)->orderBy('id','DESC')->paginate(3);
        }

        return view('frontend.shop.shop_view',compact('products','categories','brands'));
    }

    // view filtered results of categories filter
    public function ShopFilter(Request $request){
        $data = $request->all();
        $catUrl = "";
        if (!empty($data['category'])) {
           foreach ($data['category'] as $category) {
              if (empty($catUrl)) {
                 $catUrl .= '&category='.$category;
              }else{
                $catUrl .= ','.$category;
              }
           } // end foreach condition
        } // end if condition 

         // Filter Brand 

         $brandUrl = "";
         if (!empty($data['brand'])) {
            foreach ($data['brand'] as $brand) {
               if (empty($brandUrl)) {
                  $brandUrl .= '&brand='.$brand;
               }else{
                 $brandUrl .= ','.$brand;
               }
            } // end foreach condition
         } // end if condition 

         return redirect()->route('shop-page',$catUrl.$brandUrl);
    }
}