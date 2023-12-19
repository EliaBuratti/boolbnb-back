@extends('layouts.app')

@section('content')

    <div class="container">

        @include('../partials.errors')

        <h2 class="py-4">Create a new apartment</h2>

        <form action="{{ route('host.apartments.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            {{-- Row 1 --}}
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 g-5">

                {{-- Title --}}
                <div class="col">

                    <label for="title" class="form-label">Apartment Title</label>

                    <input type="text" class="form-control" name="title" id="title"
                        placeholder="Type the title"
                        class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required
                        minlength="5" maxlength="100">

                    @error('title')
                        <div class="text-danger"> {{ $message }} </div>
                    @enderror

                </div>          
            
                {{-- Nation --}}
                <div class="col">
                    
                    <label for="nation" class="form-label">Nation</label>

                    <select class="form-select" name="nation" id="nation" required>
                        
                        <option disabled selected>Select the nation</option>

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
                <div class="col position-relative">

                    <label for="address" class="form-label">Address</label>

                    <input type="text" id="address" name="address" class="form-control"
                        placeholder="Type the address"
                        class="form-control @error('address') is-invalid @enderror" value="{{ old('address') }}"
                        required>

                    <ul id="search-results" class="w-100 p-0 position-absolute top-100 left-0 bg-white z-2"></ul>
                    
                    @error('address')
                        <div class="text-danger"> {{ $message }} </div>
                    @enderror

                </div>
            
                {{-- Beds --}}
                <div class="col">

                    <label for="beds" class="form-label">Beds</label>

                    <input type="number" class="form-control" name="beds" id="beds"
                        placeholder="Number of beds"
                        class="form-control @error('beds') is-invalid @enderror" value="{{ old('beds') }}" required
                        min="1" max="25">

                    @error('beds')
                        <div class="text-danger"> {{ $message }} </div>
                    @enderror

                </div>

                {{-- Rooms --}}
                <div class="col">

                    <label for="rooms" class="form-label">Rooms</label>

                    <input type="number" class="form-control" name="rooms" id="rooms"
                        placeholder="Number of rooms"
                        class="form-control @error('rooms') is-invalid @enderror" value="{{ old('rooms') }}" required
                        min="1" max="25">
                        
                    @error('rooms')
                        <div class="text-danger"> {{ $message }} </div>
                    @enderror

                </div>

                {{-- Bathrooms --}}
                <div class="col">

                    <label for="bathrooms" class="form-label">Bathrooms</label>

                    <input type="number" class="form-control" name="bathrooms" id="bathrooms"
                        placeholder="Number of bathrooms"
                        class="form-control @error('bathrooms') is-invalid @enderror" value="{{ old('bathrooms') }}"
                        required min="1" max="25">

                    @error('bathrooms')
                        <div class="text-danger"> {{ $message }} </div>
                    @enderror

                </div>

                {{-- Square Meters --}}
                <div class="col">

                    <label for="m_square" class="form-label">Surface (in m<sup>2</sup>)</label>

                    <input type="number" class="form-control" name="m_square" id="m_square"
                        placeholder="Surface in square meters"
                        class="form-control @error('m_square') is-invalid @enderror" value="{{ old('m_square') }}"
                        required min="10">

                    @error('m_square')
                        <div class="text-danger"> {{ $message }} </div>
                    @enderror

                </div>
                
                {{-- Cover Image --}}
                <div class="col">

                    <label for="thumbnail" class="form-label">Select the cover image</label>

                    <input type="file" class="form-control" name="thumbnail" id="thumbnail"
                        placeholder="insert a cover image"
                        class="form-control @error('thumbnail') is-invalid @enderror" required>

                    @error('thumbnail')
                        <div class="text-danger"> {{ $message }} </div>
                    @enderror

                </div>

                {{-- Gallery --}}
                <div class="col">

                    <label for="gallery" class="form-label">Select pictures for the gallery</label>

                    <input type="file" class="form-control" name="gallery[]" id="gallery"
                        placeholder="Select multiple images" multiple
                        class="form-control @error('gallery') is-invalid @enderror" required>

                    @error('gallery')
                        <div class="text-danger"> {{ $message }} </div>
                    @enderror

                </div>

                {{-- Visibility --}}
                <div class="col">
                    <div>Do you want to make it immediately visible?</div>

                    <div class="m-3 form-check form-check-inline">

                        <input class="form-check-input" aria-describedby="visible_true_HelpID" type="radio"
                            name="visible" id="visible_true" value="1"
                            class="form-control @error('visible') is-invalid @enderror" checked>

                        <label class="form-check-label" for="visible_true">Yes</label>

                    </div>

                    <div class="form-check form-check-inline">

                        <input class="form-check-input" aria-describedby="visible_false_HelpID" type="radio"
                            name="visible" id="visible_false" value="0"
                            class="form-control @error('visible') is-invalid @enderror" checked>

                        <label class="form-check-label" for="visible_false">No</label>

                    </div>

                    @error('visible')
                        <div class="text-danger"> {{ $message }} </div>
                    @enderror

                </div>

            </div>
            {{-- /FINE PRIMA ROW --}}
            

            <div class="row">

                {{-- Description --}}
                <div class="col-12 col-lg-5">

                    <label for="description" class="form-label">Description</label>

                    <textarea class="form-control" name="description" id="description" rows="4" placeholder="Type the description of your apartment"
                        class="form-control @error('description') is-invalid @enderror" required minlength="10" maxlength="1000">{{ old('description') }}</textarea>

                    @error('description')
                        <div class="text-danger"> {{ $message }} </div>
                    @enderror

                </div>

                {{-- Services --}}
                <div class="col-12 col-lg-7">

                    <label for="services" class="form-label d-block text-center">Choose services:</label>

                    <div class="row">
                        @foreach ($services as $service)
    
                            <div class="col-6 col-md-3 col-lg-4 form-check form-check-inline me-0">
    
                                <input class="form-check-input @error('services') is-invalid @enderror" type="checkbox"
                                    id="services-{{ $service->id }}" name="services[]" value="{{ $service->id }}"
                                    {{ in_array($service->id, old('services', [])) ? 'checked' : '' }}>
    
                                <label class="form-check-label" for="services-{{ $service->id }}">
                                    {{ $service->name }}
                                </label>
    
                            </div>
    
                        @endforeach

                    </div>

                </div>

            </div>
            {{-- /FINE SECONDA ROW--}}
                
            <div class="py-3 d-flex flex-wrap gap-4">

                <button type="submit" class="btn btn-dark primary flex-grow-1 flex-lg-grow-0">Insert</button>

                <a href="{{route('host.apartments.index')}}" class="btn btn-dark primary flex-grow-1 flex-lg-grow-0">Back to apartment list</a>

            </div>

        </form>

    </div>

@endsection

@section('scripts')
    @vite(['resources/js/fetchDataTomTom.js'])
    <script>
        const tomtom_key = '{{ env('TOMTOM_KEY') }}';
    </script>
@endsection
