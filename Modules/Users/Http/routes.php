<?php
#frontend
Route::group(['middleware' => 'web', 'prefix' => 'users', 'namespace' => 'Modules\Users\Http\Controllers'], function()
{
    Route::get('/', 'UsersController@index');
});

/* Route::group(['middleware' => 'web', 'prefix' => 'backend/users', 'namespace' => 'Modules\Users\Http\Controllers'], function()
{
    Route::get('/', 'BackendUsersController@index');
    Route::get('/create', 'BackendUsersController@create');
    Route::get('/edit', 'BackendUsersController@edit');
    Route::get('/store', 'BackendUsersController@store');
    Route::get('/delete', 'BackendUsersController@delete');
}); */

#backend
Route::group(['prefix' => 'admin', 'middleware' => 'App\Http\Middleware\Admin' , 'namespace' => 'Modules\Users\Http\Controllers\Admin'], function() {
// Route::group(['prefix' => 'admin', 'middleware' => 'web' , 'namespace' => 'Modules\Users\Http\Controllers\Admin'], function() {
    Route::get('users', 'UsersController@index');
    Route::post('users/api_index', 'UsersController@api_index');
    
    Route::get('users/show/{id}', 'UsersController@show');
    Route::get('users/edit/{id}', 'UsersController@edit');
    Route::post('users/remove', 'UsersController@remove');
    Route::get('users/delete/{id}', 'UsersController@destroy');
    Route::get('users/create',[
		'as' =>'admin.users.create',
		'uses' =>'UsersController@create'
		]
	);
	Route::post('users/store',[
		'as' =>'admin.users.store',
		'uses' =>'UsersController@store'
	]);
	Route::put('users/update/{id}',[
		'as' =>'admin.users.update',
		'uses' =>'UsersController@update'
	]);
});


Route::post('users/store', array('before' => 'csrf', function()
{
   print "Here";
}));