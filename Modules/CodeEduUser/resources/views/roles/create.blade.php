 @extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Novo Papel de Usuário</h3>

            {{--@include('errors._errors_form')--}}
            {!! Form::open(['route' => 'codeeduuser.roles.store', 'class' => 'form']) !!}

            @include('codeeduuser::roles._form')

            {!! Html::openFormGroup() !!}
                {!! Button::primary('Criar')->submit() !!}
            {!! Html::closeFormGroup() !!}

            {!! Form::close() !!}
        </div>
    </div>
@endsection