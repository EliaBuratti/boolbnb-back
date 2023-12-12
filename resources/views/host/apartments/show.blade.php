@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="mt-3 p-5 pt-1 mb-4 bg-light rounded-3">
                <div class="row">

                    <div class="col-7">
                        <div class="container-fluid pt-1">

                            <a href="{{ route('host.apartments.index') }}" class="btn btn-primary">Apartments List</a>

                            <h1 class="display-5 fw-bold">{{ $apartment->title }}</h1>
                            <img class="img-fluid rounded-4" src="{{ asset('storage/' . $apartment->thumbnail) }} "
                                alt="">
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="row">
                            @forelse ($gallery as $gallery_image)
                                <div class="col-6 g-2">
                                    <img class="img-fluid rounded-4" src="{{ asset('storage/' . $gallery_image->img) }} "
                                        alt="">
                                    <div class="img_overlay">
                                        <!-- Modal trigger button -->
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#modalId-{{ $gallery_image->id }}">
                                            Delete
                                            {{ var_dump($gallery_image->id) }}
                                        </button>

                                        <!-- Modal Body -->
                                        <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                        <div class="modal fade" id="modalId-{{ $gallery_image->id }}" tabindex="-1"
                                            data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                            aria-labelledby="modalTitle-{{ $gallery_image->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                                role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalTitleId-{{ $gallery_image->id }}">
                                                            {{ $gallery_image->id }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Warning! Are you sure to delete this image??
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">No!</button>
                                                        <form action="{{ route('host.deleteImg', $gallery_image->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Yes!</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <h4>no gallery here!</h4>
                            @endforelse
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="d-flex gap-2">
                            <span>Services:</span>
                            <ul class="list-unstyled">
                                @forelse ($apartment->Services as $service)
                                    <li class="badge bg-primary">
                                        <i class="fas fa-tag fa-xs fa-fw" aria-hidden="true"></i>
                                        {{ $service->name }}
                                    </li>
                                @empty
                                    <li class="badge bg-primary">No services</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="container-fluid mt-3">
                    <p class="col-md-8 fs-4">{{ $apartment->description }}</p>

                </div>
            </div>
        </div>
    </div>
@endsection
