<?php

Route::get('/', 'NewsController@index')->name('Home');
Route::get('/{message}-{class}','NewsController@index')->name('postHome');

Route::group(['prefix' => 'tag'], function ($route){
    $route->get('add','TagController@AddTag');
    $route->post('add','TagController@storeTag');
    $route->get('{tag}','TagController@getByTag');
});

Route::match(['get','head'],'login','Auth\LoginController@showLoginForm')->name('login');
Route::post('login','Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::post('password/email','Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::match(['get','head'],'password/reset','Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/reset','Auth\ResetPasswordController@reset')->name('password.email');
Route::match(['get','head'],'password/reset/{token}','Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::get('register','Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register','Auth\RegisterController@register');


Route::group(['prefix' => 'article'],function($route){
    $route->group(['prefix' => 'add'], function($route){
        $route->get('/','ArticleController@add')->name('add');
        $route->post('/','ArticleController@publish');
    });
    $route->group(['prefix' => '{slug}'],function($slugRoute){
        $slugRoute->get('/','ArticleController@index')->name('article');
        $slugRoute->post('edit', 'ArticleController@getArticle');
        $slugRoute->put('edit', 'ArticleController@putArticle');
        $slugRoute->post('delete', 'ArticleController@delete');
    });
});