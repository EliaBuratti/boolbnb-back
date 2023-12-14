@extends('layouts.app')

@section('content')
    <div class="container">

        @include('../partials.errors')

        <h2 class="mt-3">Create a new apartment</h2>
        <div class="row">


            <form autocomplete="off" action="{{ route('host.apartments.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                {{-- Row 1 --}}
                <div class="row row-cols-2">
                    {{-- Title --}}
                    <div class="col mb-3">
                        <label for="title" class="form-label">Apartment Title</label>
                        <input type="text" class="form-control" name="title" id="title"
                            placeholder="Type the title of your new apartment"
                            class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required
                            minlength="5" maxlength="100">
                        @error('title')
                            <div class="text-danger"> {{ $message }} </div>
                        @enderror
                    </div>

                    {{-- Visibility --}}
                    <div class="col">
                        <div>Do you want to make it immediately visible?</div>
                        <div class="m-3 form-check form-check-inline">
                            <input class="form-check-input" aria-describedby="visible_true_HelpID" type="radio"
                                name="visible" id="visible_true" value="true"
                                class="form-control @error('visible') is-invalid @enderror" checked>
                            <label class="form-check-label" for="visible_true">Yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" aria-describedby="visible_false_HelpID" type="radio"
                                name="visible" id="visible_false" value="false"
                                class="form-control @error('visible') is-invalid @enderror" checked>
                            <label class="form-check-label" for="visible_false">No</label>
                        </div>

                        @error('visible')
                            <div class="text-danger"> {{ $message }} </div>
                        @enderror
                    </div>

                </div>

                {{-- Row 2 --}}
                <div class="row row-cols-2">
                    {{-- Nation --}}
                    <div class="col mb-3">
                        <label for="nation" class="form-label">Country</label>
                        <select class="form-select" name="nation" id="nation" required>
                            <option disabled selected>Select the country of your apartment</option>
                            @foreach ($countries as $country)
                                <option value="{{ $country['name'] }} - {{ $country['code'] }}">
                                    {{ $country['name'] }} - {{ $country['code'] }}
                                </option>
                            @endforeach
                            @error('nation')
                                <div class="text-danger"> {{ $message }} </div>
                            @enderror
                        </select>
                    </div>

                    {{-- Address --}}
                    <div class="col mb-3 position-relative">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" id="address" name="address" class="form-control"
                            placeholder="Type the address of your apartment"
                            class="form-control @error('address') is-invalid @enderror" value="{{ old('address') }}"
                            required>
                        <ul id="search-results" class="w-100 p-0 position-absolute top-100 left-0 bg-white z-2"></ul>
                        @error('address')
                            <div class="text-danger"> {{ $message }} </div>
                        @enderror
                    </div>
                </div>

                {{-- Row 3 --}}
                <div class="row row-cols-4">
                    {{-- Beds --}}
                    <div class="col mb-3">
                        <label for="beds" class="form-label">Beds</label>
                        <input type="number" class="form-control" name="beds" id="beds"
                            placeholder="Type the number of beds in your apartment"
                            class="form-control @error('beds') is-invalid @enderror" value="{{ old('beds') }}" required
                            min="1" max="25">
                        @error('beds')
                            <div class="text-danger"> {{ $message }} </div>
                        @enderror
                    </div>

                    {{-- Rooms --}}
                    <div class="col mb-3">
                        <label for="rooms" class="form-label">Rooms</label>
                        <input type="number" class="form-control" name="rooms" id="rooms"
                            placeholder="Type the number of rooms in your apartment"
                            class="form-control @error('rooms') is-invalid @enderror" value="{{ old('rooms') }}" required
                            min="1" max="25">
                        @error('rooms')
                            <div class="text-danger"> {{ $message }} </div>
                        @enderror
                    </div>

                    {{-- Bathrooms --}}
                    <div class="col mb-3">
                        <label for="bathrooms" class="form-label">Bathrooms</label>
                        <input type="number" class="form-control" name="bathrooms" id="bathrooms"
                            placeholder="Type the number of bathrooms in your apartment"
                            class="form-control @error('bathrooms') is-invalid @enderror" value="{{ old('bathrooms') }}"
                            required min="1" max="25">
                        @error('bathrooms')
                            <div class="text-danger"> {{ $message }} </div>
                        @enderror
                    </div>

                    {{-- M2 Square --}}
                    <div class="col mb-3">
                        <label for="m_square" class="form-label">Surface (in m<sup>2</sup>)</label>
                        <input type="number" class="form-control" name="m_square" id="m_square"
                            placeholder="Type the surface of your apartment in square meters"
                            class="form-control @error('m_square') is-invalid @enderror" value="{{ old('m_square') }}"
                            required min="10">
                        @error('m_square')
                            <div class="text-danger"> {{ $message }} </div>
                        @enderror
                    </div>
                </div>

                {{-- Row 4 --}}
                <div class="row row-cols-1">
                    {{-- Services --}}
                    <div class="col mb-3">
                        <label for="services" class="form-label d-block">Choose services:</label>
                        @foreach ($services as $service)
                            <div class="form-check form-check-inline">
                                <input class="form-check-input @error('services') is-invalid @enderror" type="checkbox"
                                    id="services-{{ $service->id }}" name="services[]" value="{{ $service->id }}"
                                    {{ in_array($service->id, old('services', [])) ? 'checked' : '' }}>
                                <label class="form-check-label"
                                    for="services-{{ $service->id }}">{{ $service->name }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Row 5 --}}
                <div class="row row-cols-2">
                    {{-- Description --}}
                    <div class="col mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="description" rows="4" placeholder="Type the description of your apartment"
                            class="form-control @error('description') is-invalid @enderror" required minlength="10" maxlength="1000">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="text-danger"> {{ $message }} </div>
                        @enderror
                    </div>

                    <div class="col">
                        <div class="row row-cols-2">
                            {{-- Cover Image --}}
                            <div class="col mb-3">
                                <label for="thumbnail" class="form-label">Select a picture for the cover image</label>
                                <input type="file" class="form-control" name="thumbnail" id="thumbnail"
                                    placeholder="insert a thumbnail"
                                    class="form-control @error('thumbnail') is-invalid @enderror" required>
                                @error('thumbnail')
                                    <div class="text-danger"> {{ $message }} </div>
                                @enderror
                            </div>

                            {{-- Gallery --}}
                            <div class="col mb-3">
                                <label for="gallery" class="form-label">Select some pictures for the gallery</label>
                                <input type="file" class="form-control" name="gallery[]" id="gallery"
                                    placeholder="Select multiple images" multiple
                                    class="form-control @error('gallery') is-invalid @enderror" required>
                                @error('gallery')
                                    <div class="text-danger"> {{ $message }} </div>
                                @enderror
                            </div>

                        </div>
                    </div>
                </div>

        </div>

        <div class="py-5">
            <button type="submit" class="btn btn-success">Insert</button>
            <a href="{{route('host.apartments.index')}}" class="btn btn-primary">Back to apartment list</a>
        </div>



        </form>



    </div>
    </div>
@endsection

@section('scripts')
    @vite(['resources/js/fetchDataTomTom.js'])
    <script>
        const tomtom_key = '{{ env('TOMTOM_KEY') }}';
    </script>
@endsection
