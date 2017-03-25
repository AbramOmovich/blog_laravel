<?php

namespace App\Http\Controllers;

use App\Article;
use App\Tag;
use Auth;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function getByTag($slug){
        $tag = Tag::where('slug',$slug)->get()->first();

       return view('articles', [
           'articles' => $tag->articlesByTag()->orderBy('created_at','desc')->paginate(10),
           'tag' => $tag->title
       ]);
    }

    public function addTag(){
        if(Auth::check()) {
            return view('tags.addTag');
        }
        else{
            return redirect()->route('Home');
        }
    }

    public function storeTag(Request $request){
        if(Auth::check()) {
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
        else{
            return redirect()->route('Home');
        }
    }

    private function message($text = '', $class = 'warning'){
        $message['text'] = $text;
        $message['class'] = 'alert-'.$class;
        return $message;
    }
}
