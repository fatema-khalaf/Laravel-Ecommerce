<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class ReturnController extends Controller
{
    // View all return requests
    public function ReturnRequestView (){
        $orders = Order::where('return_order',1)->orderBy('id','DESC')->get();
        return view('backend.orders.return_order_request' , compact('orders'));
    }
    // approve return request 
    public function ReturnRequestApprove($id){
        Order::where('id', $id)->update([
            'return_order' => 2
        ]);
        $notification = array(
            'message'=>'Return Requst Approved Successfully',
            'alert-type'=>"success"
        );
        return redirect()->back()->with($notification);
    }
    // View all approved return requests
    public function RequestApprovedView (){
        $orders = Order::where('return_order',2)->orderBy('id','DESC')->get();
        return view('backend.orders.approved_return_request' , compact('orders'));
    }
}
