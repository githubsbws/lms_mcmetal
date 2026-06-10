<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Zoom;

class VirtualclassroomController extends Controller
{
    function virtualclassroom(){
        $zoom = Zoom::where('active','y')->get();

        return view("virtualclassroom.svirtualclassroom",['zoom'=>$zoom]);
    }
}
