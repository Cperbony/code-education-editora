<?php
$navbar = Navbar::withBrand(config('app.name'), url('/'))->inverse();
if (Auth::check()) {
    $links = Navigation::links([
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
        ]
    ]);
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
        {!! Alert::success(Session::get('message')) !!}
    </div>
@endif