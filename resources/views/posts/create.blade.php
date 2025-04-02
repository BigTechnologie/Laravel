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
                    <a href="{{ route('admin.post.index') }}" class="btn btn-primary">Return</a>
                </div>
                @include('posts.postForm',['categories',$categories]) 
            </div>
        </div>
    </div>
@endsection
