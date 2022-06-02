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
         $type = 0; // this controlles the type of pagination links page in products.blade.php
         $products = Product::where('status',1)->orderBy('id','DESC')->paginate(9);
         $priceProds =Product::where('status',1)->get(); //get products without pagination to define min and max price  
         $count =$priceProds->count();
      return view('frontend.shop.shop_view',compact('products','categories','brands','priceProds','type','count'));
  }
  // NEW idea My own code
    // filter ajax method
    public function GetFiltered(Request $request){
                 $productQ = Product::query(); //this is same as Product:: but it make it remember the queries happened on it in each if close
                 $min_price = $request->min_price;
                 $max_price = $request->max_price;
                 $categories = $request->categories; //all cheked box categories slugs
         $brands= $request->brands; //all cheked box brands slugs
         $paginate = $request->paginate ? $request->paginate : 9;
         $sort= $request->sort;
         $type = 1; // this controlles the type of pagination links page in products.blade.php
          $by = (explode("-",$sort))[0] ? (explode("-",$sort))[0] :'id';
          $type = (explode("-",$sort))[1] ? (explode("-",$sort))[1] : 'DESC';

         if (!empty($categories)) {
               $catIds = Category::select('id')->whereIn('category_slug_en',$categories)->pluck('id')->toArray();
               $count = $productQ->whereIn('category_id',$catIds)->get();
               $products = $productQ->whereIn('category_id',$catIds)->orderBy($by , $type)->paginate($paginate);
         } 
         if (!empty($brands)) {
            $brandIds = Brand::select('id')->whereIn('brand_slug_en',$brands)->pluck('id')->toArray();
            $products = $productQ->whereIn('brand_id',$brandIds)->orderBy($by , $type)->paginate($paginate);
            $count = $productQ->whereIn('brand_id',$brandIds)->get();
         }
         $count = $productQ->where('status',1)->whereBetween('selling_price', [$min_price, $max_price])->count();
         $products = $productQ->where('status',1)->whereBetween('selling_price', [$min_price, $max_price])->orderBy($by , $type)->paginate($paginate);

         //todo: compact price values to price filter page
         $productlist = view('frontend.product.products',compact('products','count','type'))->render();
         return response()->json(['productlist' => $productlist]);	
        }
    }