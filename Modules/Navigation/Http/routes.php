<?php

Route::group(['middleware' => 'web', 'prefix' => 'navigation', 'namespace' => 'Modules\Navigation\Http\Controllers'], function()
{
    Route::get('/', 'NavigationController@index');
});

#backend
Route::group(['prefix' => 'admin', 'middleware' => 'App\Http\Middleware\Admin' , 'namespace' => 'Modules\Navigation\Http\Controllers\Admin'], function() {
	Route::get('menu', 'NavigationController@index');
    Route::post('menu/api_v1', 'NavigationController@api_v1');
	
	Route::get('menu/create',
        ['as'=> 'menu.create', 'uses'=>'NavigationController@create']
	);
	Route::get('menu/show/{id}',
        ['as'=> 'menu.show', 'uses'=>'NavigationController@show']
	);
	
	Route::post('menu/store',[
		'as' =>'menu.store',
		'uses' =>'NavigationController@store'
	]);
	
	Route::post('menu/reload',[
		'as' =>'menu.store',
		'uses' =>'NavigationController@reload'
	]);
	
});

