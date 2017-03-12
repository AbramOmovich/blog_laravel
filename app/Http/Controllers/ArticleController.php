<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ArticleController extends Controller
{

    public function index($slug){
        $db = DB::table('articles');

        return view('article', ['article' => $db->select()->where('slug',$slug)->get()->first()]);
    }
}
