@extends('template.master')

@section('title','My Orders')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/user/myOrder.css') }}">
@endpush

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="main-orders">
                <h3 class="text-center">Orders</h3>
                <div class="row">
                    @forelse($myPrize as $prize)
                        <div class="col-lg-6 offset-lg-3">
                            <div class="order">
                                <p><b>Product: </b>{{ $prize->prize_name }}</p>
                                <p><b>Delivery Address: </b>{{ $prize->address }}</p>
                                <p><b>Phone: </b>{{ $prize->phone }}</p>
                                <p><b>Email: </b>{{ $prize->email }}</p>
                                <p><b>Status: </b>{{ $prize->status }}</p>
                            </div>
                        </div>
                    @empty
                        <small>No Orders</small>
                    @endforelse
                    {{ $myPrize->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection

<div>



</div>