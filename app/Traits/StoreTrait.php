<?php
namespace App\Traits;
use Image;

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
            : false; // image input tag name
        $path = $attr_arr["image_path"];
        $message = isset($attr_arr["message"])
            ? $attr_arr["message"]
            : "Added successfully"; // Notification message
        $slugs = isset($attr_arr["slugs"]) ? $attr_arr["slugs"] : [];
        $inputs_required = isset($attr_arr["inputs_required"])
        ? $attr_arr["inputs_required"]
        : false;
        // Final Updated data
        $data = [];
        // validate inputs
        if ($inputs_required) {
            $required_inputs = [];
            foreach ($inputs as $item) {
                $required_inputs += [$item => "required"];
            }
            $request->validate($required_inputs);
        }
        // If there is an image file
        if ($request->file($new_image)) {
            $image = $request->file($new_image);
            $name_gen =
                hexdec(uniqid()) . "." . $image->getClientOriginalExtension();
            Image::make($image)
                ->resize(300, 300)
                ->save($path . $name_gen);
            $save_url = $path . $name_gen;
            $data += [$item => $save_url];
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
        $model::insert($data);
        // Add notifications
        $notification = [
            "message" => $message,
            "alert-type" => "success",
        ];
        return $notification;
    }
}
