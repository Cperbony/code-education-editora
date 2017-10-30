<?php

Route::group(['middleware' => 'auth'], function () {
    Route::resource('categories', 'CategoriesController', ['except' => 'show']);
    Route::resource('books', 'BooksController', ['except' => 'show']);

    Route::group(['prefix' => 'trashed', 'as' => 'trashed.'], function () {
        Route::resource('books', 'BooksTrashedController', [
            'except' => ['create', 'store', 'edit', 'destroy']
        ]);
    });

});

