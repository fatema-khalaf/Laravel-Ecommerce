<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;
use Carbon\Carbon;
use App\Traits\StoreTrait;
use App\Traits\UpdateTrait;
use App\Traits\DeleteTrait;

class CouponController extends Controller
{
    use StoreTrait;
    use UpdateTrait;
    use DeleteTrait;
    // View All coupons page
    public function CouponView(){
        $coupons = Coupon::orderBy('id','DESC')->get();
        return view('backend.coupon.coupon_view', compact('coupons'));
    }

    // Store new coupon
    public function CouponStore(Request $request){
        $inputs = array('coupon_name',"coupon_discount",'coupon_validity');
        // Store trait
        $res = $this->Store([
            'request'=> $request,
            'inputs'=>$inputs,
            'model'=>'App\Models\Coupon',
            'inputs_required'=> true
        ]);
        return redirect()->back()->with($res['notification']);
    }

    // View Edit page
    public function CouponEdit($id){
        $coupon = Coupon::findOrFail($id);
        return view('backend.coupon.coupon_edit', compact('coupon'));
    }

     // Update Edited data
     public function CouponUpdate(Request $request){
        $inputs = array('coupon_name',"coupon_discount",'coupon_validity');
        // Update trait
        $notification=$this->Update([
                'request'=> $request,
                'inputs'=>$inputs,
                'model'=>'App\Models\Coupon',
            ]);
        return redirect()->route('all.coupons')->with($notification);
    }// end method

    // Delete category
    public function CouponDelete($id){
        $notification = $this->Delete('App\Models\Coupon',$id,false ,'Coupon deleted successfully');
        return redirect()->back()->with($notification);
    }
}
