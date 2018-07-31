@extends('layouts.app')

@section('content')
    <section class="container info">
        <article class="col-md-4">
            <h2>{{$product->title}}</h2>
            <div class="author">
                <img src="http://www.gravatar.com/avatar/{{md5($product->author->email)}}?s=30" alt="{{$product->author->name}}"/>
                <p>{{$product->author->name}}</p>
            </div>
            <p>{{$product->description}}</p>
        </article>

        <div class="col-md-4 text-center">
            <img src="{{asset($product->thumbnail_relative)}}" alt="{{$product->title}}"/>
            <div class="col-md-12">
                <div class="progress progress-book">
                    <div class="progress-bar progress-bar-success" role="progressbar"
                         aria-valuenow="{{$product->percent_complete}}" aria-valuemin="0" aria-valuemax="100"
                         style="width: {{$product->percent_complete}}%">
                        <span class="sr-only">{{$product->percent_complete}}% completo</span>
                    </div>
                </div>
                <p>Este livro está {{$product->percent_complete}}% completo</p>
            </div>
        </div>

        <aside class="col-md-4 text-center">
            <div class="col-md-5 col-md-offset-1">
                <p class="price">$ {{$product->price}}</p>
            </div>
            <div class="pull-right">
                <a href="{{route('store.checkout', ['product' => $product->id])}}" class="btb btn-success btn-cpr">comprar</a>
            </div>
            <div class="col-md-12">
                <hr>
                <p>
                    @foreach($product->chapters as $chapter)
                        {{$chapter->name}}<br/>
                    @endforeach
                </p>
            </div>
        </aside>
    </section>
@endsection
