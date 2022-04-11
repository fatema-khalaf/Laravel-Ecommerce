<?php

namespace App\Traits;
use Auth;
use Illuminate\Support\Facades\Hash;

Trait ChangePasswordTrait{
    function ValidateChangePassword($request, $user){
        $validateData = $request->validate([ 
            'oldPassword' => 'required',
            'password'=> 'required|confirmed'
         ]);
         $hashedPassword = Auth::user()->password;
         if(Hash::check($request->oldPassword, $hashedPassword)){ // Hash::check laravel build in method
             $user->password = Hash::make($request->password);
             $user->save();
             Auth::logout();
             return true;
         } else{
             return false;
         }
    }
}