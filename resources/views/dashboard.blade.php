@extends('layouts.app')

@section('content')
    <div class="container">

        @include('partials.session_message')

        <h2 class="fs-4 text-secondary mt-4 mb-2">
            {{ __('Dashboard') }}
        </h2>
        <h6>{{ __('You are logged in!') }}</h6>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        @if (Auth::id() === 1)
            <div class="d-flex gap-4 py-4">
                <a href=" {{ route('admin.sponsorships.index') }} " class="btn btn-dark primary position-relative">
                    Sponsorships 
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg_primary text-dark border border-black">
                        {{$total_sponsorships}}
                        <span class="visually-hidden">Total Sponsorships</span>
                    </span>
                </a>
                <a href=" {{ route('admin.services.index') }} " class="btn btn-dark primary position-relative">
                    Services <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg_primary text-dark border border-black">
                        {{$total_services}}
                        <span class="visually-hidden">Total Services</span>
                    </span>
                </a>
            </div>
        @else
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 mt-4">

                <div class="col">

                    <div class="card">

                        <div class="card-header text-center bg_primary">Apartments</div>

                        <div class="card-body">
                            <strong>Total apartments: {{ $total_apartment }}</strong>
                            <div class="py-4 d-flex flex-wrap gap-3">
                                @if ($total_apartment)
                                    <a href=" {{ route('host.apartments.index') }} " class="btn btn-dark primary flex-grow-1">My
                                        apartments</a>
                                @else
                                    <a href="{{ route('host.apartments.create') }}" class="btn btn-dark primary flex-grow-1">Add new
                                        apartment</a>
                                @endif
                                <a class="btn btn-danger flex-grow-1" href="{{ route('host.trash') }}">Trash</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col">

                    <div class="card">

                        <div class="card-header text-center bg_primary">Messages</div>

                        <div class="card-body">
                            <strong>Total messages: {{ $total_messages }}</strong>
                            <div class="py-4">
                                <a href=" {{ route('host.messages.index') }} " class="btn btn-dark primary">My
                                    messages</a>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col">

                    <div class="card">

                        <div class="card-header text-center bg_primary">Views</div>

                        <div class="card-body">
                            <strong>Total views: {{ $totalViews }}</strong>
                            <div class="py-4">
                                <a href=" {{ route('host.views.index') }} " class="btn btn-dark primary">My
                                    views</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
