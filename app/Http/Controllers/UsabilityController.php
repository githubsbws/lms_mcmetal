<?php

namespace App\Http\Controllers;

use App\Models\Usability;
use Illuminate\Http\Request;

class UsabilityController extends Controller
{
    function usability_front(){
        $usability = Usability::where('active','y')->get();
        return view("usability_f.usability",['usa'=> $usability]);
    }

}
