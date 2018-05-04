@extends('template.master')

@section('title','Checkpoint')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/user/checkpoint.css') }}">
@endpush

@section('content')

    <div class="row">
        <div class="check-main col-lg-12">

            <div class="check-form col-lg-4 offset-lg-4">

                <h2>Enter Confirmation Code</h2>

                @include('errors.error')
                @if(session('codeError'))
                    <p class="alert alert-danger">{{ session('codeError') }}</p>
                @endif
                <form class="form-group" action="" method="POST">
                    {{ csrf_field() }}
                    <input class="form-control" type="text" name="code" placeholder="Approve Code"><br>
                    <input class="btn btn-outline-primary" type="submit" name="submit" value="Confirm">
                    <a href="">Resend Code</a>
                </form>

            </div>

        </div>
    </div>

@endsection