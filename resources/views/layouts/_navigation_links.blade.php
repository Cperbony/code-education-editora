<?php
$appName = config('app.name');
$navbar = Navbar::withBrand(
    "<img src=\"/img/logo.png\" title=\"$appName\" alt=\"$appName\">",
    url('/'));
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
                    'link' => route('store.orders'),
                    'title' => 'Minhas Compras',
                    ],
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
} else {
    $formSearch = Form::open(['url' => route('store.search'), 'class' => 'form-inline form-search navbar-right', 'method' => 'GET']) .
        Html::openFormGroup() .
        InputGroup::withContents(Form::text(
            'search', null,
            ['class' => 'form-control']))
            ->append(Form::submit('', ['class' => 'btn-search'])) .
        Html::closeFormGroup();
    Form::close();

    $menuRight = Navigation::pills([
        [
            'link' => url('/logout'),
            'title' => 'Registrar',
            'linkAttributes' => [
                'class' => "btnnew btnnew-default"
            ]
        ],
        [
            'link' => url('/logout'),
            'title' => 'Login',
            'linkAttributes' => [
                'class' => "btnnew btnnew-default"
            ]
        ]
    ])->right()->render();
    $navbar->withContent($menuRight)
        ->withContent("<div>$formSearch</div>");
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

