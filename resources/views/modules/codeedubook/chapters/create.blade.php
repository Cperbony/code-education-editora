@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Novo Capítulo do Livro {{$book->title}}</h3>

            {!! Form::open(['route' => ['chapters.store', 'book' => $book->id],'class' => 'form']) !!}

            @include('modules.codeedubook.chapters._form')

            {!! Html::openFormGroup() !!}
            {!! Button::primary('Criar Capítulo')->submit() !!}
            {!! Html::closeFormGroup() !!}

            {!! Form::close() !!}
        </div>
    </div>
@endsection