<?php

Route::get('/', 'NewsController@index')->name('Home');
Route::get('/{message}-{class}','NewsController@index')->name('postHome');


Route::group(['prefix' => 'admin'], function($r){
    $r->get('user', function(){return 'users';});
    $r->get('dashboard', function(){return 'dashboard';});
    $r->get('money-history', function(){return 'money-history';});
});

Route::group(['prefix' => 'article'],function($route){
    $route->group(['prefix' => 'add'], function($route){
        $route->get('/','ArticleController@add')->name('add');
        $route->post('/','ArticleController@publish');
    });
    $route->group(['prefix' => '{slug}'],function($slugRoute){
        $slugRoute->get('/','ArticleController@index')->name('article');
        $slugRoute->post('edit', 'ArticleController@getArticle');
        $slugRoute->get('edit', 'ArticleController@getArticle');
        $slugRoute->put('edit', 'ArticleController@putArticle');
        $slugRoute->post('delete', 'ArticleController@delete');
    });
});
Auth::routes();


Route::get('/home', 'HomeController@index');
