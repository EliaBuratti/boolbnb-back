@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="my-4">
            @include('partials.session_message')
        </div>
        <h1>Sponsor for: {{ $apartment[0]->title }}</h1>
        <h5>Select the sponsorship's type</h5>
        <div class="row gap-5 my-3">
            @foreach ($sponsorships as $sponsorship)
                <label class="col border shadow-sm rounded-5 p-5 text-center sponsorship-card">
                    <input type="radio" name="sponsorship" id="sponsorship-{{ $sponsorship->id }}"
                        value="{{ $sponsorship->id }}" {{ $sponsorship->id == 1 ? 'checked' : '' }}>
                    <h3 class="fw-bold">{{ $sponsorship->name }}</h3>
                    <div class="fw-medium">Price: {{ $sponsorship->price }} $</div>
                    <div class="fw-medium"> Duration: {{ $sponsorship->duration }}</div>
                </label>
            @endforeach
        </div>
        @include('partials.payment_form')
    </div>


    </div>
@endsection
