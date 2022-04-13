<?php
namespace App\Traits;

Trait DeleteTrait{
   function Delete($model, $id, $image= false ,$message = 'Deleted successfully'){
    $item = $model::findOrFail($id);
    if($image){
        $item_image= $item->$image;
        unlink($item_image);
    }
    $model::findOrFail($id)->delete();
    $notification = array(
        'message'=>$message,
        'alert-type' => 'success'
    );
    return $notification;
    }
}