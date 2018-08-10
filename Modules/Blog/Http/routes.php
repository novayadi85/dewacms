<?php

Route::group(['middleware' => 'web', 'prefix' => 'blog', 'namespace' => 'Modules\Blog\Http\Controllers'], function()
{
    Route::get('/', 'BlogController@index');
    Route::get('/create', 'BlogController@create');
});

Route::group(['middleware' => 'web', 'prefix' => 'backend/blog', 'namespace' => 'Modules\Blog\Http\Controllers'], function()
{
	Route::get('/list', 'BlogController@list');
    Route::get('/create', 'BlogController@create');
});


Route::group(['prefix' => \App\Http\Middleware\Language::setLanguage(),'namespace' => 'Modules\Blog\Http\Controllers'], function() {
	Route::get('blog', 'BlogController@index');
	Route::get('/blog/detail/{slug}', 'BlogController@index');
});
