<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Auth;
use Image;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Traits\UpdateTrait;
use App\Traits\DeleteTrait;

class AdminUserController extends Controller
{
    use UpdateTrait;
    use DeleteTrait;

    // view all admins role 
    public function AllAdminRole(){
        $adminusers = Admin::where('type',2)->latest()->get();
    	return view('backend.role.admin_role_all',compact('adminusers'));
    }
    // view Add new admin page
    public function AddAdminView(){
    	return view('backend.role.create_admin');
    }
    // Store admin data
    public function AdminUserStore(Request $request){
        $image = $request->file('profile_photo_path');
    	$name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
    	Image::make($image)->resize(225,225)->save('upload/admin_images/'.$name_gen);
    	$save_url = 'upload/admin_images/'.$name_gen;

        Admin::insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'brand' => $request->brand,
            'category' => $request->category,
            'product' => $request->product,
            'slider' => $request->slider,
            'coupons' => $request->coupons,
    
            'shipping' => $request->shipping,
            'blog' => $request->blog,
            'setting' => $request->setting,
            'returnOrders' => $request->returnOrders,
            'review' => $request->review,
    
            'orders' => $request->orders,
            'reports' => $request->reports,
            'users' => $request->users,
            'adminRole' => $request->adminRole,
            'type' => 2,
            'profile_photo_path' => $save_url,
            'created_at' => Carbon::now(),
       
            ]);
    
            $notification = array(
                'message' => 'Admin User Created Successfully',
                'alert-type' => 'success'
            );
    
            return redirect()->route('all.admins')->with($notification);
    }
    // View edit admin page
    public function EditAdminView($id){
        $adminuser = Admin::findOrFail($id);
        return view('backend.role.admin_role_edit',compact('adminuser'));
    }
    // store update admin data
    public function UpdateAdmin(Request $request){
        $inputs = array('name','email','phone','brand','category','product','slider','coupons','shipping','returnOrders','blog','setting','review','orders','reports','adminRole','users','type'); 
        // Update trait
        $notification=$this->Update([
                'request'=> $request,
                'inputs'=>$inputs,
                'model'=>'App\Models\Admin',
                'new_image'=>'profile_photo_path', 
                'image_path'=>'upload/admin_images/', 
                'message'=>'Admin Updated successfully', 
            ]);
            return redirect()->route('all.admins')->with($notification);
    }

     // Delete brand
     public function DeleteAdmin($id){
        $notification = $this->Delete('App\Models\Admin',$id,'profile_photo_path', 'Admin deleted successfully');
        return redirect()->back()->with($notification);
    }
}
