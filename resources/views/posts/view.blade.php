@extends('base')

@section('title')
Admin Post
@endsection

@section('container')
<div class="container">
    <div class="row mt-2">
        <div class="col-md-2">
            <h2>Admin </h2>
        </div>
        <div class="col-md-10">
            <div class="create-btn d-flex justify-content-end my-2">
                <a href="{{ route('admin.post.index')}}" class="btn btn-primary">Return</a>
            </div>

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
    </div>
</div>
@endsection