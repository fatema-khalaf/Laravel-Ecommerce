<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\Admin;
use App\models\User;
use Illuminate\Support\Facades\Hash;
use Auth;
use Image;

class AdminProfileController extends Controller
{
    // View profile
    public function AdminProfile()
    {
        // $adminData = Admin::find(1);
        $adminData = Admin::find(Auth::user()->id);
        return view("admin.admin_profile_view", compact("adminData"));
    }
    // View edit profile
    public function AdminProfileEdit()
    {
        $editData = Admin::find(Auth::user()->id);
        return view("admin.admin_profile_edit", compact("editData"));
    }
    // store edited data
    public function AdminProfileStore(Request $request)
    {
        $data = Admin::find(Auth::user()->id);
        $data->name = $request->name;
        $data->email = $request->email;
        if ($request->file("profile_photo_path")) {
            $image = $request->file('profile_photo_path');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalextension();
            Image::make($image)->resize(225, 225)->save('upload/admin_images/' . $name_gen);
            $save_url = 'upload/admin_images/' . $name_gen;
            @unlink(public_path($data->profile_photo_path));

            // $file = $request->file("profile_photo_path");
            // $fileName = date("YmdHi") . $file->getClientOriginalName();
            // $file->move(public_path("upload/admin_images"),$fileName);
            $data["profile_photo_path"] = $save_url; // same as $data->profile_photo_path 
        }
        $data->save();

        $notification = array(
            'message' => 'Admin profile Updated successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.profile')->with($notification);
    }

    // View change password
    public function AdminChangePassword()
    {
        return view("admin.admin_change_password");
    }

    // Store new password
    public function AdminUpdateChangePassword(Request $request)
    {
        // NOTE: $request has many default methods, e.x -> validate
        $validateData = $request->validate(
            [
                'oldPassword' => 'required',
                'password' => 'required|confirmed'
            ],
            [
                'password.confirmed' => 'The password confirmation does not match!'
            ]
        );
        $hashedPassword = Admin::find(Auth::user()->id)->password;
        if (Hash::check($request->oldPassword, $hashedPassword)) { // Hash::check laravel build in method
            $admin = Admin::find(Auth::user()->id);
            $admin->password = Hash::make($request->password);
            $admin->save();
            Auth::logout();
            return redirect()->route('admin.logout');
        } else {
            return redirect()->back()->withErrors(["oldPassword" => "Wrong password!"]);
        }
    }

    // View all users
    public function UsersView()
    {
        $users = User::latest()->get();
        return view('backend.user.users_view', compact('users'));
    }
}