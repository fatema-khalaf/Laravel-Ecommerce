<?php
namespace App\Traits;
use Image;

Trait StoreTrait{
    // request , image path, model ,inputs fild names , slugs names and referances, boolean validation needed
    function Store($attr_arr){ 
    $request= $attr_arr['request'];
    $model= $attr_arr['model'];
    $inputs= $attr_arr['inputs'];
    $path= $attr_arr['image_path'];
    $message=isset($attr_arr['message'])?$attr_arr['message']:'Added successfully'; // Notification message
    $slugs= isset($attr_arr['slugs'])? $attr_arr['slugs']:[];
    $inputs_required= isset($attr_arr['inputs_required'])? $attr_arr['inputs_required']: false ;    
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
        $notification = array(
            'message'=>$message,
            'alert-type' => 'success'
        );
        return $notification;
    }
}