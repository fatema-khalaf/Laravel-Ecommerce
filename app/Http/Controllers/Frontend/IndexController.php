<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Auth;

class IndexController extends Controller
{
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
            @unlink(public_path('upload/user_images/'.$user->profile_photo_path));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/user_images'),$filename);
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
        $validateData = $request->validate([ 
           'oldPassword' => 'required',
           'password'=> 'required|confirmed'
        ]);
        $hashedPassword = Auth::user()->password;
        if(Hash::check($request->oldPassword, $hashedPassword)){ // Hash::check laravel build in method
            $user = User::find(Auth::user()->id); // Auth::user()->id same as Auth::id()
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return redirect()->route('user.logout');
        } else{
            return redirect()->back();
        }
    }
}
