<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Newsletter;
use Carbon\Carbon;
use App\Traits\StoreTrait;
use App\Traits\UpdateTrait;
use App\Traits\DeleteTrait;
use App\Traits\ActivateTrait;

class NewsletterController extends Controller
{
    use StoreTrait;
    use UpdateTrait;
    use DeleteTrait;
    use ActivateTrait;
    // add suscribe to news letter 
    public function Subscribe(Request $request){
        $request->validate(['email' =>'required|email|unique:newsletters']);
    //   new Idea
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

    // View all subscribers in dashboard
    public function NewsletterView (){
        $emails = Newsletter::latest()->get();
        return view('backend.newsletter.newsletter_view', compact('emails'));
    }
     // Delete Subscriber 
     public function NewsletterDelete($id){
        $notification = $this->Delete('App\Models\Newsletter',$id, false,'Subscriber deleted successfully');
        return redirect()->back()->with($notification);
    }

    public function NewsletterInactivate($id){
        $notification = $this->Inactivate('App\Models\Newsletter', $id, 'Subscriber Inactivated');
        return redirect()->back()->with($notification);
        
    } // end method 
    public function NewsletterActivate($id){
        $notification = $this->Activate('App\Models\Newsletter', $id, 'Subscriber Activated');
        return redirect()->back()->with($notification);
    } // end method 
}
