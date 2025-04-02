@extends('base')

@section('title')
    Blog home page
@endsection

@section('container')
    <div class="container">
        <h1>Categories</h1>
        <div class="categories row gx-0">
            @foreach ($categories as $category)
                <div class="categorie-item col-md-6">
                    <a href="{{ route('blog.show.category', ['id' => $category->id]) }}" class="m-1 card">
                        <img src="{{ $category->imageUrl }}" height="200" alt="">
                        <div class="categorie-details p-1">
                            <h4>{{ $category->name }}</h4>
                            <div>
                                Article count : {{ $category->posts->count()}}
                            </div>
                            <small> {{ $category->created_at->diffForHumans() }} </small>

                        </div>

                    </a>
                </div>
            @endforeach

        </div>
        @include('paginate',['datas' =>$categories])


    </div>
@endsection
