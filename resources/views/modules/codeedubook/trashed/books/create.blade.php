@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Novo Livro</h3>

            {!! Form::open(['route' => 'books.store', 'class' => 'form']) !!}

            @include('modules.codeedubook.trashed.books._form')

            {!! Html::openFormGroup() !!}
            {!! Button::primary('Cadastrar Livro')->submit() !!}
            {!! Html::closeFormGroup() !!}

            {!! Form::close() !!}
        </div>
    </div>
@endsection