<?php
Route::group(['middleware' => 'web', 'prefix' => 'backend', 'namespace' => 'Modules\Backend\Http\Controllers'], function()
{
    Route::get('/', 'BackendController@index');
    Route::get('/login', 'BackendController@login');
});

Route::group(['prefix' => 'admin', 'middleware' => 'App\Http\Middleware\Admin' , 'namespace' => 'Modules\Backend\Http\Controllers'], function() {
	Route::get('dashboard', 'BackendController@index');
    Route::get('/', 'BackendController@index');
    Route::get('/logout', 'BackendController@logout');
    Route::post('/auth', 'BackendController@auth');
});

