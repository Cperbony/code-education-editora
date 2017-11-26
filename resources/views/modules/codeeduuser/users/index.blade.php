@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row text-center">
            <h3>Listagem de Usuários</h3>
        </div>

        <div class="row">
            {!! Button::primary('Novo Usuário')->asLinkTo(route('codeeduuser.users.create')) !!}

            {!! Form::model(compact('search'),
            ['class' => 'form-inline pull-right', 'method' => 'GET']) !!}
            {!! Form::label('title', 'Pesquisar Usuário',
                ['class' => 'control-label']) !!}

            {!! Form::text('search', null,
                ['class' => 'form-control']) !!}

            {!! Button::primary('Buscar')->submit() !!}
            {!! Form::close() !!}
        </div>
        <br>
        <div class="row">
            @Include('codeeduuser::users._form_links')
            {{ $users->links() }}
        </div>
    </div>
@endsection
