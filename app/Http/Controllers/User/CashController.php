<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderMail;
use Auth;

class CashController extends Controller
{
    // cash order
    public function CashOrder(Request $request){
        if (Session::has('coupon')){
            $total_amount = Session::get('coupon')['total_amount']; 
        }else{
            $total_amount = str_replace(',','',Cart::total());
        }
        // insert data to order database table
        $order_id = Order::insertGetId([
            'user_id' => Auth::id(),
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'state_id' => $request->state_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'post_code' => $request->post_code,
            'notes' => $request->notes,

            'payment_type' => 'Cash On Delivery',
            'payment_method' =>  'Cash On Delivery',
            // 'transaction_id' => $charge->balance_transaction,
            'currency' => 'usd',
            'amount' => $total_amount,
            'order_number' => uniqid(),

            'invoice_no' => 'Pro-E'.mt_rand(10000000,99999999), // 'Pro-E' any charecters from my mind & random numbers 
            'order_date' => Carbon::now()->format('d F Y'),
            'order_month' => Carbon::now()->format('F'),
            'order_year' => Carbon::now()->format('Y'),
            'status' => 'Pending',
            'created_at' => Carbon::now(),
        ]);

        // Send email to user 
        $invoice = Order::findOrFail($order_id);
        $data = [
            'invoice_no' => $invoice->invoice_no,
            'amount' => $total_amount,
            'name' => $invoice->name,
            'email' => $invoice->email
        ];
        Mail::to($request->email)->send(new OrderMail($data));

        $carts = Cart::content(); // get order cart items
        // insert each ordered item into order items database table 
        foreach ($carts as $cart){
            OrderItem::insert([
                'order_id' => $order_id,
                'product_id' => $cart->id,
                'color' => $cart->options->color,
                'size' => $cart->options->size,
     		    'qty' => $cart->qty,
     		    'price' => $cart->price,
     		    'created_at' => Carbon::now(),
            ]);
        }
        // delete the coupon from the session
        if(Session::has('coupon')){
            Session::forget('coupon');
        }
        Cart::destroy();// empty the cart

        $notification = array(
            'message' => 'Your order has been placed successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('dashboard')->with($notification);

    }
}