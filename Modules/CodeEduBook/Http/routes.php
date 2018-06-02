<?php

if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
}

Route::group(['middleware' => [
    'auth',
    config('codeeduuser.middleware.isVerified'), 'auth.resource']], function () {
        Route::resource('categories', 'CategoriesController', ['except' => 'show']);

        Route::group(['prefix' => 'books/{books}'], function () {
            Route::resource('chapters', 'ChaptersController', ['except' => 'show']);
        });

        Route::resource('books', 'BooksController', ['except' => 'show']);

        Route::group(['prefix' => 'trashed', 'as' => 'trashed.'], function () {
            Route::resource('books', 'BooksTrashedController', [
                'except' => ['create', 'store', 'edit', 'destroy']
            ]);
        });
    });

