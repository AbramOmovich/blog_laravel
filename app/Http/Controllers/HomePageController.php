<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
   public function index(){
      return view('text',['head' => 'Главная страниа', 'text' => ' Какой-то текст Какой-то текст']);
   }
}
