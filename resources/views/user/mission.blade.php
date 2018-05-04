@extends('template.master')

@section('title','Missions')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/user/mission.css') }}">
@endpush

@section('position','Missions')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="main-mission">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mission-head">
                            <p class="text-center">Daily Task Remaining: <b>{{ $task }}</b></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-6 offset-lg-3">
                                @if(session('pointError'))
                                    <p>{{ session('pointError') }}</p>
                                @endif
                                @if(session('pointSuccess'))
                                    <p>{{ session('pointSuccess') }}</p>
                                @endif
                                @if(session('getPointError'))
                                    <p>{{ session('getPointError') }}</p>
                                @endif
                                <div class="missions text-center">
                                    @forelse($missions->shuffle() as $mission)
                                        @if($task != 0)
                                            <a class="btn btn-outline-secondary" href="{{ url('/missions/click/'.$mission->id) }}">Click Here To Get Point</a><br><br>
                                            @php $task-- @endphp
                                        @endif
                                    @empty
                                        <small>NO missions</small>
                                    @endforelse

                                    {{ $missions->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
