<?php

return [
    'name' => 'CodeEduBook',
    'acl' => [
        'role_author' => env('ROLE_AUTHOR', 'Author'),
        'controllers_annotations' => [
            __DIR__.'/../Modules/CodeEduBook/Http/Controllers'
        ]
    ]
];
