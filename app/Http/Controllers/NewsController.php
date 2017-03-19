<?php

namespace App\Http\Controllers;
use App\Article;
use DB;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
class NewsController extends Controller
{
    public function index($message = '',$class = ''){
        $articles = Article::LatestArticles();
        if($message){
            return view('articles',['articles' => $articles,'message' => $message , 'class' => $class]);
        }
        else{
            return view('articles',['articles' => $articles]);
        }
    }
}