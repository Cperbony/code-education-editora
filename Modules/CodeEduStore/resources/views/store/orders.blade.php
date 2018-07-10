@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Minhas Compras</h2>

        <table class="table table-bordered">
            <thead>
            <th>ID</th>
            <th>Livro</th>
            <th>Preço</th>
            <th>Ações</th>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->orderable->title}}</td>
                    <td>{{ $order->orderable->price}}</td>
                    <td>
                        <a href="{{route('books.download-common',
                        ['id' => $order->orderable->id])}}"
                           class="btn btn-primary">Download
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
