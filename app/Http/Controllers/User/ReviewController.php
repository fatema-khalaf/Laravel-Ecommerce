<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Traits\StoreTrait;
use App\Traits\UpdateTrait;
use App\Traits\DeleteTrait;
class ReviewController extends Controller
{
    use StoreTrait;
    use UpdateTrait;
    use DeleteTrait;

    // add product review
    public function AddReview(Request $request){
        $inputs = array('product_id','user_id','summary','comment','rating');
        // Store trait
        $res = $this->Store([
            'request'=> $request,
            'inputs'=>$inputs,
            'model'=>'App\Models\Review',
            'inputs_required'=> true,
            'message' => 'Thanks for your review'
        ]);
        return redirect()->back()->with($res['notification']);
    }
    // View pending reviews page
    public function PendingReviewsView(){
    	$reviews = Review::where('status',0)->orderBy('id','DESC')->get();
    	return view('backend.review.pending_review',compact('reviews'));
    }  
    // approve to publish a review
    public function PublishReview($id){
    	Review::where('id',$id)->update(['status' => 1]);
    	$notification = array(
            'message' => 'Review Approved Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } 
    // View published reviews page
    public function PublishedReviewsView(){
        $reviews = Review::where('status',1)->orderBy('id','DESC')->get();
        return view('backend.review.published_review',compact('reviews'));
    }  
    // Delete review
    public function DeleteReview($id){
        Review::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Review Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

}
