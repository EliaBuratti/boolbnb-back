@extends('layouts.app')

@section('content')
    <div class="container">
        
        @include('../partials.errors')

        <div class="row mt-4">
            <div class="col-6 text-center m-auto">
                <h4>edit "{{ $service->name }}"</h4>
                <form action="{{ route('admin.services.update', $service) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <input type="text" class="form-control" name="name" id="name" aria-describedby="helpId"
                            placeholder="{{ $service->name }}">
                        <small id="helpId" class="form-text text-muted">edit service</small>
                    </div>

                    <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
    </div>
@endsection
