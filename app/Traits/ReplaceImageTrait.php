<?php

namespace App\Traits;

Trait replaceImageTrait{
    function replaceImage($oldFile, $newfile,  $path){
        @unlink(public_path($path.'/'.$oldFile));
        $filename = date('YmdHi').$newfile->getClientOriginalName();
        $newfile->move(public_path($path),$filename);
        return $filename;
    }
}