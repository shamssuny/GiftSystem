@extends('template.master')

@section('title','Register')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endpush

@section('content')

<div class="row">

    <div class="register-main col-lg-12">

        <div class="register-area col-lg-4 offset-lg-4">
            <h2>Register</h2><br>
            @include('errors.error')
            <form class="form-group" action="" method="post">
                {{ csrf_field() }}
                <input class="form-control" type="text" name="username" placeholder="UserName"><br>
                <input class="form-control" type="email" name="email" placeholder="Your Email"><br>
                <input class="form-control" type="password" name="password" placeholder="Password"><br>
                <input class="form-control" type="password" name="password_confirmation" placeholder="Confirm Password"><br>
                <input class="btn btn-outline-info" type="submit" name="submit" value="Register" >
            </form>

        </div>

    </div>

</div>
@endsection