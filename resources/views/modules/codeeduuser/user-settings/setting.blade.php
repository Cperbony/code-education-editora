@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Editar perfil</h3>

            {{--@include('errors._errors_form')--}}
            {!! Form::open(['route' => 'codeeduuser.user_settings.update',
            'class' => 'form', 'method' => 'PUT']) !!}

            @include('codeeduuser::user-settings._form')

            {!! Html::openFormGroup() !!}
            {!! Button::primary('Salvar')->submit() !!}
            {!! Html::closeFormGroup() !!}

            {!! Form::close() !!}
        </div>
    </div>
@endsection