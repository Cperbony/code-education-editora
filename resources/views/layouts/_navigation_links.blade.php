<?php
$navbar = Navbar::withBrand(config('app.name'), url('/'))->inverse();
if (Auth::check()) {
    $arrayLinks = [
        [
            'link' => route('categories.index'),
            'title' => 'Categorias'
        ],
        [
            'Books',
            [
                [
                    'link' => route('books.index'),
                    'title' => 'Listar'
                ],
                [
                    'link' => route('trashed.books.index'),
                    'title' => 'Lixeira'
                ]
            ]
        ],
//        [
//            'Usuários',
//            [
//                [
//                    'link' => route('codeeduuser.users.index'),
//                    'title' => 'Usuários'
//                ],
//                [
//                    'link' => route('codeeduuser.roles.index'),
//                    'title' => 'Papel de usuário'
//                ],
//            ]
//        ]
    ];
    if (Auth::user()->can('users-admin/list')) {
        $arrayLinks [] = [
            'Usuários',
            [
                [
                    'link' => route('codeeduuser.users.index'),
                    'title' => 'Usuários'
                ],
                [
                    'link' => route('codeeduuser.roles.index'),
                    'title' => 'Papel de Usuário'
                ],
            ]
        ];
    }
    $links = Navigation::links($arrayLinks);
    $logout = Navigation::links([
        [
            Auth::user()->name,
            [
                [
                    'link' => url('/logout'),
                    'title' => 'Logout',
                    'linkAttributes' => [
                        'onClick' => "event.preventDefault();
                                   document.getElementById(\"logout-form\").submit();"
                    ]
                ]
            ]
        ]
    ])->right();
    $navbar->withContent($links)
        ->withContent($logout);
}

$form = Form::open([
        'url' => url('/logout'), 'id' => 'logout-form', 'style' => 'display:none'
    ]) . Form::close();
?>

{!! $navbar !!}
{!! $form !!}

@if(Session::has('message'))
    <div class="container">
        {!! Alert::success(Session::get('message'))->close() !!}
    </div>
@endif

@if (Session::has('error'))
    <div class="container">
        {!! Alert::danger(Session::get('error'))->close() !!}
    </div>
@endif