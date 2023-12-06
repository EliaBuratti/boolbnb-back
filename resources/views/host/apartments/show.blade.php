@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            .<div class="p-5 mb-4 bg-light rounded-3">
                <div class="container-fluid py-5">
                    <h1 class="display-5 fw-bold">{{ $apartment->title }}</h1>
                    <p class="col-md-8 fs-4">{{ $apartment->description }}
                    </p>
                    <img class="img-fluid" src="{{ asset('storage/thumbnails/' . $aparment->thumbnail) }}" alt="">
                    <button class="btn btn-primary btn-lg" type="button">Example button</button>
                </div>
            </div>
        </div>
    </div>
@endsection
