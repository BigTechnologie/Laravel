@extends('base')

@section('title')
    Login Form
@endsection


@section('container')
    <div class="container">
        <h1>Login Form</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

        <form action="{{ route('login.authenticate') }}" method="POST">
            @csrf

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
            </div> 
            <a href="{{ route('welcome') }}" class="btn btn-danger mt-1">
                Cancel
            </a>
            <button type="submit" class="btn btn-primary mt-1">
                Login
            </button>

            

        </form>


    </div>

@endsection