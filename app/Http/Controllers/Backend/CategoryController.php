<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Traits\StoreTrait;
use App\Traits\UpdateTrait;
use App\Traits\DeleteTrait;

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
        $res = $this->Store([
            'request'=> $request,
            'inputs'=>$inputs,
            'model'=>'App\Models\Category',
            'slugs'=>$slugs,
            'inputs_required'=> true
        ]);
        return redirect()->back()->with($res['notification']);
    }

    // View Edit category page
    public function CategoryEdite($id){
        $category = Category::findOrFail($id);
        return view('backend.category.category_edit', compact('category'));
    }

    // Update Edited data
    public function CategoryUpdate(Request $request){
        $inputs = array('category_name_en',"category_name_ar",'category_image'); // Dont include image input tage the image here is only icon name not image file name
        $slugs= array('category_slug_en'=>'category_name_en','category_slug_ar'=>'category_name_ar');
        // Update trait
        $notification=$this->Update([
                'request'=> $request,
                'inputs'=>$inputs,
                'model'=>'App\Models\Category',
                 'slugs'=>$slugs, //Optional
                'message'=>'Category Updated successfully', //Optional
                'inputs_required'=> false , //Optional
            ]);
            return redirect()->route('all.categories')->with($notification);
    }// end method

    // Delete category
    public function CategoryDelete($id){
        $notification = $this->Delete('App\Models\Category',$id,false ,'Category deleted successfully');
        return redirect()->back()->with($notification);
    }

}
