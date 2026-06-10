<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Profiles;
class NewController extends Controller
{
    function new(Request $request){

        $news_desc = News::where('expired_date','>=',now())->orderBy('cms_id','DESC')->limit(6)->get();
         return view("news.News",['news_desc' => $news_desc]);
    }

    function new_detail($id){
        $news = News::findById($id);
        $profiles = Profiles::where('user_id',$news->update_by)->first();
        return view("news.News_detail",['news' =>$news,'profiles' =>$profiles]);
   }
}
