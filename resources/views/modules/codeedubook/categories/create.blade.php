@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Nova Categoria</h3>

            {{--@include('errors._errors_form')--}}
            {!! Form::open(['route' => 'categories.store', 'class' => 'form']) !!}

            @include('modules.codeedubook.categories._form')

            {!! Html::openFormGroup() !!}
                {!! Button::primary('Criar Categoria')->submit() !!}
            {!! Html::closeFormGroup() !!}

            {!! Form::close() !!}
        </div>
    </div>
@endsection