<?php

return [
//    'name' => 'CodeEduUser',
    'email' => [
        'user_created' => [
            'subject' => config('app.name') . ' - Sua Conta foi Criada com Sucesso'
        ]
    ],
    'middleware' => [
        'isVerified' => 'isVerified',
    ],
    'user_default' => [
        'name' => env('USER_NAME', 'Administrator'),
        'email' => env('USER_EMAIL', 'admin@user.com'),
        'password' => env('USER_PASSWORD', 'secret')
    ],
    'acl' => [
        'role_admin' => env('ROLE_ADMIN', 'Admin'),
        'controllers_annotations' => [
//            __DIR__ . '/../Http/Controllers',
            __DIR__ . './../Modules/CodeEduBook/Http/Controllers'
        ]
    ]
];
