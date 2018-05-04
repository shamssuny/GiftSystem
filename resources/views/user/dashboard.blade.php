@extends('template.master')

@section('title','Dashboard')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/user/dashboard.css') }}">
@endpush

@section('position','Dashboard')

@section('content')


    <div class="row">

        <div class="dash-lower col-lg-12">

            <div class="row">

                <div class="posts-main col-lg-6 offset-lg-3">



                        @foreach($allPost as $post)
                        <div class="post">
                            <div class="row">
                                <div class="col-lg-12">
                                    <i class="fas fa-book"></i>
                                    <small>{{ $post->created_at->toDateString() }} . {{ $post->created_at->diffforhumans() }}</small>
                                </div>
                                <div class="col-lg-12">
                                    <p>{{ $post->details }}</p>
                                    @if($post->picture == 'none')
                                    @else
                                        <img src="{{ asset('/posts/'.$post->picture) }}" alt="">
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach


                </div>

            </div>

        </div>

    </div>


@endsection