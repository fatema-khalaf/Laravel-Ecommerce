<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog\BlogPostCategory;
use App\Traits\StoreTrait;
use App\Traits\UpdateTrait;
use App\Traits\DeleteTrait;
class BlogController extends Controller
{
    use StoreTrait;
    use UpdateTrait;
    use DeleteTrait;

    // View All blog categories page
    public function BlogCatigoryView(){
        $categories = BlogPostCategory::latest()->get();
        return view('backend.blog.category.category_view', compact('categories'));
    }
    // Store new blog category
    public function BlogCategoryStore(Request $request){
        $inputs = array("blog_category_name_en","blog_category_name_ar");
        $slugs= array('blog_category_slug_en'=>'blog_category_name_en','blog_category_slug_ar'=>'blog_category_name_ar');
        // Store trait
        $res = $this->Store([
            'request'=> $request,
            'inputs'=>$inputs,
            'model'=>'App\Models\\Blog\BlogPostCategory',
            'slugs'=>$slugs,
            'inputs_required'=> true
        ]);
        return redirect()->back()->with($res['notification']);
    }

    // View Edit blog category page
    public function BlogCategoryEdite($id){
        $category = BlogPostCategory::findOrFail($id);
        return view('backend.blog.category.category_edit', compact('category'));
    }

    // Update Edited data
    public function BlogCategoryUpdate(Request $request){
        $inputs = array("blog_category_name_en","blog_category_name_ar");
        $slugs= array('blog_category_slug_en'=>'blog_category_name_en','blog_category_slug_ar'=>'blog_category_name_ar');
        // Update trait
        $notification=$this->Update([
                'request'=> $request,
                'inputs'=>$inputs,
                'model'=>'App\Models\Blog\BlogPostCategory',
                'slugs'=>$slugs, //Optional
                'message'=>'Blog Category Updated successfully', //Optional
                'inputs_required'=> false , //Optional
            ]);
            return redirect()->route('blog.category')->with($notification);
    }// end method

    // Delete category
    public function BlogCategoryDelete($id){
        $notification = $this->Delete('App\Models\Blog\BlogPostCategory',$id,false ,'Blog Category deleted successfully');
        return redirect()->back()->with($notification);
    }
}
