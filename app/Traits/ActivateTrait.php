<?php

namespace App\Traits;

Trait ActivateTrait{

    function Inactivate($model,$id, $message='Inactiveted Successfully'){
    	$model::findOrFail($id)->update(['status' => 0]);
    	$notification = array(
			'message' => $message,
			'alert-type' => 'info'
		);
		return $notification;
    } // end method 


    function Activate($model,$id, $message='Activated Successfully'){
    	$model::findOrFail($id)->update(['status' => 1]);
    	$notification = array(
			'message' => $message,
			'alert-type' => 'info'
		);
		return $notification;
    } // end method 
}