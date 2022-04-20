<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Traits\StoreTrait;
use App\Traits\UpdateTrait;
use App\Traits\DeleteTrait;
use App\Traits\ActivateTrait;
class SliderController extends Controller
{
    use StoreTrait;
    use UpdateTrait;
    use DeleteTrait;
    use ActivateTrait;
    //View all sliders
    public function SliderView(){
        $sliders = Slider::latest()->get();
        return view('backend.slider.slider_view', compact('sliders'));
    }

    // Store new slider
    public function SliderStore(Request $request){
        $inputs = array('title',"description");
        $request->validate([
    		'slider_img' => 'required',
    	]);
        // Store trait
        $res = $this->Store([
            'request'=> $request,
            'inputs'=>$inputs,
            'image_path'=>'upload/slider/',
            'new_image'=>'slider_img',
            "image_width" => 870,
            "image_height" => 370,
            'model'=>'App\Models\Slider',
        ]);
        return redirect()->back()->with($res['notification']);
    }

    // View Edit Slider page
    public function SliderEdite($id){
        $sliders = Slider::findOrFail($id);
        return view('backend.slider.slider_edit', compact('sliders'));
    }

    // Update Edited data
    public function SliderUpdate(Request $request){
        $inputs = array('title',"description"); // Dont include image input tage
        // Update trait
        $notification=$this->Update([
                'request'=> $request,
                'inputs'=>$inputs,
                'model'=>'App\Models\Slider',
                'new_image'=>'slider_img', 
                "image_width" => 870,
                "image_height" => 370,
                'image_path'=>'upload/slider/', 
                'message'=>'Slider Updated successfully',
            ]);
            return redirect()->route('all.sliders')->with($notification);
    }// end method

    // Delete Slider
    public function SliderDelete($id){
        $notification = $this->Delete('App\Models\Slider',$id,'slider_img', 'Slider deleted successfully');
        return redirect()->back()->with($notification);
    }

    public function SliderInactivate($id){
        $notification = $this->Inactivate('App\Models\Slider', $id, 'Slide Inactivated');
        return redirect()->back()->with($notification);
        
    } // end method 
    public function SliderActivate($id){
        $notification = $this->Activate('App\Models\Slider', $id, 'Slide Activated');
        return redirect()->back()->with($notification);
    } // end method 
}
