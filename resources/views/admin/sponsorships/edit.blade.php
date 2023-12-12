@extends('layouts.app')

@section('content')

    <section class="create col-10 mx-auto">
        <div class="container">

        @include('../partials.errors')
            

            <div class="py-4">
                <h2 class="text-muted text-uppercase">Edit sponsorship: {{ $sponsorship->name }}</h2>
            </div>


            <form action=" {{ route('admin.sponsorships.update', $sponsorship) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row row-cols-1 row-cols-md-3 g-5">

                    <div class="col">
                        <div>
                            <label for="name" class="form-label">Sponsorship Name</label>
                            <input type="text" name="name" id="name"
                                class="form-control @error('name') is-invalid @enderror" placeholder=""
                                aria-describedby="helpId" value=" {{ old('name', $sponsorship->name) }}" required>
                            <small id="nameHelper" class="text-muted">Edit Name</small>
                            @error('name')
                                <div class="text-danger"> {{ $message }} </div>
                            @enderror
                        </div>
                    </div>
                    <!-- /.col -->

                    <div class="col">
                        <div>
                            <label for="price" class="form-label">Sponsorship price</label>
                            <input type="number" step=".01" min=1 max=999.99 name="price" id="price"
                                class="form-control @error('price') is-invalid @enderror" placeholder=""
                                aria-describedby="helpId"
                                value="{{ old('price') != '' ? old('price') : $sponsorship->price }}">
                            <small id="priceHelper" class="text-muted">Edit Price</small>
                            @error('price')
                                <div class="text-danger"> {{ $message }} </div>
                            @enderror
                        </div>
                    </div>
                    <!-- /.col -->

                    <div class="col">
                        <div>
                            <label for="duration" class="form-label">Sponsorship duration</label>
                            {{--                             <input type="time" name="duration" id="duration"
                                class="form-control @error('duration') is-invalid @enderror" placeholder=""
                                aria-describedby="helpId"
                                value="{{ old('duration') != '' ? old('duration') : $sponsorship->duration }}"> --}}
                            <input type="text" pattern="^([0-9]+):([0-5][0-9]):([0-5][0-9])$"
                                class="form-control @error('duration') is-invalid @enderror" name="duration" id="duration"
                                aria-describedby="timeHelper" placeholder="Hour : Minute : Seceonds"
                                value="{{ old('duration') != '' ? old('duration') : $sponsorship->duration }}">
                            <small id="durationHelper" class="text-muted">Edit Duration</small>
                            @error('duration')
                                <div class="text-danger"> {{ $message }} </div>
                            @enderror
                        </div>
                    </div>
                    <!-- /.col -->
                </div>

                <button type="submit" class="btn btn-primary">Update</button>

            </form>
        </div>
    </section>


@endsection
