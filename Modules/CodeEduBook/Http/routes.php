<?php

if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
}

Route::group(['middleware' => [
    'auth',
    config('codeeduuser.middleware.isVerified'), 'auth.resource']], function () {
    Route::resource('categories', 'CategoriesController', ['except' => 'show']);

    Route::group(['prefix' => 'books/{book}'], function () {
        Route::get('cover', 'BooksController@coverForm')
            ->name('books.cover.create');

        Route::post('cover', 'BooksController@coverStore')
            ->name('books.cover.store');

        Route::post('export', 'BooksController@export')
            ->name('books.export');

        Route::get('download', 'BooksController@download')
            ->name('books.download');

        Route::resource('chapters', 'ChaptersController', ['except' => 'show']);
    });

    Route::resource('books', 'BooksController', ['except' => 'show']);

    Route::group(['prefix' => 'trashed', 'as' => 'trashed.'], function () {
        Route::resource('books', 'BooksTrashedController', [
            'except' => ['create', 'store', 'edit', 'destroy']
        ]);
    });
});

