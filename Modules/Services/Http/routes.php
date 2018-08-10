<?php
Route::group(['middleware' => 'web', 'prefix' => 'service', 'namespace' => 'Modules\Services\Http\Controllers'], function()
{
    Route::get('/', 'ServicesController@index');
});


#backend
Route::group(['prefix' => 'admin', 'middleware' => 'App\Http\Middleware\Admin' , 'namespace' => 'Modules\Services\Http\Controllers\Admin'], function() {
	Route::get('services', 'ServicesController@index');
	Route::get('services/index',
		['as'=> 'services', 'uses'=>'ServicesController@index']
	);
	
	Route::post('services/remove', 'ServicesController@remove');
	Route::post('services/store', 'ServicesController@store');
    Route::post('services/api_v1', 'ServicesController@api_v1');
	Route::get('services/create',
        ['as'=> 'services.create', 'uses'=>'ServicesController@create']
	);
	Route::get('services/show/{id}',
        ['as'=> 'services.show', 'uses'=>'ServicesController@edit']
	);
	Route::any('services/uploadFiles', 'ServicesController@uploadFiles');
});

Route::group(['domain' => '{subdomain}.'.Config::get('app.domain'), 'middleware'=>'\App\Http\Middleware\Domain', 'namespace' => 'Modules\Services\Http\Controllers'], function() {
	//Route::get('/', 'ServicesController@index');
	Route::get('/services','ServicesController@search');
});