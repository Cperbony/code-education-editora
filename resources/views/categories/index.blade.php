@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Listagem de Categorias</h3>
            {!! Button::primary('Nova Categoria')->asLinkTo(route('categories.create')) !!}
        </div>
        <div class="row">

            @Include('categories._form_links')

            {{ $categories->links() }}
        </div>
    </div>
@endsection
