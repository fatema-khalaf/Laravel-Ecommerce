<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\OrderItem;
use Auth;
use Barryvdh\DomPDF\Facade\Pdf;


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
    
    // Download invoice
    public function InvoiceDownload($id){
        $order = Order::with('division','district','state','user')->where('id', $id)->where('user_id', Auth::id())->first();
        $orderItems = OrderItem::with('product')->where('order_id' ,$id )->orderBy('id','DESC')->get();
        // return view('frontend.profile.order.order_invoice', compact('order','orderItems'));

        $pdf = PDF::loadView('frontend.profile.order.order_invoice', compact('order','orderItems'));
        return $pdf->download('invoice.pdf'); //downloaded file name
    }
    // Return order request 
    public function ReturnOrder(Request $request, $id){
        Order::findOrFail($id)->update([
            'return_date' => Carbon::now()->format('d F Y'),
            'return_reason' => $request->return_reason,
            'return_order' => 1,
        ]);
        $notification=array(
            'message' => 'Return Request Sent Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('my.orders')->with($notification); 
    }
    // View user returned orders list
    public function ReturnOrdersList(){
        $user = Auth::id();
        $orders = Order::where('user_id', $user)->where('return_reason', '!=', NULL)->orderBy('id','DESC')->get();  
        return view('frontend.profile.order.return_order_view' , compact('orders'));
    }
    // View user canceled orders list
    public function CanceledOrdersList(){
        $user = Auth::id();
        $orders = Order::where('user_id', $user)->where('status', 'canceled')->orderBy('id','DESC')->get();  
        return view('frontend.profile.order.canceled_order_view' , compact('orders'));
    }

}
