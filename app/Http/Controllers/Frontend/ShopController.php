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
         // First get all the products
         $products = Product::where('status',1)->orderBy('id','DESC')->paginate(9);
         $priceProds =Product::where('status',1)->get();
      // dd($minPrice, $maxPrice);
        // new idea video 467
        $productQ = Product::query(); //this is same as Product::
        // If ther is a category in the request filter the product
        if (!empty($_GET['category'])) {
            $slugs = explode(',',$_GET['category']);
            $catIds = Category::select('id')->whereIn('category_slug_en',$slugs)->pluck('id')->toArray();
            $priceProds = $productQ->whereIn('category_id',$catIds)->get();
            $products = $productQ->whereIn('category_id',$catIds)->paginate(9);
      //   dd($request['category']); same as $_GET['category']
         } 
         
         // If ther is a brand in the request filter the product
         if (!empty($_GET['brand'])) {
            $slugs = explode(',',$_GET['brand']);
            $brandIds = Brand::select('id')->whereIn('brand_slug_en',$slugs)->pluck('id')->toArray();
            $priceProds = $productQ->whereIn('brand_id',$brandIds)->get();
            $products = $productQ->whereIn('brand_id',$brandIds)->paginate(9);
            $minPrice = $productQ->whereIn('brand_id',$brandIds)->min('selling_price');
            $maxPrice = $productQ->whereIn('brand_id',$brandIds)->max('selling_price');
        }

        return view('frontend.shop.shop_view',compact('products','categories','brands','priceProds'));
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
    public function PriceFilter(Request $request){
dd($request['in1']);
    }
}
