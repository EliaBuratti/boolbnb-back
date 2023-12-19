@extends('layouts.app')

@section('content')

    <div class="container">

        @include('../partials.errors')
        
        <h2 class="py-4">Edit this apartment</h2>

        <form action="{{ route('host.apartments.update', $apartment) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            {{-- Row 1 --}}
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 g-5">

                {{-- Title --}}
                <div class="col">

                    <label for="title" class="form-label">Apartment Title</label>

                    <input type="text" class="form-control" name="title" id="title" aria-describedby="helpTitle"
                        placeholder="{{ old('title', $apartment->title) }}"
                        value="{{ old('title', $apartment->title) }}">

                    <small id="helpTitle" class="form-text text-muted">
                        Insert a title for your apartment
                    </small>

                    @error('title')
                        <div class="text-danger"> {{$message}} </div>
                    @enderror
                </div>

                {{-- Nation --}}
                <div class="col">

                    <label for="nation" class="form-label">Nation</label>

                    <select class="form-select" name="nation" id="nation">

                        <option disabled selected>Select your nation</option>

                        @foreach ($countries as $country)
                            <option value="{{ $country['name'] }}  - {{ $country['code'] }}"
                                {{ Str::contains($apartment->nation, $country['name']) ? 'selected' : '' }}>
                                {{ $country['name'] }} - {{ $country['code'] }}
                            </option>
                        @endforeach

                    </select>
                    
                    <small id="helpTitle" class="form-text text-muted">
                        Insert the nation
                    </small>

                    @error('nation')
                        <div class="text-danger"> {{$message}} </div>
                    @enderror

                </div>

                {{-- Address --}}
                <div class="col position-relative">

                    <label for="address" class="form-label">Address</label>
                    
                    <input type="text" id="address" name="address"
                        value="{{ old('address', $apartment->address) }}" class="form-control"
                        placeholder="{{ $apartment->address }}" aria-describedby="helpTitle">

                    <ul id="search-results" class="w-100 p-0 position-absolute top-100 left-0 bg-white"></ul>

                    <small id="helpAdress" class="form-text text-muted">Insert your address</small>

                    @error('address')
                        <div class="text-danger"> {{$message}} </div>
                    @enderror

                </div>

                {{-- Beds --}}
                <div class="col">

                    <label for="beds" class="form-label">Beds</label>

                    <input type="number" class="form-control" name="beds" id="beds" aria-describedby="helpBeds"
                        placeholder="{{ $apartment->beds }}" value="{{ old('beds', $apartment->beds) }}">

                    <small id="helpBeds" class="form-text text-muted">
                        How many people can sleep here?
                    </small>

                    @error('beds')
                        <div class="text-danger"> {{$message}} </div>
                    @enderror

                </div>

                {{-- Rooms --}}
                <div class="col">

                    <label for="rooms" class="form-label">Rooms</label>

                    <input type="number" class="form-control" name="rooms" id="rooms"
                        aria-describedby="helpRooms" placeholder="{{ $apartment->rooms }}"
                        value="{{ old('rooms', $apartment->rooms) }}">

                    <small id="helpRooms" class="form-text text-muted">Insert rooms number</small>
                    
                    @error('rooms')
                        <div class="text-danger"> {{$message}} </div>
                    @enderror

                </div>

                {{-- Bathrooms --}}
                <div class="col">

                    <label for="bathrooms" class="form-label">Bathrooms</label>

                    <input type="number" class="form-control" name="bathrooms" id="bathrooms"
                        aria-describedby="helpBathroom" placeholder="{{ $apartment->bathrooms }}"
                        value="{{ old('bathrooms', $apartment->bathrooms) }}">

                    <small id="helpBathroom" class="form-text text-muted">Insert bathroom in your house</small>

                    @error('bathrooms')
                        <div class="text-danger"> {{$message}} </div>
                    @enderror

                </div>

                {{-- Square Meters --}}
                <div class="col">

                    <label for="m_square" class="form-label">Surface (in m<sup>2</sup>)</label>

                    <input type="number" class="form-control" name="m_square" id="m_square"
                        aria-describedby="helpMSquare" placeholder="{{ $apartment->m_square }}"
                        value="{{ old('m_square', $apartment->m_square) }}">

                    <small id="helpMSquare" class="form-text text-muted">
                        Insert square meters of your apartaments
                    </small>

                    @error('m_square')
                        <div class="text-danger"> {{$message}} </div>
                    @enderror
                </div>
                
                {{-- Thumbnail --}}
                <div class="col">

                    <label for="thumbnail" class="form-label">Select the cover image</label>

                    <input type="file" class="form-control" name="thumbnail" id="thumbnail"
                        placeholder="Insert a cover image" aria-describedby="thumbHelpID">

                    <div id="thumbHelpID" class="form-text">
                        Insert a picture for your apartment thumbnail
                    </div>

                    @error('thumbnail')
                        <div class="text-danger"> {{$message}} </div>
                    @enderror

                </div>

                {{-- Visibility --}}
                <div class="col">

                    <div class="pb-2">Set visibility</div>

                    <div class="form-check form-check-inline">
                        
                        <input class="form-check-input" aria-describedby="visible_true_HelpID" type="radio" name="visible" id="visible_true" value="1" class="form-control @error('visible') is-invalid @enderror" {{ $apartment->visible === 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="visible_true">Visible</label>
                            
                    </div>

                    <div class="form-check form-check-inline">

                        <input class="form-check-input" aria-describedby="visible_false_HelpID" type="radio" name="visible" id="visible_false" value="0" class="form-control @error('visible') is-invalid @enderror"  {{ $apartment->visible === 0 ? 'checked' : '' }}>
                        <label class="form-check-label" for="visible_false">Not visible</label>
                        
                    </div>
    
                    @error('visible')
                        <div class="text-danger"> {{$message}} </div>
                    @enderror
                    
                </div>
                
            </div>
            {{-- FINE PRIMA ROW --}}

            <div class="row">

                {{-- Description --}}
                <div class="col-12 col-lg-5 py-5">
    
                    <label for="description" class="form-label">Description</label>
    
                    <textarea class="form-control" name="description" id="description" rows="4">{{ old('description', $apartment->description) }}</textarea>
    
                    @error('description')
                        <div class="text-danger"> {{$message}} </div>
                    @enderror
    
                </div>

                {{-- Services --}}
                <div class="col-12 col-lg-7">
    
                    <label for="services" class="form-label d-block text-center">Choose services:</label>
                
                    <div class="row">
                        @foreach ($services as $service)
                        
                        @if ($errors->any())
        
                            <div class="col-6 col-md-3 col-lg-4 form-check form-check-inline me-0">
        
                                <input class="form-check-input" type="checkbox" id="services-{{ $service->id }}" name="services[]" value="{{ $service->id }}" {{ in_array($service->id, old('services', [])) ? 'checked' : '' }}>
        
                                <label class="form-check-label" for="services-{{ $service->id }}">
                                    {{ $service->name }}
                                </label>
        
                            </div>
                    
                        @else
                        
                        <div class="col-6 col-md-3 col-lg-4 form-check form-check-inline me-0">
                            
                            <input class="form-check-input" type="checkbox" id="services-{{ $service->id }}" name="services[]"
                            value="{{ $service->id }}"
                            {{ $apartment->services->contains($service) ? 'checked' : '' }}>
                            
                            <label class="form-check-label" for="services-{{ $service->id }}">
                                {{ $service->name }}
                            </label>
                            
                        </div>
                        
                        @endif
                        @endforeach
                                            
                    </div>
                </div>
    
            </div>
            {{-- FINE SECONDA ROW --}}

            <div class="py-3 d-flex flex-wrap gap-4">
                <button type="submit" class="btn btn-dark primary flex-grow-1 flex-lg-grow-0">Update</button>
                <a href="{{ route('host.apartments.show', $apartment->slug) }}" class="btn  btn-dark primary flex-grow-1 flex-lg-grow-0">Back to show</a>
                <a href="{{route('host.apartments.index')}}" class="btn btn-dark primary flex-grow-1 flex-lg-grow-0">Back to apartment list</a>
            </div>
        </form>

        
    </div>

    {{-- /.container --}}
@endsection

@section('scripts')
    @vite(['resources/js/fetchDataTomTom.js'])
    <script>
        const tomtom_key = '{{ env('TOMTOM_KEY') }}';
    </script>
@endsection
