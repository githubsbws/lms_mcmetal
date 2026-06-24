<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LibraryOnlineController extends Controller
{
    public function index()
    {
        return view('admin.library.library-online');
    }
}
