<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subcategory;
use App\Models\Category;
use App\Traits\StoreTrait;
use App\Traits\UpdateTrait;
use App\Traits\DeleteTrait;

class SubcategoryController extends Controller
{
    use StoreTrait;
    use UpdateTrait;
    use DeleteTrait;

    // View All categories page
    public function SubcatigoryView(){
        $subcategories = Subcategory::latest()->get();
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        return view('backend.category.subcategory_view', compact('subcategories','categories'));
    }

     // Store new category
     public function SubcategoryStore(Request $request){
        $inputs = array('subcategory_name_en',"subcategory_name_ar","category_id");
        $slugs= array('subcategory_slug_en'=>'subcategory_name_en','subcategory_slug_ar'=>'subcategory_name_ar');
        // Store trait
        $notification = $this->Store([
            'request'=> $request,
            'inputs'=>$inputs,
            'model'=>'App\Models\SubCategory',
            'slugs'=>$slugs,
            'inputs_required'=> true
        ]);
        return redirect()->back()->with($notification);
    }

        // View Edit category page
        public function SubcategoryEdite($id){
            $subcategory = Subcategory::findOrFail($id);  
            $categories = Category::orderBy('category_name_en', 'ASC')->get();
            return view('backend.category.subcategory_edit', compact('subcategory','categories'));
        }
    
        // Update Edited data
        public function SubcategoryUpdate(Request $request){
            $inputs = array('subcategory_name_en',"subcategory_name_ar","category_id");
            $slugs= array('subcategory_slug_en'=>'subcategory_name_en','subcategory_slug_ar'=>'subcategory_name_ar');
            // Update trait
            $notification=$this->Update([
                    'request'=> $request,
                    'inputs'=>$inputs,
                    'model'=>'App\Models\Subcategory',
                    'slugs'=>$slugs, //Optional
                    'message'=>'Subcategory Updated successfully', //Optional
                    'inputs_required'=> false , //Optional
                ]);
                return redirect()->route('all.subcategories')->with($notification);
        }// end method
    
        // Delete category
        public function SubcategoryDelete($id){
            $notification = $this->Delete('App\Models\Subcategory',$id, false ,'Subategory deleted successfully');
            return redirect()->back()->with($notification);
        }

}
