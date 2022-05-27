<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\SubSubcategory;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Blog\BlogPost;
use Illuminate\Support\Facades\Hash;
use App\Traits\ChangePasswordTrait;
use App\Traits\ReplaceImageTrait;
use App\Models\MultiImg;
use Auth;

class IndexController extends Controller
{
    // Use Change password trait
    use ChangePasswordTrait;
    // Use replace Image trait
    use ReplaceImageTrait;

    // View home page
    public function Index(){
        $products = Product::orderBy('id', 'DESC')->limit(6)->get();
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $sliders = Slider::where('status',1)->orderBy('id','DESC')->limit(3)->get();
        $featured = Product::where('featured',1)->orderBy('id','DESC')->limit(6)->get();
        // $hot_deals = Product::where('hot_deals',1)->where('discount_price','!=',NULL)->orderBy('id','DESC')->limit(3)->get();
    	$special_offer = Product::where('special_offer',1)->orderBy('id','DESC')->limit(3)->get();
        $special_deals = Product::where('special_deals',1)->orderBy('id','DESC')->limit(3)->get();
        $skip_category_0 = Category::skip(2)->first();
        $skip_product_0 = Product::where('status',1)->where('category_id',$skip_category_0->id)->orderBy('id','DESC')->get();
        // note: for development use 👇👇 to display results
        $skip_brand_1 = Brand::skip(0)->first();
    	$skip_brand_product_1 = Product::where('status',1)->where('brand_id',$skip_brand_1->id)->orderBy('id','DESC')->get();
        // return $skip_brand_product_1;
        // die();
        $blogPosts = BlogPost::latest()->get();
        return view('frontend.index', compact('categories', 'sliders', 'products','featured',
        'special_offer','special_deals','skip_product_0','skip_category_0','skip_brand_1','skip_brand_product_1','blogPosts'));
    }
    // View product details
    public function ProductDetails($id,$slug){
		$multiImg = MultiImg::where('product_id',$id)->get();
		$product = Product::findOrFail($id);
        // new idea explode to remove a chr in a string
        $color_en = $product->product_color_en;
        $product_color_en= explode(',',$color_en);
        $color_ar = $product->product_color_ar;
        $product_color_ar= explode(',',$color_ar);

        $size_en = $product->product_size_en;
        $product_size_en= explode(',',$size_en);
        $size_ar = $product->product_size_ar;
        $product_size_ar= explode(',',$size_ar);

        $cat_id = $product->category_id;
		$relatedProduct = Product::where('category_id',$cat_id)->where('id','!=',$id)->orderBy('id','DESC')->get();
	 	return view('frontend.product.product_details',compact('product', 'multiImg','product_color_en','product_color_ar','product_size_en','product_size_ar','relatedProduct'));
	}
    // Logout user
    public function UserLogout(){
        Auth::logout();
        return Redirect()->route('login');
    }
    // View user profile
    public function UserProfile(){
        $id= Auth::user()->id;
        $user = User::find($id);
        return view('frontend.profile.user_profile', compact('user'));
    }
    // Store Updated data
    public function UserProfileStore(Request $request){
        $id=Auth::user()->id;
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        if($request->file('profile_photo_path')){
            $file = $request->file('profile_photo_path');
            // Note: this code writtem by me using trait; 
            $filename= $this->replaceImage($user->profile_photo_path,$file,'upload/user_images'); // oldfile, newFile , path
            $user['profile_photo_path']=$filename;
        }
        $user->save();
        $notification= array(
            'message'=> 'User Profile updated successfully',
            'alert_type' =>'success'
        );
        return redirect()->route('dashboard')->with($notification);
    }
    // View change password 
    public function UserChangePassword(){
        $id= Auth::user()->id;
        $user = User::find($id);
        return view('frontend.profile.change_password', compact('user'));
    }

    // Store new password
    public function UserUpdateChangePassword(Request $request){
        // Note: this code writtem by me using trait; 
        $user = User::find(Auth::user()->id); // Auth::user()->id same as Auth::id()
        $changed = $this->ValidateChangePassword($request, $user);
         if($changed){
             return redirect()->route('user.logout');        
        } else{
            return redirect()->back()->withErrors(['msg' => 'Password is invalid']);

        }
    }  
    public function ProductWithTag($tag){
        $products = Product::where('status' , 1)->where('product_tags_en' ,'like', '%'.$tag.'%')->orderby('id','DESC')->paginate(12);;
        // $categories = Category::orderBy('category_name_en', 'ASC')->get();
        return view('frontend.tags.tags_view', compact('products'));
    }
    
    // Subcategory wise data
	public function SubCatWiseProduct(Request $request, $subcat_id,$slug){
		$products = Product::where('status',1)->where('subcategory_id',$subcat_id)->orderBy('id','DESC')->paginate(3);
        $breadsubcat = SubCategory::with(['category'])->where('id',$subcat_id)->get(); // for page navigation
		// new idea video 464  Load More Product with Ajax 
		if ($request->ajax()) {
  
            $grid_view = view('frontend.product.grid_view_product',compact('products'))->render();
            $list_view = view('frontend.product.list_view_product',compact('products'))->render();
            return response()->json(['grid_view' => $grid_view,'list_view' => $list_view]);	
            }
                 ///  End Load More Product with Ajax 
        return view('frontend.product.subcategory_view',compact('products','slug','breadsubcat'));
	}
    // Sub-subcategory wise data
    public function SubSubCatWiseProduct($subsubcat_id,$slug){
        $products = Product::where('status',1)->where('subsubcategory_id', $subsubcat_id)->orderby('id','DESC')->paginate(12);
        $breadsubsubcat = SubSubcategory::with(['category','subcategory'])->where('id',$subsubcat_id)->get(); // for page navigation
        return view('frontend.product.subsubcategory_view',compact('products','slug','breadsubsubcat'));
    }

    
    // Product View With Ajax for add to cart modal
	public function ProductViewAjax($id){
//  new idea relational database table && using model functions 
        $product = Product::with('category','brand')->findOrFail($id); // 'category','brand' => method names in product model

		$color = $product->product_color_en;
		$product_color = explode(',', $color);

		$size = $product->product_size_en;
		$product_size = explode(',', $size);
		return response()->json(array(
			'product' => $product,
			'color' => $product_color,
			'size' => $product_size,

		));
	} // end method 

    //  new idea the post methods must return redirect NOT return view because this will cause browser message
    // 'your data will be lost if you leave this page' whenever the user leaves or refresh the page to solve this bug
    // I made the <form> tag method='get' and used Request $request as normal
    public function SearchProduct(Request $request){
        $request->validate([
            'search' =>'required'
        ]);// prevent the empty search input from redirect the user to search page 
        $item = $request->search;
        // new idea get all the fields that contains a word $item
        $products = Product::where('product_name_en', 'LIKE' , "%$item%")->get();
        return view('frontend.product.search_result' , compact('products','item'));
    }

    // Advanced search options
    public function SearchItems(Request $request){
        $request->validate([
            'search' =>'required'
        ]); 
        $item = $request->search;
        // new idea get all the fields that contains a word $item
        $products = Product::where('product_name_en', 'LIKE' , "%$item%")
        ->select('product_name_en','product_thambnail','selling_price','id','product_slug_en')
        ->limit(5)->get();
        return view('frontend.product.search_product', compact('products','item'));
    }
}
 