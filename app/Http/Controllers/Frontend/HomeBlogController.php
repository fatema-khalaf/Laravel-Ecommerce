<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog\BlogPostCategory;
use App\Models\Blog\BlogPost;

class HomeBlogController extends Controller
{
    //View blog
    public function BlogView(){
        $blogPosts = BlogPost::latest()->paginate(2);
        $blogCategories = BlogPostCategory::latest()->get();
        return view('frontend.blog.blog_view', compact('blogPosts','blogCategories'));
    }
    //View post details
    public function BlogPostDetailsView($id){
        $post = BlogPost::findOrFail($id);
        $blogCategories = BlogPostCategory::latest()->get();
        return view('frontend.blog.post_view', compact('post','blogCategories'));
    }
    // Get posts of one category
    public function BlogCatPost($category_id){
        $blogPosts = BlogPost::where('category_id',$category_id)->with('BlogCategory')->orderBy('id','DESC')->get();
        $blogCategories = BlogPostCategory::latest()->get();
        return view('frontend.blog.Cat_posts_view', compact('blogPosts','blogCategories'));
    }
}
