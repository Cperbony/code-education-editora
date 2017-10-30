@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Lixeira de Livros</h3>
            <div class="row">
                {!! Form::model(compact('search'),
                   ['class' => 'form-inline pull-right', 'method' => 'GET']) !!}
                {!! Form::label('title', 'Pesquisar por Título',
                    ['class' => 'control-label']) !!}

                {!! Form::text('search', null,
                    ['class' => 'form-control']) !!}

                {!! Button::primary('Buscar')->submit() !!}
                {!! Form::close() !!}
            </div>
        </div>
        <br>
        <div class="row">
            @if ($books->count() > 0)
                @include('modules.codeedubook.trashed.books._form_links')
            @else
                <div class="alert-danger well well-lg text-center"><strong>Lixeira Vazia</strong></div>
            @endif
            {{ $books->links() }}
        </div>
    </div>
@endsection
