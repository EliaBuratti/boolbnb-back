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
            <a href=" {{ route('admin.sponsorships.index') }} " class="btn btn-primary">Sponsorships</a>
            <a href=" {{ route('admin.services.index') }} " class="btn btn-primary">Services</a>
        @else
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 mt-4">

                <div class="col">

                    <div class="card">

                        <div class="card-header text-center bg_primary">Apartments</div>

                        <div class="card-body">
                            <strong>Total apartments: {{ $total_apartment }}</strong>
                            <div class="py-4">
                                <a href=" {{ route('host.apartments.index') }} " class="btn btn-dark primary">My
                                    apartments</a>
                                <a class="btn btn-danger" href="{{ route('host.trash') }}">Trash</a>
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
            </div>
        @endif
    </div>
@endsection
