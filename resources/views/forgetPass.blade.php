@extends('template.master')

@section('title','Forget Password')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/user/forgetPass.css') }}">
@endpush
@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="forget-main">
                <div class="row">
                    <div class="col-lg-4 offset-4">
                        <div class="forget-pass">
                            <h3>Reset Password</h3>
                            @include('errors.error')
                            @if(session('resetError'))
                                <small class="alert alert-warning">{{ session('resetError') }}</small>
                            @endif
                            <form class="form-group" action="" method="POST">
                                {{ csrf_field() }}
                                <input class="form-control" type="email" name="email" placeholder="Your Email"><br>
                                <input class="btn btn-outline-dark" type="submit" name="submit" value="Reset">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection