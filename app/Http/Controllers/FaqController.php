<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Faq;
use App\Models\Faq_type;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class FaqController extends Controller
{
    function faq_front(Request $request){

         $faq_type = Faq_type::join('cms_faq','cms_faq_type.faq_type_id','=','cms_faq.faq_type_id')->where('cms_faq_type.active','y')->where('cms_faq.active','y')->get();

        return view('faq_front.Faq',['faq_type' => $faq_type]);
    }
}
