@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @forelse ($aparments as $apartment)
                <div class="col-4">
                    <div class="card shadow">
                        <div class="card-header">
                            <h3>{{ $apartment->title }}</h3>
                        </div>
                        <div class="card-body">
                            {{ $apartment->thumbnail }}
                        </div>
                        <div class="card-footer">
                            <h6> {{ $apartment->address }}</h6>
                            <a href="{{ route('host.apartments.show', $apartment) }}" class="btn btn-primary">show</a>
                        </div>
                    </div>
                </div>
            @empty
            @endforelse
        </div>
    </div>
@endsection
