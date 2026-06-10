<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BBii_forum;

class WebboardController extends Controller
{
    function webboard(){
        $web = BBii_forum::get();
        return view("webboard.webboard",['web'=>$web]);
    }
}
