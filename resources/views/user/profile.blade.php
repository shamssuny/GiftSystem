@extends('template.master')

@section('title','Profile')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/user/profile.css') }}">
@endpush

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="main-profile">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="profile-head">
                            <h3>Profile Section</h3>
                        </div>
                        @include('errors.error')
                        @if(session('updateSuccess'))
                            <p class="alert alert-success">{{ session('updateSuccess') }}</p>
                        @endif
                    </div>
                    <div class="col-lg-12">
                        <div class="profile-body-main">
                            <div class="row">
                                <div class="col-lg-5 offset-lg-1">
                                    <div class="profile-left">
                                        <p>Basic Information:</p>
                                        <form class="form-group" action="" method="POST">
                                            {{ csrf_field() }}
                                            <input class="form-control" type="text" name="full_name" placeholder="Full Name" value="{{ $getData->full_name }}"><br>
                                            <input class="form-control" type="text" name="phone" placeholder="Phone" value="{{ $getData->phone }}"><br>
                                            <input class="form-control" type="text" name="gender" placeholder="Gender" value="{{ $getData->gender }}"><br>
                                            <textarea class="form-control" name="permanent_address" placeholder="Your Full Address">{{ $getData->permanent_address }}</textarea><br>
                                            <input class="btn btn-outline-success" type="submit" name="submit" value="Update Information">
                                        </form>
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="profile-right">
                                        <p>Update Password:</p>
                                        <form action="{{ url('/profile/password') }}" method="POST">
                                            {{ csrf_field() }}
                                            <input class="form-control" type="password" name="password" placeholder="New Password"><br>
                                            <input class="form-control" type="password" name="password_confirmation" placeholder="Confirm Password"><br>
                                            <input class="btn btn-outline-success" type="submit" name="submit" value="Update Password">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


