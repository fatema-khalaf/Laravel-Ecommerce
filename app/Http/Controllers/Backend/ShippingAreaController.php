<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShipDivision;
use App\Models\ShipDistrict;
use App\Models\ShipState;
use App\Traits\StoreTrait;
use App\Traits\UpdateTrait;
use App\Traits\DeleteTrait;

class ShippingAreaController extends Controller
{
    use StoreTrait;
    use UpdateTrait;
    use DeleteTrait;

    // View division 
    public function DivisionView(){
        $divisions = ShipDivision::orderBy('id','DESC')->get();
        return view('backend.shipping.division.division_view', compact('divisions'));
    }
   
    // Add new division
    public function DivisionStore(Request $request){
        $inputs = array('division_name');
        // Store trait
        $res = $this->Store([
            'request'=> $request,
            'inputs'=>$inputs,
            'model'=>'App\Models\ShipDivision',
            'inputs_required'=> true
        ]);
        return redirect()->back()->with($res['notification']);
    }
    // View Edit page
    public function DivisionEdit($id){
        $division = ShipDivision::findOrFail($id);
        return view('backend.shipping.division.division_edit', compact('division'));
    }

     // Update Edited data
     public function DivisionUpdate(Request $request){
        $inputs = array('division_name');
        // Update trait
        $notification=$this->Update([
                'request'=> $request,
                'inputs'=>$inputs,
                'model'=>'App\Models\ShipDivision',
            ]);
        return redirect()->route('all.divisions')->with($notification);
    }// end method

    // Delete division
    public function DivisionDelete($id){
        $notification = $this->Delete('App\Models\ShipDivision',$id,false ,'Division deleted successfully');
        return redirect()->back()->with($notification);
    }

    // ================================ shipping districts ==================================
    // View district 
    public function DistrictView(){
        $divisions = ShipDivision::orderBy('division_name','ASC')->get();
        $districts = ShipDistrict::with('division')->orderBy('id','DESC')->get();
        return view('backend.shipping.district.district_view', compact('districts','divisions'));
    }
    // Add new district
    public function DistrictStore(Request $request){
        $inputs = array('district_name','division_id');
        // Store trait
        $res = $this->Store([
            'request'=> $request,
            'inputs'=>$inputs,
            'model'=>'App\Models\ShipDistrict',
            'inputs_required'=> true
        ]);
        return redirect()->back()->with($res['notification']);
    }
    // View Edit page
    public function DistrictEdit($id){
        $divisions = ShipDivision::orderBy('division_name','ASC')->get();
        $district = ShipDistrict::findOrFail($id);
        return view('backend.shipping.district.district_edit', compact('district','divisions'));
    }

    // Update Edited data
    public function DistrictUpdate(Request $request){
        $inputs = array('district_name','division_id');
        // Update trait
        $notification=$this->Update([
                'request'=> $request,
                'inputs'=>$inputs,
                'model'=>'App\Models\ShipDistrict',
            ]);
        return redirect()->route('all.districts')->with($notification);
    }// end method

    // Delete division
    public function DistrictDelete($id){
        $notification = $this->Delete('App\Models\ShipDistrict',$id,false ,'District deleted successfully');
        return redirect()->back()->with($notification);
    }
    // ================================ shipping states ==================================
    // View state
    public function StateView(){
        $divisions = ShipDivision::orderBy('division_name','ASC')->get();
        $districts = ShipDistrict::orderBy('district_name','ASC')->get();
        $states = ShipState::with('division','district')->orderBy('id','DESC')->get();
        return view('backend.shipping.state.state_view', compact('districts','divisions','states'));
    }
    // Add new district
    public function StateStore(Request $request){
        $inputs = array('district_id','division_id','state_name');
        // Store trait
        $res = $this->Store([
            'request'=> $request,
            'inputs'=>$inputs,
            'model'=>'App\Models\ShipState',
            'inputs_required'=> true
        ]);
        return redirect()->back()->with($res['notification']);
    }
    // View Edit page
    public function StateEdit($id){
        $divisions = ShipDivision::orderBy('division_name','ASC')->get();
        $districts = ShipDistrict::orderBy('district_name','ASC')->get();
        $state = ShipState::findOrFail($id);
        return view('backend.shipping.state.state_edit', compact('districts','divisions','state'));
    }

    // Update Edited data
    public function StateUpdate(Request $request){
        $inputs = array('district_id','division_id','state_name');
        // Update trait
        $notification=$this->Update([
                'request'=> $request,
                'inputs'=>$inputs,
                'model'=>'App\Models\ShipState',
            ]);
        return redirect()->route('all.states')->with($notification);
    }// end method

    // Delete division
    public function StateDelete($id){
        $notification = $this->Delete('App\Models\ShipState',$id,false ,'State deleted successfully');
        return redirect()->back()->with($notification);
    }

}
