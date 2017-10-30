@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Editar Livro</h3>

            {{--@include('errors._errors_form')--}}
            {!! Form::model($book, [
            'route' => ['books.update', 'book' => $book->id
            ], 'class' => 'form', 'method' => 'PUT']) !!}

            @include('modules.codeedubook.trashed.books._form')

            {!! Html::openFormGroup() !!}
            {!! Button::primary('Salvar Livro')->submit() !!}
            {!! Html::closeFormGroup() !!}

            {!! Form::close() !!}
        </div>
    </div>
@endsection