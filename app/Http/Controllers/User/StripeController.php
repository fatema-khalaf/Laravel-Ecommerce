<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderMail;
use Auth;
use DB;
use App\Events\NewOrder;
class StripeController extends Controller
{
    // stripe oreder
    public function StripeOrder(Request $request){
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        if (Session::has('coupon')){
            $total_amount = Session::get('coupon')['total_amount']; 
        }else{
            $total_amount = str_replace(',','',Cart::total());
        }
        // this lins from strip docs👇👇
        $token = $_POST['stripeToken'];
        $charge = \Stripe\Charge::create([
        'amount' => $total_amount*100,
        'currency' => 'usd',
        'description' => 'Pro-Ecommerce',
        'source' => $token,
        'metadata' => ['order_id' => uniqid()]
        ]);
        // dd($request->all());

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

            'payment_type' => 'Stripe',
            'payment_method' => $charge->payment_method,
            'transaction_id' => $charge->balance_transaction,
            'currency' => $charge->currency,
            'amount' => $total_amount,
            'order_number' => $charge->metadata->order_id,

            'invoice_no' => 'Pro-E'.mt_rand(10000000,99999999), // 'Pro-E' any charecters from my mind & random numbers 
            'order_date' => Carbon::now()->format('d F Y'),
            'order_month' => Carbon::now()->format('F'),
            'order_year' => Carbon::now()->format('Y'),
            'status' => 'Pending',
            'created_at' => Carbon::now(),
        ]);

        // Send email to user new idea
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

            // new idea video 432
            // reduce product quantity
            Product::where('id',$cart->id)
                    ->update(['product_qty' => DB::raw('product_qty-'.$cart->qty)]);
            // make product status 0 if qty became 0
            $prod = Product::findOrFail($cart->id);
            if($prod->product_qty == 0){
               $prod->update(['status' => 0]);
            }
        }
        // delete the coupon from the session
        if(Session::has('coupon')){
            Session::forget('coupon');
        }
        Cart::destroy();// empty the cart

        //new idea by me" Add new order event when ever new order happens
        event(new NewOrder($order_id)); // create NewOrder event and send order id as event data

        $notification = array(
            'message' => 'Your order has been placed successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('dashboard')->with($notification);
    }
}
