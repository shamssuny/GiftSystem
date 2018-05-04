@extends('template.master')

@section('title','Login')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endpush


@section('content')

<div class="row">
    <div class= "main col-lg-12">
            <div class="row">
            <div class="form-input col-lg-4 offset-lg-4">
                <h2>Login</h2><br>
                @if(session('regSuccess'))
                    <p class="alert alert-success">{{ session('regSuccess') }}</p>
                @endif
                @if(session('loginError'))
                    <p class="alert alert-danger">{{ session('loginError') }}</p>
                @endif
                @include('errors.error')
                <form class="form-group" action="" method="post">
                    {{ csrf_field() }}
                    <input class="form-control" type="text" name="username" placeholder="Username"><br>
                    <input class="form-control" type="password" name="password" placeholder="Password"><br>
                    <input class="btn btn-outline-success" type="submit" name="submit" value="Login">
                    <a href="{{ url('forget-password') }}">Forget Password?</a><br>
                    <p>Not a member ? <a href="{{ url('/register') }}">Register Here</a></p>
                </form>
            </div>
            </div>
    </div>
</div>


@endsection