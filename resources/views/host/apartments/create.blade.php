@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">

                <form autocomplete="off" action="{{ route('host.apartments.store') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="title" class="form-label">Apartment Title</label>
                        <input type="text" class="form-control" name="title" id="title"
                            aria-describedby="helpTitle" placeholder="your apartment title">
                        <small id="helpTitle" class="form-text text-muted">insert a fascinating title for your
                            apartment</small>
                    </div>

                    <div class="mb-3">
                        <label for="nation" class="form-label">Nation</label>
                        <select class="form-select form-select-lg" name="nation" id="nation">
                            <option disabled selected>Select your country</option>
                            @foreach ($countries as $country)
                                <option value="{{ $country['name'] }} - {{ $country['code'] }}">
                                    {{ $country['name'] }} - {{ $country['code'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>


                    <div class="mb-3 position-relative">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" id="address" name="address" class="form-control"
                            placeholder="insert your address" aria-describedby="helpTitle">
                        <ul id="search-results" class="w-100 p-0 position-absolute top-100 left-0 bg-white"></ul>
                        <small id="helpAdress" class="form-text text-muted">insert your address</small>
                    </div>
                    <div id="options"></div>
                    <div class="mb-3">
                        <label for="rooms" class="form-label">Rooms</label>
                        <input type="number" class="form-control" name="rooms" id="rooms"
                            aria-describedby="helpRooms" placeholder="rooms number">
                        <small id="helpRooms" class="form-text text-muted">insert rooms number</small>
                    </div>

                    <div class="mb-3">
                        <label for="bathrooms" class="form-label">Bathrooms</label>
                        <input type="number" class="form-control" name="bathrooms" id="bathrooms"
                            aria-describedby="helpBathroom" placeholder="insert bathrooms number">
                        <small id="helpBathroom" class="form-text text-muted">insert bathroom in your house</small>
                    </div>

                    <div class="mb-3">
                        <label for="beds" class="form-label">Beds</label>
                        <input type="number" class="form-control" name="beds" id="beds" aria-describedby="helpBeds"
                            placeholder="beds in the apartment">
                        <small id="helpBeds" class="form-text text-muted">how many people can sleep here?</small>
                    </div>

                    <div class="mb-3">
                        <label for="m_square" class="form-label">M<sup>2</sup></label>
                        <input type="number" class="form-control" name="m_square" id="m_square"
                            aria-describedby="helpMSquare" placeholder="square meters">
                        <small id="helpMSquare" class="form-text text-muted">insert square meters of your
                            apartaments</small>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="description" rows="4"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="thumbnail" class="form-label">Select a picture for the cover image</label>
                        <input type="file" class="form-control" name="thumbnail" id="thumbnail"
                            placeholder="insert a thumbnail" aria-describedby="thumbHelpID">
                        <div id="thumbHelpID" class="form-text">insert a picture for your apartment thumbnail</div>
                    </div>
                    <div class="mb-3">
                        <label for="gallery" class="form-label">Select a pictures for the gallery</label>
                        <input type="file" class="form-control" name="gallery[]" id="gallery"
                            placeholder="Select multiple images" aria-describedby="thumbHelpID" multiple>
                        <div id="thumbHelpID" class="form-text">insert a pictures for your apartment!</div>
                    </div>


                    <button type="submit" class="btn btn-success">Insert</button>



                </form>


            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @vite(['resources/js/fetchDataTomTom.js'])
    <script>
        const tomtom_key = '{{env('TOMTOM_KEY')}}';
    </script>
@endsection
