<?php

namespace App\Http\Controllers;

use App\article;
use DB;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;


class HomePageController extends Controller
{

   public function index(){

       $articles = article::LatestArticles();

       return view('articles',['articles' => $articles]);

   }
}
