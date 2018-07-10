<?php

Route::get('/', 'StoreController@index');
Route::get('/pub/categories/{id}', 'StoreController@category')->name('store.category');
Route::get('/pub/search', 'StoreController@search')->name('store.search');
Route::get('/pub/books/{slug}', 'StoreController@showProduct')->name('store.show-product');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/checkout/{product}', 'StoreController@checkout')->name('store.checkout');
    Route::post('/process/{product}', 'StoreController@process')->name('store.process');
    Route::get('/orders', 'StoreController@orders')->name('store.orders');
});

