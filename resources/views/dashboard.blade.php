@extends('layouts.app')

@section('content')
    <div class="container">
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
                            <a href=" {{ route('host.apartments.index') }} " class="btn btn-primary">Apartments</a>
                            <a href=" {{ route('admin.sponsorships.index') }} " class="btn btn-primary">Sponsorships</a>
                            <a href=" {{ route('admin.services.index') }} " class="btn btn-primary">Services</a>

                            <a class="btn btn-danger" href="{{ route('host.trash') }}">Cestino</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
