@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-3">
            @forelse ($apartments as $apartment)
                <div class="col-4 g-3">
                    <div class="card shadow h-100">
                        <div class="h-20 card-header ">
                            <h3>{{ $apartment->title }}</h3>
                        </div>
                        <div class="card-body">
                            <img class="img-fluid rounded-4 card-thumbnail"
                                src="{{ asset('storage/' . $apartment->thumbnail) }}" alt="">
                        </div>
                        <div class="card-footer">
                            <h6>{{ $apartment->city }} - {{ $apartment->address }}</h6>
                            <a href="{{ route('host.apartments.show', $apartment->slug) }}" class="btn btn-primary">show</a>
                        </div>
                    </div>
                </div>
            @empty
                <h1>no apartments</h1>
            @endforelse
        </div>
    </div>
@endsection
