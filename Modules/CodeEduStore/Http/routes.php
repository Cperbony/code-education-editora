<?php

Route::group(['middleware' => 'web', 'prefix' => 'codeedustore', 'namespace' => '\CodeEduStore\Http\Controllers'], function()
{
    Route::get('/', 'CodeEduStoreController@index');
});
