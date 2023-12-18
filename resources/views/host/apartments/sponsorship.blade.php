@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>Sponsor for: {{ $apartment[0]->title }}</h1>
        <h5>Select the sponsorship's type</h5>
        <div class="row row-cols-md-3 row-cols-1 gap-4 mb-3">
            @foreach ($sponsorships as $sponsorship)
                <div class="col border rounded-5 p-5 text-center sponsorship-card">
                    <h3 class="fw-bold">{{$sponsorship->name}}</h3>
                    <div class="fw-medium">Price: {{$sponsorship->price}} $</div>
                    <div class="fw-medium"> Duration: {{$sponsorship->duration}}</div>
                </div>
            @endforeach
        </div>
        @include('partials.payment_form')
    </div>


    </div>
@endsection