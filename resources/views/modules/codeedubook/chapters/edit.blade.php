@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Editar Capítulo do Lvro {{$book->title}}</h3>

            {{--@include('errors._errors_form')--}}
            {!! Form::model($chapter, [
            'route' => ['chapters.update', 'book' => $book->id, 'chapter' => $chapter->id
            ], 'class' => 'form', 'method' => 'PUT']) !!}

            @include('modules.codeedubook.chapters._form')

            {!! Html::openFormGroup() !!}
            {!! Button::primary('Salvar Capítulo')->submit() !!}
            {!! Html::closeFormGroup() !!}

            {!! Form::close() !!}
        </div>
    </div>
@endsection