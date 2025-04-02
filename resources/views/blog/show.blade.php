@extends('base')

@section('title')
    {{$post->title}}
@endsection

@section('container')
    <div class="container">
        <h1>{{ $post->title }}</h1>

        <div class="post-img">
            <img src="
            @if (Str::startsWith($post->imageUrl, 'http'))
                {{ $post->imageUrl }}
            @else
                {{ Storage::url($post->imageUrl) }}
            @endif
            " class="img-fluid card" width="100%" height="200px" alt="">
        </div>
        <strong> {{ $post->created_at->diffForHumans() }} </strong>

        <div class="post-category">
            <strong>Category : {{ $post->category->name }}</strong>
        </div>

        <div class="post-content text-justify">

            {{$post->content}}
        </div>



    </div>
@endsection
