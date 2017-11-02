<?php

return [
    'name' => 'CodeEduUser',
    'email' => [
        'user_created' => [
            'subject' => config('app.name') . ' - Sua Conta foi Criada com Sucesso'
        ]
    ],
    'middleware' => [
        'isVerified' => 'isVerified',
    ]
];
