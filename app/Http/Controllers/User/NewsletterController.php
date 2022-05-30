<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Newsletter;
use Carbon\Carbon;

class NewsletterController extends Controller
{
    // add suscribe to news letter 
    public function Subscribe(Request $request){
        $request->validate(['email' =>'required|email|unique:newsletters']);
       try{
           Newsletter::insert([
               'email'=>$request->email,
               'created_at' => Carbon::now()
           ]);
       }catch(\Exeption $e){
           \Illuminate\Validator\ValidationException::withMessage([
               'email' => 'This email can not be added!'
           ]);
       
       }
        $notification = array(
            'message' => 'You Have subscribed succefully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification); 
    }
}
