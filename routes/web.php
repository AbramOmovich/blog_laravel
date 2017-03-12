<?php

Route::get('/', 'HomePageController@index')->name('Home');


Route::get('hello-{user}-{age}',function ($user,$age)
{
    return 'Hello '. ucfirst($user). ' of age ' . $age;}
)->where([
    'user' => '\w{2,7}',
    'age' => '\d{2,3}'

]);

Route::group(['prefix' => 'admin'], function($r){
    $r->get('user', function(){return 'users';});
    $r->get('dashboard', function(){return 'dashboard';});
    $r->get('money-history', function(){return 'money-history';});
});

Route::get('article/{slug}','ArticleController@index');