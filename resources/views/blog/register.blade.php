@extends('base')

@section('title')
    Register Form
@endsection


@section('container')
    <div class="container">
        <h1>Register Form</h1>

        <form action="{{ route('register.save') }}" method="POST">

            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" placeholder="Name ..." name="name"
                    value="{{ old('name', isset($user) ? $user->name : '') }}" class="form-control" id="name"
                    aria-describedby="nameHelp" required />

                @error('name')
                    <div class="error text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" placeholder="Email ..." name="email"
                    value="{{ old('email', isset($user) ? $user->email : '') }}" class="form-control" id="email"
                    aria-describedby="emailHelp" required />

                @error('email')
                    <div class="error text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" placeholder="Password ..."
                    value="{{ old('password', isset($user) ? $user->password : '') }}" class="form-control" id="password"
                    aria-describedby="passwordHelp" required />

                @error('password')
                    <div class="error text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div> <a href="{{ route('admin.user.index') }}" class="btn btn-danger mt-1">

        </form>


    </div>

@endsection