<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;


class HomePageController extends Controller
{

   public function index(){
       $articles = DB::table('articles');
       $articles = $articles->orderBy('created','desc')->get();

       return view('articles',['articles' => $articles]);

   }
}
