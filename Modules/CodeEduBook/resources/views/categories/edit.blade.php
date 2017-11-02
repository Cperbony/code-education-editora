@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Editar Categoria</h3>

            {{--@include('errors._errors_form')--}}
            {!! Form::model($category, [
            'route' => ['categories.update', 'category' => $category->id
            ], 'class' => 'form', 'method' => 'PUT']) !!}

            @include('codeedubook::categories._form')

            {!! Html::openFormGroup() !!}
                {!! Button::primary('Salvar Categoria')->submit() !!}
            {!! Html::closeFormGroup() !!}

            {!! Form::close() !!}
        </div>
    </div>
@endsection