<?php
$navbar = Navbar::withBrand(config('app.name'), url('/'))->inverse();
if (Auth::check()) {
    $arrayLinks = [
        [
            'link' => route('categories.index'),
            'title' => 'Categorias',
            'permission' => 'category-admin/list'
        ],
        [
            'Books',
            [
                [
                    'link' => route('books.index'),
                    'title' => 'Listar',
                    'permission' => 'book-admin/list'
                ],
                [
                    'link' => route('trashed.books.index'),
                    'title' => 'Lixeira',
                    'permission' => 'book-trashed-admin/list'
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
    if (Auth::user()->can('user-admin/list')) {
        $arrayLinks [] = [
            'Usuários',
            [
                [
                    'link' => route('codeeduuser.users.index'),
                    'title' => 'Usuários',
                    'permission' => 'user-admin/list'
                ],
                [
                    'link' => route('codeeduuser.roles.index'),
                    'title' => 'Papel de Usuário',
                    'permission' => 'role-admin/list'
                ],
            ]
        ];
    }
    $links = Navigation::links(\NavbarAuthorization::getLinksAuthorized($arrayLinks));
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