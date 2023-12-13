@extends('layouts.app')

@section('content')
    <div class="container">

        @include('../partials.session_message')

        <div class="mt-3 p-5 pt-1 mb-4 bg-light rounded-3">
            <div class="row">

                <div class="col-12">


                    <a href="{{ route('host.apartments.index') }}" class="btn btn-primary">Apartments List</a>

                    <h1 class="display-5 fw-bold">{{ $apartment->title }}</h1>

                </div>
                <div class="container-fluid pt-1 col-7">
                    <img class="img-fluid rounded-4 h-100" src="{{ asset('storage/' . $apartment->thumbnail) }} "
                        alt="">
                </div>
                <div class="col-5">
                    <div class="row">
                        @forelse ($gallery as $gallery_image)
                            <div class="col-6 g-2 position-relative img_overlay">
                                <img class="img-fluid rounded-4 " src="{{ asset('storage/' . $gallery_image->img) }} "
                                    alt="">
                                <div class="">
                                    <!-- Modal trigger button -->
                                    <button type="button"
                                        class="btn btn-danger position-absolute bottom-0 left-0 img_modal rounded-4 m-3"
                                        data-bs-toggle="modal" data-bs-target="#modalId-{{ $gallery_image->id }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                            <path
                                                d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                            <path
                                                d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                        </svg>
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
                                                        <strong>Attention!!</strong>
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure to delete this image??
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


                <div class="col-12 d-flex justify-content-between pe-0 align-items-center">
                    <div class="d-flex gap-2 col-5 align-items-center">
                        <span>Services:</span>
                        <ul class="list-unstyled m-0">
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

                    <div class="col-5">
                        <form autocomplete="off" action="{{ route('host.addImg') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="input-group mt-3">
                                <input type="hidden" name="apartment_code" value="{{ $apartment->apartment_code }}">
                                <input type="hidden" name="apartment_id" value="{{ $apartment->id }}">
                                <input type="file" name="img" id="img" class="form-control" required>
                                <button type="submit" class="btn btn-primary">
                                    Add Image +
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="container-fluid mt-3">
                <p class="col-md-8 fs-4">{{ $apartment->description }}</p>

                <a href=" {{ route('host.apartments.edit', $apartment->slug) }} " class="btn btn-warning">Edit</a>

            </div>
        </div>
        <div class="col-4">
            @include('../partials.payment_form')
        </div>
    </div>
@endsection
