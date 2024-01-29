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
                    <div class="fw-medium">Price:
                        {{ $sponsorship->price }}$ - <span class="day-duration">{{ $sponsorship->duration }}</span>
                    </div>
                </label>
            @endforeach
        </div>
        @include('partials.payment_form')
        <script>
            window.onload = function() {

                let durationField = document.querySelectorAll('.day-duration');
                getDuration(durationField);

            };

            function getDuration(obj) {
                obj.forEach(element => {
                    const days = durationToDays(element.innerText);
                    element.innerHTML = `${days} day${days <= 1 ? '' : 's'}`;
                });
            };

            function durationToDays(durationStr) {
                const parts = durationStr.split(":");
                const hours = parseInt(parts[0]);
                const minutes = parseInt(parts[1]);
                const seconds = parseInt(parts[2]);

                const totalHours = hours + minutes / 60 + seconds / 3600;
                const days = totalHours / 24;

                return Number.isInteger(days) ? days : days.toFixed(2);
            }
        </script>
    </div>
@endsection
