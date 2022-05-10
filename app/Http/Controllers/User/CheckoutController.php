<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\ShipDivision;
use App\Models\ShipDistrict;
use App\Models\ShipState;
use Auth;

class CheckoutController extends Controller
{
    // View Checkout new idea
    public function ViewCheckout(){
        if(Auth::check()){
            if(Cart::total()>0){
                $carts = Cart::content();
                $cartQty = Cart::count();
                $cartTotal = Cart::total(); 
                $divisions = ShipDivision::orderBy('division_name','ASC')->get();       
                return view('frontend.checkout.checkout_view', compact('carts','cartQty','cartTotal','divisions'));
            }else{
                return redirect()->to('/')->with([
                    'message' =>'Shopping Cart is Empty',
                    'alert-type' =>'error'
                ]);
            }
        }else{
            return redirect()->route('login')->with([
                'message' =>'You need to Login First',
                'alert-type' =>'error'
            ]);
        }
    }
    // Get districts
    public function GetDistricts($id){
        $districts = ShipDistrict::where('division_id',$id)->orderBy('district_name','ASC')->get();
        return json_encode($districts);
    }
    // Get stats
    public function GetStates($id){
        $stats = ShipState::where('district_id',$id)->orderBy('state_name','ASC')->get();
        return json_encode($stats);
    }
    // Store checkout data
    public function CheckoutStore(Request $request){
        $data=array();
        $data['shipping_name']=$request->shipping_name;
        $data['shipping_email']=$request->shipping_email;
        $data['shipping_phone']=$request->shipping_phone;
        $data[ 'post_code']=$request->post_code;
        $data['division_id']=$request->division_id;
        $data[ 'district_id']=$request->district_id;
        $data['state_id']=$request->state_id;
        $data['notes']= $request->notes;
        $cartTotal= Cart::total();

        if($request->payment_method == 'stripe'){
            return view('frontend.payment.stripe' , compact('data', 'cartTotal'));
        }elseif($request->payment_method == 'card'){
            // return view('frontend.payment.stripe' ,  compact('data'));
        }else{
            // return view('frontend.payment.stripe' ,  compact('data'));
        }
    }
}
