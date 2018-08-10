<?php

Route::group(['middleware' => 'web', 'prefix' => 'bookings', 'namespace' => 'Modules\Bookings\Http\Controllers'], function()
{
    Route::get('/', 'BookingsController@index');
    Route::post('/submit', 'BookingsController@submit');
});
