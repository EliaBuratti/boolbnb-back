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
                    @if($sponsorship->duration == '24:00:00')
                        <div class="fw-medium"> Duration: 1 Day</div>
                    @elseif($sponsorship->duration == '72:00:00')
                        <div class="fw-medium"> Duration: 3 Days</div>
                    @else
                        <div class="fw-medium"> Duration: 6 Days</div>
                    @endif
                </label>
            @endforeach
        </div>
        @include('partials.payment_form')
    </div>


    </div>
@endsection
