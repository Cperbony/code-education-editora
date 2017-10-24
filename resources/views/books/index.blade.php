@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row text-center">
            <h3>Listagem de Livros</h3>
        </div>

        <div class="row">
            {!! Button::primary('Criar Livro')->asLinkTo(route('books.create')) !!}

            {!! Form::model(compact('search'),
               ['class' => 'form-inline pull-right', 'method' => 'GET']) !!}
            {!! Form::label('title', 'Pesquisar por Título',
                ['class' => 'control-label']) !!}

            {!! Form::text('search', null,
                ['class' => 'form-control']) !!}

            {!! Button::primary('Buscar')->submit() !!}
            {!! Form::close() !!}
            <br>
            <br>
            {!! Form::model(compact('searchCategories'),
             ['class' => 'form-inline pull-right', 'method' => 'GET']) !!}
            {!! Form::label('title', 'Pesquisar por Categoria',
                ['class' => 'control-label']) !!}

            {!! Form::text('search', null,
                ['class' => 'form-control']) !!}

            {!! Button::primary('Buscar')->submit() !!}
            {!! Form::close() !!}
        </div>
        <br>

        <br>
        <div class="row">
            @include('books._form_links')
            {{ $books->links() }}
        </div>
    </div>
@endsection
