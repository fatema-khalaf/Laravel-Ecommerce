<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\Admin;
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
            $file->move(public_path("upload/admin_images"), $fileName);
            $data["profile_photo_path"] = $fileName;
        }
        $data->save();
        return redirect()->route('admin.profile');
    }
}
