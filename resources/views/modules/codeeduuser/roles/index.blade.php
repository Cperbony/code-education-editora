@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row text-center">
            <h3>Listagem de Roles</h3>
        </div>

        <div class="row">
            {!! Button::primary('Nova Role')->asLinkTo(route('codeeduuser.roles.create')) !!}

            {!! Form::model(compact('search'),
            ['class' => 'form-inline pull-right', 'method' => 'GET']) !!}
            {!! Form::label('title', 'Pesquisar Role',
                ['class' => 'control-label']) !!}

            {!! Form::text('search', null,
                ['class' => 'form-control']) !!}

            {!! Button::primary('Buscar')->submit() !!}
            {!! Form::close() !!}
        </div>
        <br>
        <div class="row">
            @Include('codeeduuser::roles._form_links')
            {{ $roles->links() }}
        </div>
    </div>
@endsection
