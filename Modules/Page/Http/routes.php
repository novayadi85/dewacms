<?php
Route::group(['middleware' => 'web', 'prefix' => 'page', 'namespace' => 'Modules\Page\Http\Controllers'], function()
{
    Route::get('/', 'PageController@index');
});


#backend
Route::group(['prefix' => 'admin', 'middleware' => 'App\Http\Middleware\Admin' , 'namespace' => 'Modules\Page\Http\Controllers\Admin'], function() {
	Route::get('pages', 'PageController@index');
	Route::get('pages/index',
		['as'=> 'pages', 'uses'=>'PageController@index']
	);
	
	Route::post('pages/remove', 'PageController@remove');
	Route::post('pages/store', 'PageController@store');
    Route::post('pages/api_v1', 'PageController@api_v1');
	Route::get('pages/create',
        ['as'=> 'pages.create', 'uses'=>'PageController@create']
	);
	Route::get('pages/show/{id}',
        ['as'=> 'pages.show', 'uses'=>'PageController@edit']
	);
});

Route::group(['domain' => '{subdomain}.'.Config::get('app.domain'), 'middleware'=>'\App\Http\Middleware\Domain', 'namespace' => 'Modules\Page\Http\Controllers'], function() {
	Route::get('/', 'PageController@index');
	Route::get('/search','PageController@search');
});