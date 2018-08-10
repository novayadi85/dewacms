<?php

Route::group(['middleware' => 'web', 'prefix' => 'blogpost', 'namespace' => 'Modules\Blogpost\Http\Controllers'], function()
{
    Route::get('/', 'BlogpostController@index');
});

#backend
Route::group(['prefix' => 'admin', 'middleware' => 'App\Http\Middleware\Admin' , 'namespace' => 'Modules\Blogpost\Http\Controllers\Admin'], function() {
	Route::get('articles', 'BlogpostController@index');
	Route::get('articles/index',
		['as'=> 'articles', 'uses'=>'BlogpostController@index']
	);
	Route::post('articles/terms', 'TermsController@index');
	Route::post('articles/remove', 'BlogpostController@remove');
	Route::post('articles/store', 'BlogpostController@store');
    Route::post('articles/api_v1', 'BlogpostController@api_v1');
    Route::get('articles/create',
        ['as'=> 'articles.create', 'uses'=>'BlogpostController@create']
	);
	Route::get('articles/show/{id}',
        ['as'=> 'articles.show', 'uses'=>'BlogpostController@show']
	);
});