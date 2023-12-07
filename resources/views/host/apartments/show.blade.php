@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="mt-3 p-5 pt-1 mb-4 bg-light rounded-3">
                <div class="row">

                    <div class="col-7">
                        <div class="container-fluid pt-1">
                            <h1 class="display-5 fw-bold">{{ $apartment->title }}</h1>
                            <img class="img-fluid rounded-4" src="{{ asset('storage/' . $apartment->thumbnail) }} "
                                alt="">
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="row">
                            @forelse ($gallery as $gallery_image)
                                <div class="col-6 g-2">
                                    <img class="img-fluid rounded-4" src="{{ asset('storage/' . $gallery_image->img) }} "
                                        alt="">
                                </div>
                            @empty
                                <h4>no gallery here!</h4>
                            @endforelse
                        </div>
                    </div>
                </div>

                <div class="container-fluid mt-3">
                    <p class="col-md-8 fs-4">{{ $apartment->description }}</p>

                </div>
            </div>
        </div>
    </div>
@endsection
