<?php

namespace App\Http\Controllers;

use App\Article;
use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function getByTag($slug){
        Article::
            return view('articles',['articles' => $articles]);


    }

    public function addTag(){
        return view('tags.addTag');
    }

    public function storeTag(Request $request){
        $data = $request->all();
        $data['slug'] = str_slug($data['title']);

        $validator = \Validator::make($data,[
            'title' => 'required|min:3|max:200',
            'slug' => 'unique:tags']);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        else {
            $tag = new Tag();

            $tag->title = trim(strip_tags( $request->title));
            $tag->slug = $data['slug'];
            $tag->save();
            return view('tags.addTag', ['message' => $this->message('Тэг добавлен','success')]);
        }
    }

    private function message($text = '', $class = 'warning'){
        $message['text'] = $text;
        $message['class'] = 'alert-'.$class;
        return $message;
    }
}
