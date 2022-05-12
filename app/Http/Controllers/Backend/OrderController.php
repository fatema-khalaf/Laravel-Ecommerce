<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\OrderItem;
use PDF;
use Auth;

class OrderController extends Controller
{
    // pending  orders
    public function PendingOrders(){
        $orders = Order::where('status', 'pending')->orderBy('id','DESC')->get();
        return view('backend.orders.pending_orders', compact('orders'));
    }

    // Order Details 
	public function OrdersDetails($order_id){
		$order = Order::with('division','district','state','user')->where('id',$order_id)->first();
    	$orderItems = OrderItem::with('product')->where('order_id',$order_id)->orderBy('id','DESC')->get();
    	return view('backend.orders.orders_details',compact('order','orderItems'));

	} // end method 

    	// Confirmed Orders 
	public function ConfirmedOrders(){
		$orders = Order::where('status','confirmed')->orderBy('id','DESC')->get();
		return view('backend.orders.confirmed_orders',compact('orders'));

	} // end mehtod 


	// Processing Orders 
	public function ProcessingOrders(){
		$orders = Order::where('status','processing')->orderBy('id','DESC')->get();
		return view('backend.orders.processing_orders',compact('orders'));

	} // end mehtod 


    // Picked Orders 
	public function PickedOrders(){
		$orders = Order::where('status','picked')->orderBy('id','DESC')->get();
		return view('backend.orders.picked_orders',compact('orders'));

	} // end mehtod 



	// Shipped Orders 
	public function ShippedOrders(){
		$orders = Order::where('status','shipped')->orderBy('id','DESC')->get();
		return view('backend.orders.shipped_orders',compact('orders'));

	} // end mehtod 


	// Delivered Orders 
	public function DeliveredOrders(){
		$orders = Order::where('status','delivered')->orderBy('id','DESC')->get();
		return view('backend.orders.delivered_orders',compact('orders'));

	} // end mehtod 


	// Cancel Orders 
	public function CanceledOrders(){
		$orders = Order::where('status','canceled')->orderBy('id','DESC')->get();
		return view('backend.orders.canceled_orders',compact('orders'));

	} // end mehtod 

    // Confirm order status
    public function PendingToConfirm($id){
        Order::findOrFail($id)->update([
            'status' =>'confirmed'
        ]);
        $notification = array(
            'message'=> 'Order Confirm Successfully',
            'alert-type' =>'success'
        );
        return redirect()->route('pending.orders')->with($notification);
    }
    // Processing order status
    public function ConfirmToProcessing($id){
        Order::findOrFail($id)->update([
            'status' =>'processing'
        ]);
        $notification = array(
            'message'=> 'Order Processing Successfully',
            'alert-type' =>'success'
        );
        return redirect()->route('confirmed-orders')->with($notification);
    }
    // Picked order status
    public function ProcessingToPicked($id){
        Order::findOrFail($id)->update([
            'status' =>'picked'
        ]);
        $notification = array(
            'message'=> 'Order Picked Successfully',
            'alert-type' =>'success'
        );
        return redirect()->route('processing-orders')->with($notification);
    }
    // Shipped order status
    public function pickedToShipped($id){
        Order::findOrFail($id)->update([
            'status' =>'shipped'
        ]);
        $notification = array(
            'message'=> 'Order Shipped Successfully',
            'alert-type' =>'success'
        );
        return redirect()->route('picked-orders')->with($notification);
    }
    // Delivered order status
    public function ShippedToDelivered($id){
        Order::findOrFail($id)->update([
            'status' =>'delivered'
        ]);
        $notification = array(
            'message'=> 'Order Delivered Successfully',
            'alert-type' =>'success'
        );
        return redirect()->route('shipped-orders')->with($notification);
    }
    // download invoice
    public function AdminInvoiceDownload($order_id){
		$order = Order::with('division','district','state','user')->where('id',$order_id)->first();
    	$orderItems = OrderItem::with('product')->where('order_id',$order_id)->orderBy('id','DESC')->get();
		$pdf = PDF::loadView('backend.orders.order_invoice',compact('order','orderItems'))->setPaper('a4');
		return $pdf->download('invoice.pdf');

	} // end method 

}
