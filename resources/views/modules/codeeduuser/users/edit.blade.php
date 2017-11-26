@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Editar Usuário</h3>

            {{--@include('errors._errors_form')--}}
            {!! Form::model($user, [
            'route' => ['codeeduuser.users.update', 'user' => $user->id
            ], 'class' => 'form', 'method' => 'PUT']) !!}

            @include('codeeduuser::users._form')

            {!! Html::openFormGroup() !!}
                {!! Button::primary('Salvar Usuário')->submit() !!}
            {!! Html::closeFormGroup() !!}

            {!! Form::close() !!}
        </div>
    </div>
@endsection