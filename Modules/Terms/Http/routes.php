<?php

Route::group(['middleware' => 'web', 'prefix' => 'terms', 'namespace' => 'Modules\Terms\Http\Controllers'], function()
{
    Route::get('/', 'TermsController@index');
});

#backend
Route::group(['prefix' => 'admin', 'middleware' => 'App\Http\Middleware\Admin' , 'namespace' => 'Modules\Terms\Http\Controllers\Admin'], function() {
	Route::get('terms', 'TermsController@index');
	Route::get('terms/index',
		['as'=> 'terms', 'uses'=>'TermsController@index']
	);
	Route::post('terms/remove', 'TermsController@remove');
	Route::post('terms/store', 'TermsController@store');
    Route::post('terms/api_v1', 'TermsController@api_v1');
	Route::get('terms/create',
        ['as'=> 'terms.create', 'uses'=>'TermsController@create']
	);
	Route::get('terms/show/{id}',
        ['as'=> 'terms.show', 'uses'=>'TermsController@show']
	);
});

#Frontend
Route::group(['domain' => '{subdomain}.'.Config::get('app.domain'), 'middleware'=>'\App\Http\Middleware\Domain', 'namespace' => 'Modules\Terms\Http\Controllers'], function() {
	Route::get('category','TermsController@index');
	/*Route::get('category/{slug}',
        ['as'=> 'terms.show', 'uses'=>'TermsController@show']
	); */
	
	Route::any('category/{type}/{slug}', function ($type, $slug) {
		return App::call('Modules\Terms\Http\Controllers\TermsController@show' , ['slug' => $slug , "type" => $type]);
	});
});