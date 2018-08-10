<?php

Route::group(['middleware' => 'web', 'prefix' => 'metafields', 'namespace' => 'Modules\Metafields\Http\Controllers'], function()
{
    Route::get('/', 'MetafieldsController@index');
});

#backend
Route::group(['prefix' => 'admin', 'middleware' => 'App\Http\Middleware\Admin' , 'namespace' => 'Modules\Metafields\Http\Controllers\Admin'], function() {
	Route::get('metafields', 'MetafieldsController@index');
	Route::get('metafields/index',
		['as'=> 'metafields', 'uses'=>'MetafieldsController@index']
	);
	Route::post('metafields/remove', 'MetafieldsController@remove');
	Route::post('metafields/store', 'MetafieldsController@store');
    Route::post('metafields/api_v1', 'MetafieldsController@api_v1');
	Route::get('metafields/create',
        ['as'=> 'metafields.create', 'uses'=>'MetafieldsController@create']
	);
	Route::get('metafields/show/{id}',
        ['as'=> 'metafields.show', 'uses'=>'MetafieldsController@show']
	);
});