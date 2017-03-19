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

    private static $messages = [
        'title.required' => 'Не введен заголовок',
        'body.required'  => 'Не введен текст новости',
        'title.min' => 'Заголовок должен быть больше :min символов',
        'slug.unique' => 'Придумайте другой заголовок'
    ];

    public function index($slug){

        return view('article', ['article' => Article::where('slug',$slug)->get()->first()]);
    }

    public function add(){
        return view('addArticle');
    }

    private function article_validate(array $data){
        return \Validator::make($data,[
            'title' => 'required|min:3|max:200',
            'body' => 'required|min:3|',
            'slug' => 'unique:articles'

        ],self::$messages);
    }

    public function publish(Request $request){
        $data = $request->all();
        $data['slug'] = str_slug($data['title']);

        $validator = $this->article_validate($data);

        if($validator->fails()){
            return redirect()->route('add')->withErrors($validator)->withInput();
        }
        else {
            $article = new Article();

            $article->title = trim(strip_tags( $request->title));
            $article->body = $request->body;
            $article->slug = str_slug($article->title);
            $article->short_descr = str_limit($article->body);
            $article->save();
            return view('addArticle', ['message' => $this->message('Новость успешно добавлена','success')]);
        }
    }

    /**
     * @param string $text
     * @param string $class - type of message (active, success, info, warning, danger)
     * @return array
     */
    private function message($text = '', $class = 'warning'){
        $message['text'] = $text;
        $message['class'] = 'alert-'.$class;
        return $message;
    }



    public function getArticle($slug, Request $request){
        if($request->method() == 'POST'){
            $article = Article::where('slug',$slug)->get()->first();
            return view('editor',['article' => $article]);
        }
        else return view('editor');
    }

    public function putArticle($slug, Request $request){

        $article = Article::where('slug',$slug)->get()->first();

        $validator = \Validator::make($request->all(),[
            'title' => 'required|min:3|max:200',
            'body' => 'required|min:3|',],self::$messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        else{
            $data = $request->all();
            $data['slug'] = str_slug($data['title']);
            if($data['slug'] !== $article->slug){
                $validator = $this->article_validate($data);
            }

            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $article->title = $data['title'];
            $article->slug = $data['slug'];
            $article->body = $data['body'];
            $article->short_descr = str_limit($article->body);
            $article->save();
            return redirect()->route('article',['slug' =>  $article->slug]);
        }
    }

    public function delete($slug){
        Article::where('slug',$slug)->delete();
        $message = $this->message('Новость удалена');
        return redirect()->route('postHome',['message' => $message['text'], 'class' => $message['class']]);
    }
}
