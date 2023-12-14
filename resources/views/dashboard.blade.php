@extends('layouts.app')

@section('content')
    <div class="container">

        @include('partials.session_message')

        <h2 class="fs-4 text-secondary my-4">
            {{ __('Dashboard') }}
        </h2>
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">{{ __('User Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}

                        <div class="mt-5">
                            @if(Auth::id() === 1)
                            <a href=" {{ route('admin.sponsorships.index') }} " class="btn btn-primary">Sponsorships</a>
                            <a href=" {{ route('admin.services.index') }} " class="btn btn-primary">Services</a>
                            @else

                            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4">

                                <div class="col">

                                    <div class="card">

                                        <div class="card-header text-center">Apartments</div>

                                        <div class="card-body">
                                            <strong>Total apatments: {{$total_apartment}}</strong>
                                            <div class="py-4">
                                                <a href=" {{ route('host.apartments.index') }} " class="btn btn-primary">My aparments</a>
                                                <a class="btn btn-danger" href="{{ route('host.trash') }}">Trash</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col">

                                    <div class="card">

                                        <div class="card-header text-center">Messages</div>

                                        <div class="card-body">
                                            <strong>Total messages: {{$total_messages}}</strong>
                                            <div class="py-4">
                                                <a href=" {{ route('host.messages.index') }} " class="btn btn-primary">My messages</a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
