<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cache;

class AboutController extends Controller
{
    function about(){
        $about = About::where('active','y')->get();
        return view('about.about',['about' => $about]);

    }
}
