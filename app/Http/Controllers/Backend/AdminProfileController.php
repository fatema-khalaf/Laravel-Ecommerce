<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\Admin;
use Illuminate\Support\Facades\Hash;
use Auth;

class AdminProfileController extends Controller
{
    // View profile
    public function AdminProfile()
    {
        $adminData = Admin::find(1);
        return view("admin.admin_profile_view", compact("adminData"));
    }
    // View edit profile
    public function AdminProfileEdit()
    {
        $editData = Admin::find(1);
        return view("admin.admin_profile_edit", compact("editData"));
    }
    // store edited data
    public function AdminProfileStore(Request $request)
    {
        $data = Admin::find(1);
        $data->name = $request->name;
        $data->email = $request->email;
        if ($request->file("profile_photo_path")) {
            $file = $request->file("profile_photo_path");
            @unlink(public_path('upload/admin_images/'.$data->profile_photo_path));
            $fileName = date("YmdHi") . $file->getClientOriginalName();
            $file->move(public_path("upload/admin_images"),$fileName);
            $data["profile_photo_path"] = $fileName; // same as $data->profile_photo_path 
        }
        $data->save();

        $notification= array(
            'message' => 'Admin profile Updated successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.profile')->with($notification);
    }

    // View change password
    public function AdminChangePassword(){
        return view("admin.admin_change_password");
    }

    // Store new password
    public function AdminUpdateChangePassword(Request $request){
        // NOTE: $request has many default methods, e.x -> validate
        $validateData = $request->validate([ 
           'oldPassword' => 'required',
           'password'=> 'required|confirmed'
        ]);
        $hashedPassword = Admin::find(1)->password;
        if(Hash::check($request->oldPassword, $hashedPassword)){ // Hash::check laravel build in method
            $admin = Admin::find(1);
            $admin->password = Hash::make($request->password);
            $admin->save();
            Auth::logout();
            return redirect()->route('admin.logout');
        } else{
            return redirect()->back();
        }

    }
}
