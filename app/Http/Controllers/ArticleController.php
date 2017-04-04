<?php

namespace App\Http\Controllers;

use App\Article;
use App\User;
use Faker\Provider\cs_CZ\DateTime;
use Illuminate\Http\Request;
use DB;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
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
        if(Auth::check()) {
            return view('addArticle');
        }
        else{
            return redirect()->route('Home');
        }
    }

    private function article_validate(array $data){
        return \Validator::make($data,[
            'title' => 'required|min:3|max:200',
            'body' => 'required|min:3|',
            'slug' => 'unique:articles'

        ],self::$messages);
    }

    public function publish(Request $request){
        if (Auth::check()){
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
                $article->user_id = Auth::id();
                $article->save();
                if(isset($data['tags'])) {
                    $article->tags()->attach($data['tags']);
                }
                alert("Новость создана", "Нововсть {$article->title} успешно созданна");
                return redirect()->route('article',['slug' => $article->slug]);
            }
        }
        else{
            return redirect()->route('Home');
        }
    }

    /**
     * @param string $text
     * @param string $class - type of message (active, success, info, warning, danger)
     * @return array
     */

    public function getArticle($slug, Request $request){
        $this->middleware('article');

        $article = Article::where('slug',$slug)->get()->first();
        return view('editor',['article' => $article]);
    }

    public function putArticle($slug, Request $request){
        $this->middleware('article');
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
                if(!isset($data['tags'])){
                    $article->tags()->detach();
                }
                else{
                    $article->tags()->sync($data['tags']);
                }
                alert()->info("Новость изменена", "Новость {$article->title} успешно изменена");
                return redirect()->route('article',['slug' =>  $article->slug]);
            }
    }

    public function delete($slug){
        $this->middleware('article');
            $article = Article::where('slug',$slug)->first();

            alert()->warning("Новость удалена", "Новость {$article->title} удалена из блога");
            $article->delete();

            return redirect()->route('Home');
    }
}
