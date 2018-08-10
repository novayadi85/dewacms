<?php

Route::group(['middleware' => 'web', 'prefix' => 'product', 'namespace' => 'Modules\Product\Http\Controllers'], function()
{
    Route::get('/', 'ProductController@index');
});

#backend
Route::group(['prefix' => 'admin', 'middleware' => 'App\Http\Middleware\Admin' , 'namespace' => 'Modules\Product\Http\Controllers\Admin'], function() {
	Route::get('product', 'ProductController@index');
	Route::get('product/index',
		['as'=> 'product', 'uses'=>'ProductController@index']
	);
	Route::post('product/remove', 'ProductController@remove');
	Route::post('product/store', 'ProductController@store');
	Route::post('product/upload', 'ProductController@upload');
	Route::post('product/gallery', 'ProductController@gallery');
    Route::post('product/api_v1', 'ProductController@api_v1');
	Route::post('product/load', 'ProductController@load');
	Route::post('product/get_post', 'ProductController@get_post');
	Route::any('product/uploadFiles', 'ProductController@uploadFiles');
	
	Route::get('product/create',
        ['as'=> 'product.create', 'uses'=>'ProductController@create']
	);
	Route::get('product/show/{slug}',
        ['as'=> 'product.show', 'uses'=>'ProductController@show']
	);

	Route::post('product/terms', 'TermsController@index');
});

Route::group(['domain' => '{subdomain}.'.Config::get('app.domain'), 'middleware'=>'\App\Http\Middleware\Domain', 'namespace' => 'Modules\Product\Http\Controllers'], function() {
	//Route::get('/product/{id}','ProductController@show');
	Route::any('product/{slug}', function ($slug) {
		return App::call('Modules\Product\Http\Controllers\ProductController@show' , ['slug' => $slug]);
	});

});