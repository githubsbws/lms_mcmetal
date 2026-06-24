<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LibraryOnlineController extends Controller
{
    public function index()
    {
        return view('index.library.library-online');
    }
}
