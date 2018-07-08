<?php

return [
    'name' => 'CodeEduBook',
    'acl' => [
        'role_author' => env('ROLE_AUTHOR', 'Author'),
        'permissions' => [
            'book_manage_all' => 'book-admin/manage_all'
        ]
    ],
    'book_storage' => env('BOOK_STORAGE_DISK', 'book_local'),
    'book_thumbs' => 'storage/books/thumbs'
];
