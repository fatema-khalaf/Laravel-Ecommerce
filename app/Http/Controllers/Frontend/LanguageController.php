<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    // new Idea work with session vedio 201
    public function English(){
        session()->get('language');
        session()->forget('language');
        Session::put('language', 'english');
        return redirect()->back();
    }
    public function Arabic(){
        session()->get('language');
        session()->forget('language');
        Session::put('language', 'arabic');
        return redirect()->back();

    }
}
