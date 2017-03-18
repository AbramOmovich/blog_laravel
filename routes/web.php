<?php

Route::get('/', 'HomePageController@index')->name('Home');
Route::get('/{message}-{class}','HomePageController@index')->name('postHome');


Route::group(['prefix' => 'admin'], function($r){
    $r->get('user', function(){return 'users';});
    $r->get('dashboard', function(){return 'dashboard';});
    $r->get('money-history', function(){return 'money-history';});
});

Route::group(['prefix' => 'article'],function($route){
    $route->group(['prefix' => '{slug}'],function($slugRoute){
        $slugRoute->get('/','ArticleController@index')->name('article');
        $slugRoute->post('edit', 'ArticleController@edit');
        $slugRoute->post('delete', 'ArticleController@delete');
    });



});

Route::group(['prefix' => 'add'], function($route){
    $route->get('/','ArticleController@add');
    $route->post('/','ArticleController@publish');
});