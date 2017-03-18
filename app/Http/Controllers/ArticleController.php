<?php

namespace App\Http\Controllers;

use App\Article;
use Faker\Provider\cs_CZ\DateTime;
use Illuminate\Http\Request;
use DB;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Redirect;
use Route;


class ArticleController extends Controller
{

    public function index($slug){

        return view('article', ['article' => Article::where('slug',$slug)->get()->first()]);
    }

    public function add(){
        return view('addArticle');
    }

    public function publish(Request $request){

       $validator = \Validator::make($request->all(),[
          'title' => 'required|min:3|max:200',
           'body' => 'required|min:3|',

       ]);

        $article = new Article();

        $article->title = trim(strip_tags( $request->title));
        $article->body = $request->body;
        $article->slug = str_slug($article->title);
        $article->short_descr = str_limit($article->body);

        $validator->validate($article,[
            'slug' => 'unique:articles,slug'
        ]);

        if($validator->fails()){
            dump($validator->errors()->all());
        }

        else {
            $article->save();
            return view('addArticle', ['message' => $this->message('Новость успешно добавлена','success')]);
        }

        /*if(!$request->has('title') && !$request->has('body'))return Redirect::back();

        $article = new Article();

        $article->title = trim(strip_tags( $request->title));
        $article->body = $request->body;
        $article->slug = str_slug($article->title);
        $article->short_descr = str_limit($article->body);



        return view('addArticle', ['message' => $this->message('Новость успешно добавлена','success')]);*/
    }

    /**
     * @param string $text
     * @param string $class - type of message
     *          active	Applies the hover color to a particular row or cell
                success	Indicates a successful or positive action
                info	Indicates a neutral informative change or action
                warning	Indicates a warning that might need attention
                danger Indicates a dangerous or potentially negative action
     *
     * @return array
     */
    private function message($text = '', $class = 'warning'){
        $message['text'] = $text;
        $message['class'] = 'alert-'.$class;
        return $message;
    }

    public function edit($slug, Request $request){

        $article = Article::where('slug',$slug)->get()->first();

        if($request->has('set')){
            
            $article->title = $request->title;
            $slug = $article->slug = str_slug($article->title);
            $article->body = $request->body;
            $article->short_descr = str_limit($article->body);
            $article->save();
            return redirect()->route('article',['slug' => $slug]);
        }

        return view('addArticle',['title' => $article->title, 'body' => $article->body]);
    }

    public function delete($slug){
        Article::where('slug',$slug)->delete();
        $message = $this->message('Новость удалена');
        return redirect()->route('postHome',['message' => $message['text'], 'class' => $message['class']]);
    }
}
