<?php
namespace App\Traits;
use Image;
use Carbon\Carbon;

trait StoreTrait
{
    // request , image path, model ,inputs fild names , slugs names and referances, boolean validation needed
    function Store($attr_arr)
    {
        // Function attributes
        $request = $attr_arr["request"];
        $model = $attr_arr["model"];
        $inputs = $attr_arr["inputs"]; // Note: inputs must not contain image input tag name
        $new_image = isset($attr_arr["new_image"])
            ? $attr_arr["new_image"]
            : null; // image input tag name
        $image_width = isset($attr_arr["image_width"])
        ? $attr_arr["image_width"]
        : 300; // resize image width
        $image_height = isset($attr_arr["image_height"])
        ? $attr_arr["image_height"]
        : 300; // resize image height
        $path =isset($attr_arr["image_path"])? $attr_arr["image_path"] : null;
        $message = isset($attr_arr["message"])
            ? $attr_arr["message"]
            : "Added successfully"; // Notification message
        $slugs = isset($attr_arr["slugs"]) ? $attr_arr["slugs"] : [];
        $inputs_required = isset($attr_arr["inputs_required"])
        ? $attr_arr["inputs_required"]
        : false;
        // Final Updated data
        $data = ['created_at' => Carbon::now(),];
        
        // validate inputs
        if ($inputs_required) {
            $required_inputs = [];
            foreach ($inputs as $item) {
                $required_inputs += [$item => "required"];
            }
            if($new_image){
                $required_inputs += [$new_image => "required"];
            }
            $request->validate($required_inputs);
        }
        // If there is an image file
        // dd($request);
        if ($request->file($new_image)) {
            $image = $request->file($new_image);
            $name_gen =
                hexdec(uniqid()) . "." . $image->getClientOriginalExtension();
            Image::make($image)
                ->resize($image_width, $image_height)
                ->save($path . $name_gen);
            $save_url = $path . $name_gen;
            $data += [$new_image => $save_url];
        }
        // Add inputs data
        foreach ($inputs as $item) {
            $data += [$item => $request[$item]];
        }
        // Add slugs
        foreach ($slugs as $key => $val) {
            $slg = strtolower(str_replace(" ", "-", $request->$val));
            $data += [$key => $slg];
        }
        // Insert
        $id = $model::insertGetId($data);
        // Add notifications
        $notification = [
            "message" => $message,
            "alert-type" => "success",
        ];
        return ['notification' =>$notification,'id' => $id];
    }
}
