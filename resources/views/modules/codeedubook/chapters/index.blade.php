@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row text-center">
            <h3>Capítulos de: {{$book->title}}</h3>
        </div>

        <div class="row">
            {!! Button::primary('Novo Capítulo')->asLinkTo(route('chapters.create', ['book' => $book->id])) !!}

            {!! Form::model(compact('search'),
               ['class' => 'form-inline pull-right', 'method' => 'GET']) !!}
            {!! Form::label('title', 'Pesquisar por Título',
                ['class' => 'control-label']) !!}

            {!! Form::text('search', null,
                ['class' => 'form-control']) !!}

            {!! Button::primary('Buscar')->submit() !!}
            {!! Form::close() !!}
            <br>
        </div>
        <br>

        <br>
        <div class="row">
            @include('modules.codeedubook.chapters._form_links')
            {{ $chapters->links() }}
        </div>
    </div>
@endsection
