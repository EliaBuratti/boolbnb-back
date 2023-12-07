@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('message'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>Attention!</strong> {{ session('message') }}
            </div>
        @endif
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
                            <a href=" {{ route('host.apartments.edit', $apartment->slug) }} "
                                class="btn btn-warning">Edit</a>
                            <form action="{{ route('host.apartments.destroy', $apartment->slug) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>

                            </form>

                        </div>
                    </div>
                </div>
            @empty
                <h1>no apartments</h1>
            @endforelse
        </div>
    </div>
@endsection
