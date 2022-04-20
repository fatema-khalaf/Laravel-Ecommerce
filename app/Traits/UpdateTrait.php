<?php
namespace App\Traits;
use Image;

trait UpdateTrait
{
    function Update($attr_arr)
    {
        $request = $attr_arr["request"];
        $model = $attr_arr["model"];
        $inputs = $attr_arr["inputs"]; // Note: inputs must not contain image input tag name
        $path = isset($attr_arr["image_path"])
            ? $attr_arr["image_path"]
            : false;
        $new_image = isset($attr_arr["new_image"])
            ? $attr_arr["new_image"]
            : false; // new image input tag name
        $image_width = isset($attr_arr["image_width"])
        ? $attr_arr["image_width"]
        : 300; // resize image width
        $image_height = isset($attr_arr["image_height"])
        ? $attr_arr["image_height"]
        : 300; // resize image height
        $message = isset($attr_arr["message"])
            ? $attr_arr["message"]
            : "Updated successfully"; // Notification message
        $slugs = isset($attr_arr["slugs"]) ? $attr_arr["slugs"] : [];
        $inputs_required = isset($attr_arr["inputs_required"])
            ? $attr_arr["inputs_required"]
            : false;
        // For validation
        if ($inputs_required) {
            $required_inputs = [];
            foreach ($inputs as $item) {
                $required_inputs += [$item => "required"];
            }
            $request->validate($required_inputs);
        }

        $data = []; // Final Updated data
        $id = $request->id;
        $old_img = $request->old_image; // Note: image input name must be old_image
        // If there is an image file
        if ($request->file($new_image)) {
            unlink($old_img);
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
        // Update
        $model::findOrfail($id)->update($data);
        // Add notification
        $notification = [
            "message" => $message,
            "alert-type" => "success",
        ];
        return $notification;
    }
}
