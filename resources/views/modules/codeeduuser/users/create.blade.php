@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Nova Usuário</h3>

            {{--@include('errors._errors_form')--}}
            {!! Form::open(['route' => 'codeeduuser.users.store', 'class' => 'form']) !!}

            @include('codeeduuser::users._form')

            {!! Html::openFormGroup() !!}
                {!! Button::primary('Criar Usuário')->submit() !!}
            {!! Html::closeFormGroup() !!}

            {!! Form::close() !!}
        </div>
    </div>
@endsection