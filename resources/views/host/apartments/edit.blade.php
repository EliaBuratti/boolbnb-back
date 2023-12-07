@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">


                <form action="{{ route('host.apartments.update', $apartment) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="title" class="form-label">Apartment Title</label>
                        <input type="text" class="form-control" name="name" id="name" aria-describedby="helpTitle"
                            placeholder="{{ old('title', $apartment->title) }}"
                            value="{{ old('title', $apartment->title) }}">
                        <small id="helpTitle" class="form-text text-muted">insert a fascinating title for your
                            apartment</small>
                    </div>

                    <div class="mb-3">
                        <label for="nation" class="form-label">Nation</label>
                        <select class="form-select form-select-lg" name="nation" id="nation">
                            <option disabled selected>Select your country</option>
                            @foreach ($countries as $country)
                            
                                <option value="{{ $country['name'] }}"
                                    {{ $country['name'] == $apartment->nation ? 'selected' : '' }}>{{ $country['name'] }} -

                                    {{ $country['code'] }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="city" class="form-label">City</label>
                        <input type="text" class="form-control" name="city" id="city" aria-describedby="helpCity"
                            placeholder="{{ $apartment->city }}" value="{{ old('city', $apartment->city) }}">
                        >
                        <small id="helpCity" class="form-text text-muted">insert the city of the apartament</small>
                    </div>

                    <div class="mb-3">
                        <label for="postal_code" class="form-label">Postal Code</label>
                        <input type="number" class="form-control" name="postal_code" id="postal_code"
                            aria-describedby="helpPostalCode" placeholder="{{ $apartment->postal_code }}"
                            value="{{ old('postal_code', $apartment->postal_code) }}">
                        <small id="helpPostalCode" class="form-text text-muted">insert postal code</small>
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" name="address" id="address"
                            aria-describedby="helpAdress" placeholder="{{ $apartment->address }}"
                            value="{{ old('address', $apartment->address) }}">
                        <small id="helpAdress" class="form-text text-muted">insert your address</small>
                    </div>

                    <div class="mb-3">
                        <label for="rooms" class="form-label">Rooms</label>
                        <input type="number" class="form-control" name="rooms" id="rooms"
                            aria-describedby="helpRooms" placeholder="{{ $apartment->rooms }}"
                            value="{{ old('rooms', $apartment->rooms) }}">
                        <small id="helpRooms" class="form-text text-muted">insert rooms number</small>
                    </div>

                    <div class="mb-3">
                        <label for="bathrooms" class="form-label">Bathrooms</label>
                        <input type="number" class="form-control" name="bathrooms" id="bathrooms"
                            aria-describedby="helpBathroom" placeholder="{{ $apartment->bathrooms }}"
                            value="{{ old('bathrooms', $apartment->bathrooms) }}">
                        <small id="helpBathroom" class="form-text text-muted">insert bathroom in your house</small>
                    </div>

                    <div class="mb-3">
                        <label for="beds" class="form-label">Beds</label>
                        <input type="number" class="form-control" name="beds" id="beds" aria-describedby="helpBeds"
                            placeholder="{{ $apartment->beds }}" value="{{ old('beds', $apartment->beds) }}"> <small
                            id="helpBeds" class="form-text text-muted">how many people can sleep here?</small>
                    </div>

                    <div class="mb-3">
                        <label for="m_square" class="form-label">M<sup>2</sup></label>
                        <input type="number" class="form-control" name="m_square" id="m_square"
                            aria-describedby="helpMSquare" placeholder="{{ $apartment->m_square }}"
                            value="{{ old('m_square', $apartment->m_square) }}">
                        <small id="helpMSquare" class="form-text text-muted">insert square meters of your
                            apartaments</small>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="description" rows="4">{{ old('description', $apartment->description) }}"</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="thumbnail" class="form-label">Select a picture for the thumb</label>
                        <input type="file" class="form-control" name="thumbnail" id="thumbnail"
                            placeholder="insert a thumbnail" aria-describedby="thumbHelpID">
                        <div id="thumbHelpID" class="form-text">insert a picture for your apartment thumbnail</div>
                    </div>


                    <button type="submit" class="btn btn-success">Update</button>


                </form>


            </div>
        </div>
    </div>
@endsection
