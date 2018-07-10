@extends('layouts.app')

@section('content')
    <div class="content container">
        @if($status)
            <h2>Sua compra foi efetuada com sucesso.</h2>
            <p>
                <a href="{{route('books.download-common', ['id' => $order->orderable->id])}}">Clique aqui para fazer o
                    download</a>
            </p>
        @else
            <h2>Opps!!!"</h2>
            <p>Seu cartão de crédito foi recusado. Tente Novamente!</p>
        @endif
    </div>
@endsection