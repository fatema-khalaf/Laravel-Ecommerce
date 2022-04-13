<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Traits\StoreTrait;
use App\Traits\UpdateTrait;
use App\Traits\DeleteTrait;
use Image;
class CategoryController extends Controller
{
    use StoreTrait;
    use UpdateTrait;
    use DeleteTrait;

    // View All categories page
    public function CatigoryView(){
        $categories = Category::latest()->get();
        return view('backend.category.category_view', compact('categories'));
    }


    // Store new category
    public function CategoryStore(Request $request){
        $inputs = array('category_name_en',"category_name_ar",'category_image');
        $slugs= array('category_slug_en'=>'category_name_en','category_slug_ar'=>'category_name_ar');
        // Store trait
        $notification = $this->Store([
            'request'=> $request,
            'inputs'=>$inputs,
            // 'image_path'=>'upload/category/',
            // 'new_image'=>'category_image', //Optional
            'model'=>'App\Models\Category',
            'slugs'=>$slugs,
            'inputs_required'=> true
        ]);
        return redirect()->back()->with($notification);
    }

    // View Edit category page
    public function CategoryEdite($id){
        $category = Category::findOrFail($id);
        return view('backend.category.category_edit', compact('category'));
    }

    // Update Edited data
    public function CategoryUpdate(Request $request){
        $inputs = array('category_name_en',"category_name_ar",'category_image'); // Dont include image input tage
        $slugs= array('category_slug_en'=>'category_name_en','category_slug_ar'=>'category_name_ar');
        // Update trait
        $notification=$this->Update([
                'request'=> $request,
                'inputs'=>$inputs,
                'model'=>'App\Models\Category',
                // 'new_image'=>'category_image', //Optional
                // 'image_path'=>'upload/category/', //Optional
                'slugs'=>$slugs, //Optional
                'message'=>'Category Updated successfully', //Optional
                'inputs_required'=> false , //Optional
            ]);
            return redirect()->route('all.categories')->with($notification);
    }// end method

    // Delete category
    public function CategoryDelete($id){
        //Optional image input tag name 
        //Optional notification message
        $notification = $this->Delete('App\Models\Category',$id,false ,'Category deleted successfully');
        return redirect()->back()->with($notification);
    }

}
