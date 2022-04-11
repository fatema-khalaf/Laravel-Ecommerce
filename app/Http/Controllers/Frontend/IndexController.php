<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Traits\ChangePasswordTrait;
use App\Traits\ReplaceImageTrait;
use Auth;

class IndexController extends Controller
{
    // Use Change password trait
    use ChangePasswordTrait;
    // Use replace Image trait
    use ReplaceImageTrait;

    // View home page
    public function Index(){
        return view('frontend.index');
    }
    // Logout user
    public function UserLogout(){
        Auth::logout();
        return Redirect()->route('login');
    }
    // View user profile
    public function UserProfile(){
        $id= Auth::user()->id;
        $user = User::find($id);
        return view('frontend.profile.user_profile', compact('user'));
    }
    // Store Updated data
    public function UserProfileStore(Request $request){
        $id=Auth::user()->id;
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        if($request->file('profile_photo_path')){
            $file = $request->file('profile_photo_path');
            // Note: this code writtem by me using trait; 
            $filename= $this->replaceImage($user->profile_photo_path,$file,'upload/user_images'); // oldfile, newFile , path
            $user['profile_photo_path']=$filename;
        }
        $user->save();
        $notification= array(
            'message'=> 'User Profile updated successfully',
            'alert_type' =>'success'
        );
        return redirect()->route('dashboard')->with($notification);
    }
    // View change password 
    public function UserChangePassword(){
        $id= Auth::user()->id;
        $user = User::find($id);
        return view('frontend.profile.change_password', compact('user'));
    }

    // Store new password
    public function UserUpdateChangePassword(Request $request){
        // Note: this code writtem by me using trait; 
        $user = User::find(Auth::user()->id); // Auth::user()->id same as Auth::id()
        $changed = $this->ValidateChangePassword($request, $user);
         if($changed){
             return redirect()->route('user.logout');        
        } else{
            return redirect()->back()->with('error', 'Password is invalid');
        }
    }  
}
 