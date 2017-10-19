@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Listagem de Livros</h3>

            {!! Button::primary('Criar Livro')->asLinkTo(route('books.create')) !!}

        </div>
        <br>
        <div class="row">
            <div class="row">
                {!! Form::model(compact('search'),
                    ['class' => 'form-inline', 'method' => 'GET']) !!}
                {!! Form::label('title', 'Pesquisar por Título',
                    ['class' => 'control-label']) !!}

                {!! Form::text('search', null,
                    ['class' => 'form-control']) !!}

                {!! Button::primary('Buscar')->submit() !!}
                {!! Form::close() !!}

            </div>

            @include('books._form_links')

            {{ $books->links() }}
        </div>
    </div>
@endsection
