<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Seo;
use App\Traits\StoreTrait;
use App\Traits\UpdateTrait;
use App\Traits\DeleteTrait;
class SettingController extends Controller
{
    use StoreTrait;
    use UpdateTrait;
    use DeleteTrait;
    // View update setting page
    public function SiteSetting(){
        $setting = Setting::find(1);
        return view('backend.setting.update_setting', compact('setting'));
    }
    // Store updated data
    public function SiteSettingUpdate(Request $request){
        $inputs = array('phone_one','phone_two','email','company_name','company_address','facebook','twitter','linkedin','youtube');
        // Update trait
        $notification=$this->Update([
                'request'=> $request,
                'inputs'=>$inputs,
                'model'=>'App\Models\Setting',
                'new_image'=>'logo',
                'image_path'=>'upload/logo/', 
                "image_width" => 139,
                "image_height" => 36,
                'message'=>'Setting Updated successfully', 
            ]);
            return redirect()->back()->with($notification);
    }
    // View SEO update setting page  
    public function SEOSetting(){
        $seo = Seo::find(1);
        return view('backend.setting.update_Seo', compact('seo'));
    }
    // Store updated data
    public function SEOSettingUpdate(Request $request){
        $inputs = array('meta_title','meta_author','meta_keyword','meta_description','google_analytics');
        // Update trait
        $notification=$this->Update([
                'request'=> $request,
                'inputs'=>$inputs,
                'model'=>'App\Models\Seo',
                'message'=>'SEO Setting Updated successfully', 
            ]);
            return redirect()->back()->with($notification);
    }
}
