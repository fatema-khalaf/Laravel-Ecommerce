<?php
namespace App\Traits;
use Image;

Trait StoreTrait{
    // request , image path, model ,inputs fild names , slugs names and referances, boolean validation needed
    function Store($my_arry){ 
    $request= $my_arry['request'];
    $model= $my_arry['model'];
    $inputs= $my_arry['inputs'];
    $path= $my_arry['image_path'];
    $slugs= isset($my_arry['slugs'])? $my_arry['slugs']:[];
    $inputs_required= isset($my_arry['inputs_required'])? $my_arry['inputs_required']: false ;    
        if($inputs_required){
            $required_inputs=[];
            foreach($inputs as $item){
                $required_inputs += [$item =>'required'];
            }
            $request->validate($required_inputs);
        }
                
        $image = $request-> file('brand_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(300,300)->save($path.$name_gen);
        $save_url = $path.$name_gen;
        $data=[];
        foreach ($inputs as $item){
            if(str_contains($item, 'image')){
                $data+=[$item=>$save_url];
            }else{
                $data+=[$item=>$request[$item]];
            }
        } 
        foreach($slugs as $key=>$val){
            $slg = strtolower(str_replace(' ','-',$request->$val));
            $data+=[$key=>$slg];
        }
        // insert
        $model::insert($data);
        return null;
    }

    // Add success Notification
    function AddedNotification( $name){
        $notification = array(
            'message'=>$name.' added successfully',
            'alert-type' => 'success'
        );
        return $notification;
    }

    // Update success Notification
    function UpdatedNotification($name){
        $notification = array(
            'message'=>$name.' updated successfully',
            'alert-type' => 'success'
        );
        return $notification;
    }
}