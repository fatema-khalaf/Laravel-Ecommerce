<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog\BlogPostCategory;
use App\Models\Blog\BlogPost;
use App\Models\Blog\BlogComment;
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
            'model'=>'App\Models\Blog\BlogPostCategory',
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

    /////////////////////////// BLOG POST ////////////////////////////
    
    // View all posts
    public function BlogPostview(){
        $posts = BlogPost::latest()->with('BlogCategory')->get();
        return view('backend.blog.post.post_view',compact('posts'));
    }
    // View Add Post Page
    public function BlogPostAdd(){
        $categories = BlogPostCategory::latest()->get();
        return view('backend.blog.post.add_post_view',compact('categories'));
    }
    // store new post
    public function BlogPostStore(Request $request){
        $inputs = array("category_id","post_title_en","post_title_ar","post_details_en","post_details_ar");
        $slugs= array('post_slug_en'=>'post_title_en','post_slug_ar'=>'post_title_ar');
        // Store trait
        $res = $this->Store([
            'request'=> $request,
            'inputs'=>$inputs,
            'model'=>'App\Models\Blog\BlogPost',
            'new_image'=>'post_image', 
            'image_path'=>'upload/post/', 
            "image_width" => 780,
            "image_height" => 433,
            'message'=>'Post added successfully', 
            'slugs'=>$slugs,
            'inputs_required'=> true
        ]);
        return redirect()->route('blog.posts')->with($res['notification']);
    }

    // View Edit blog category page
    public function BlogPostEdite($id){
        $post = BlogPost::findOrFail($id);
        $categories = BlogPostCategory::latest()->get();
        return view('backend.blog.post.post_edit', compact('post', 'categories'));
    }

    // Update Edited data
    public function BlogPostUpdate(Request $request){
        $inputs = array("category_id","post_title_en","post_title_ar","post_details_en","post_details_ar");
        $slugs= array('post_slug_en'=>'post_title_en','post_slug_ar'=>'post_title_ar');
        // Update trait
        $notification=$this->Update([
                'request'=> $request,
                'inputs'=>$inputs,
                'model'=>'App\Models\Blog\BlogPost',
                'slugs'=>$slugs, 
                "image_width" => 780,
            "image_height" => 433,
                'new_image'=>'post_image', 
                'image_path'=>'upload/post/', 
                'message'=>'Post Updated successfully', 
                'inputs_required'=> false ,
            ]);
            return redirect()->route('blog.posts')->with($notification);
    }// end method

    // Delete category
    public function BlogPostDelete($id){
        $notification = $this->Delete('App\Models\Blog\BlogPost',$id,'post_image' ,'Post deleted successfully');
        return redirect()->back()->with($notification);
    }

    // add comment to blog post
    public function AddComment(Request $request){
        $inputs = array('post_id','user_id','comment');
        // Store trait
        $res = $this->Store([
            'request'=> $request,
            'inputs'=>$inputs,
            'model'=>'App\Models\Blog\BlogComment',
            'inputs_required'=> true,
            'message' => 'Thanks for your comment'
        ]);
        return redirect()->back()->with($res['notification']);
    }

}
