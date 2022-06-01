<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand; 
use App\Models\Product;
use Illuminate\Support\Facades\URL;


class ShopController extends Controller
{
    // View shop page
    public function ShopView(Request $request){
         $categories = Category::orderBy('category_name_en','ASC')->get();
         $brands = Brand::orderBy('brand_name_en','ASC')->get();
         // First get all the products
         $products = Product::where('status',1)->orderBy('id','DESC')->paginate(9);
         $priceProds =Product::where('status',1)->get(); //get products without pagination to define min and max price
        // new idea video 467
        $productQ = Product::query(); //this is same as Product:: but it make it remember the queries happened on it in each if close
        // If there is a category in the request filter the product
        if (!empty($_GET['category'])) {
            $slugs = explode(',',$_GET['category']);
            $catIds = Category::select('id')->whereIn('category_slug_en',$slugs)->pluck('id')->toArray();
            $priceProds = $productQ->whereIn('category_id',$catIds)->get();
            $products = $productQ->whereIn('category_id',$catIds)->paginate(9);
         } 
         if (!empty($_GET['min']) && !empty($_GET['max'])  ) {
            $min_price = $_GET['min'];
            $max_price = $_GET['max'];
            $products = $productQ->where('status',1)->whereBetween('selling_price', [$min_price, $max_price])->orderBy('id','DESC')->paginate(9);
            $priceProds = $productQ->where('status',1)->whereBetween('selling_price', [$min_price, $max_price])->get();

         }
         
         // If ther is a brand in the request filter the product
         if (!empty($_GET['brand'])) {
            $slugs = explode(',',$_GET['brand']);
            $brandIds = Brand::select('id')->whereIn('brand_slug_en',$slugs)->pluck('id')->toArray();
            $priceProds = $productQ->whereIn('brand_id',$brandIds)->get();
            $products = $productQ->whereIn('brand_id',$brandIds)->paginate(9);
        }
        // todo: fix total products number  

      // dd($request->query);
      //   if ($request->ajax()) {
      //    $min_price = $request->min_price;
      //    $max_price = $request->max_price;
      //    $priceProds->filter(function ($item, $key) {
      //       if($item->selling_price > $request->min_price  && $item->selling_price < $max_price ){    
      //          return $item;   
      //       }
      //    });
      //    
      //    $products = $productQ->where('status',1)->whereBetween('selling_price', [$min_price, $max_price])->orderBy('id','DESC')->paginate(9);
      //    $grid_view = view('frontend.product.grid_view_product',compact('products'))->render();
      //    $list_view = view('frontend.product.list_view_product',compact('products'))->render();
      //    return response()->json(['grid_view' => $grid_view,'list_view' => $list_view]);	

      //    }
         
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
      $data = $request->all();
      $url = URL::previous();
      $priceUrl = explode('?', $url, 2)[1];
      
      if (!empty($data['min_p'])&& !empty($data['max_p'])) {
         if(str_contains($priceUrl, '&max')){
            $priceUrl = explode('&max=', $priceUrl, 2)[0];
           $priceUrl .= '&max='.$data['max_p'].'&min='.$data['min_p'];       
         }else{
            $priceUrl .= '&max='.$data['max_p'].'&min='.$data['min_p'];       
         }
      } // end if condition 
            return redirect()->route('shop-page',$priceUrl);
    }
}
