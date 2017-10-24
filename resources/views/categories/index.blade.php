@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row text-center">
            <h3>Listagem de Categorias</h3>
        </div>

        <div class="row">
            {!! Button::primary('Nova Categoria')->asLinkTo(route('categories.create')) !!}

            {!! Form::model(compact('search'),
            ['class' => 'form-inline pull-right', 'method' => 'GET']) !!}
            {!! Form::label('title', 'Pesquisar Nome Categoria',
                ['class' => 'control-label']) !!}

            {!! Form::text('search', null,
                ['class' => 'form-control']) !!}

            {!! Button::primary('Buscar')->submit() !!}
            {!! Form::close() !!}
        </div>
        <br>
        <div class="row">
            @Include('categories._form_links')
            {{ $categories->links() }}
        </div>
    </div>
@endsection
