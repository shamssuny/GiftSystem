@extends('template.master')

@section('title','Prize')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/user/prize.css') }}">
@endpush

@section('position','Prize')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="prize-main">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <div class="prize-list">
                            @if(session('orderError'))
                                <p class="alert alert-danger">{{ session('orderError') }}</p>
                            @endif
                            @if(session('orderExceed'))
                                <p class="alert alert-warning">{{ session('orderExceed') }}</p>
                            @endif
                            <div class="row">
                                @forelse($prizes as $prize)
                                    <div class="col-lg-4">
                                        <div class="prize">
                                            <img src="{{ asset('/prize/'.$prize->picture) }}" alt="">
                                            <p>{{ $prize->name }}</p>
                                            <p>Price: {{ $prize->price }}</p>
                                            @if($restock->restock == 'yes')
                                                @if($prize->quantity <= 0)

                                                    <button class="btn btn-outline-danger" type="button" disabled>Out Of Stock</button>
                                                @elseif($checkIfAlreadyOrdered > 0)
                                                    <button class="btn btn-outline-info" type="button" disabled>Order Limit Exceed</button>
                                                @else

                                                    <a class="btn btn-primary" href="{{ url('/prizes/form/'.$prize->id) }}">Order</a>
                                                @endif
                                            @else
                                                <button class="btn btn-outline-danger" type="button" disabled>Active During Restock</button>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="p">

                                    </div>
                                @empty
                                @endforelse

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

{{--<div class="perize">--}}

    {{--@forelse($prizes as $prize)--}}
        {{--<div class="p">--}}
            {{--<img height="100px" width="100px" src="{{ asset('/prize/'.$prize->picture) }}" alt="">--}}
            {{--<p>{{ $prize->name }}</p>--}}
            {{--<p>Price: {{ $prize->price }}</p>--}}
            {{--@if($restock->restock == 'yes')--}}
                {{--@if($prize->quantity <= 0)--}}

                    {{--<button type="button" disabled>Out Of Stock</button>--}}

                {{--@else--}}

                    {{--<a href="{{ url('/prizes/form/'.$prize->id) }}">Order</a>--}}
                {{--@endif--}}
            {{--@else--}}
                {{--<button type="button" disabled>Active During Restock</button>--}}
            {{--@endif--}}
        {{--</div>--}}
    {{--@empty--}}
    {{--@endforelse--}}

{{--</div>--}}