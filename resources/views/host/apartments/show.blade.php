@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="mt-3 p-5 pt-1 mb-4 bg-light rounded-3">
                <div class="container-fluid pt-1">
                    <h1 class="display-5 fw-bold">{{ $apartment->title }}</h1>
                    <img class="img-fluid rounded-4" src="{{ asset('storage/' . $apartment->thumbnail) }} " alt="">
                </div>
                <div class="container-fluid mt-3">
                    <p class="col-md-8 fs-4">{{ $apartment->description }}</p>

                </div>
            </div>
        </div>
    </div>
@endsection
