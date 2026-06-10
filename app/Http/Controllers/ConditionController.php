<?php

namespace App\Http\Controllers;

use App\Models\Conditions;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cache;

class ConditionController extends Controller
{
    function conditions(){
       
        $condition = Conditions::where('active','y')->get();
        return view('condition.condition',['condition' => $condition]);

    }
}
