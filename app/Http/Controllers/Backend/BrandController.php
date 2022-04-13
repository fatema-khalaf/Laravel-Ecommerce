<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Traits\StoreTrait;
use App\Traits\UpdateTrait;
use App\Traits\DeleteTrait;
use Image;
class BrandController extends Controller
{
    use StoreTrait;
    use UpdateTrait;
    use DeleteTrait;
    //View all brands
    public function BrandView(){
        $brands = Brand::latest()->get();
        return view('backend.brand.brand_view', compact('brands'));
    }

    // Store new brand
    public function BrandStore(Request $request){
        $inputs = array('brand_name_en',"brand_name_ar");
        $slugs= array('brand_slug_en'=>'brand_name_en','brand_slug_ar'=>'brand_name_ar');
        // Store trait
        $notification = $this->Store([
            'request'=> $request,
            'inputs'=>$inputs,
            'image_path'=>'upload/brand/',
            'new_image'=>'brand_image', //Optional
            'model'=>'App\Models\Brand',
            'slugs'=>$slugs,
            'inputs_required'=> true
        ]);
        return redirect()->back()->with($notification);
    }

    // View Edit brand page
    public function BrandEdite($id){
        $brand = Brand::findOrFail($id);
        return view('backend.brand.brand_edit', compact('brand'));
    }

    // Update Edited data
    public function BrandUpdate(Request $request){
        $inputs = array('brand_name_en',"brand_name_ar"); // Dont include image input tage
        $slugs= array('brand_slug_en'=>'brand_name_en','brand_slug_ar'=>'brand_name_ar');
        // Update trait
        $notification=$this->Update([
                'request'=> $request,
                'inputs'=>$inputs,
                'model'=>'App\Models\Brand',
                'new_image'=>'brand_image', //Optional
                'image_path'=>'upload/brand/', //Optional
                'slugs'=>$slugs, //Optional
                'message'=>'Brand Updated successfully', //Optional
                'inputs_required'=> false , //Optional
            ]);
            return redirect()->route('all.brands')->with($notification);
    }// end method

    // Delete brand
    public function BrandDelete($id){
        //Optional image input tag name 
        //Optional notification message
        $notification = $this->Delete('App\Models\Brand',$id,'brand_image', 'Brand deleted successfully');
        return redirect()->back()->with($notification);
    }
}
