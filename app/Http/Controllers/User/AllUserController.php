<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\OrderItem;
use Auth;

class AllUserController extends Controller
{
    // get user orders

    public function MyOrders(){
        $user = Auth::id();
        $orders = Order::where('user_id', $user)->orderBy('id','DESC')->get();
        return view('frontend.profile.order.order_view' , compact('orders'));
    }

    // Get order details
    public function OrderDetails($id){
        $order = Order::with('division','district','state','user')->where('id', $id)->where('user_id', Auth::id())->first();
        $orderItems = OrderItem::with('product')->where('order_id' ,$id )->orderBy('id','DESC')->get();
        return view('frontend.profile.order.order_details', compact('order','orderItems'));

    }
}
