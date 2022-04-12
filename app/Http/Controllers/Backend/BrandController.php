<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Traits\StoreTrait;
use Image;
class BrandController extends Controller
{
    use StoreTrait;
    //View all brands
    public function BrandView(){
        $brands = Brand::latest()->get();
        return view('backend.brand.brand_view', compact('brands'));
    }

    // Store new brand
    public function BrandStore(Request $request){
        $inputs = array('brand_name_en',"brand_name_ar",'brand_image');
        $slugs= array('brand_slug_en'=>'brand_name_en','brand_slug_ar'=>'brand_name_ar');
        // Store trait
        $this->Store([
            'request'=> $request,
            'inputs'=>$inputs,
            'image_path'=>'upload/brand/',
            'model'=>'App\Models\Brand',
            'slugs'=>$slugs,
            'inputs_required'=> true
        ]);
        // Added notification trait
        $notification =  $this->AddedNotification('Brand');
        return redirect()->back()->with($notification);
    }

    // View Edit brand page
    public function BrandEdite($id){
        $brand = Brand::findOrFail($id);
        return view('backend.brand.brand_edit', compact('brand'));
    }
    // Update Edited data
    public function BrandUpdate(Request $request){
        $brand_id = $request->id;
        $old_img = $request->old_image;
        if($request->file('brand_image')){
            unlink($old_img);
            $image = $request-> file('brand_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(300,300)->save('upload/brand/'.$name_gen);
            $save_url = 'upload/brand/'.$name_gen;
            Brand::findOrfail($brand_id)->update([
                'brand_name_en' => $request->brand_name_en,
                'brand_name_ar' => $request->brand_name_ar,
                'brand_slug_en' => strtolower(str_replace(' ','-', $request->brand_name_en)), 
                'brand_slug_ar' => strtolower(str_replace(' ','-', $request->brand_name_ar)), 
                'brand_image' => $save_url,
            ]);
            $notification = array(
                'message'=>'Brand Updated successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.brands')->with($notification);
        }else{
            Brand::findOrfail($brand_id)->update([
                'brand_name_en' => $request->brand_name_en,
                'brand_name_ar' => $request->brand_name_ar,
                'brand_slug_en' => strtolower(str_replace(' ','-', $request->brand_name_en)), 
                'brand_slug_ar' => strtolower(str_replace(' ','-', $request->brand_name_ar)), 
            ]);
            $notification = array(
                'message'=>'Brand Updated successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.brands')->with($notification);
        }// end else
    }// end method

    // Delete brand
    public function BrandDelete($id){
        $brand = Brand::findOrFail($id);
        $image= $brand->brand_image;
        unlink($image);
        Brand::findOrFail($id)->delete();
        $notification = array(
            'message'=>'Brand Deleted successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
