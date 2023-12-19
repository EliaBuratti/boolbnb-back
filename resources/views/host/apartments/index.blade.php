@extends('layouts.app')

@section('content')
    <div class="container py-3">

        <div class="d-flex justify-content-between align-items-center py-4">
            <h1>My Apartments</h1>

            <a href="{{ route('host.apartments.create') }}" class="btn btn-dark primary">Add new apartment</a>

        </div>


        @include('../partials.session_message')


        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3">
            @forelse ($apartments as $apartment)
                <div class="col g-3 position-relative img_overlay">

                    <a href="{{ route('host.apartments.show', $apartment->slug) }}" class="">
                        <div class="my_card shadow {{in_array( $apartment->id, $sponsoredApartmentsIds) ? 'sponsored' : '' }}" >
                            <img class="image" src="{{ asset('storage/' . $apartment->thumbnail) }}" alt="">
                            <div class="my_card_content">
                                <h6 class="fw-semibold text-dark">{{ $apartment->title }}</h6>
                            </div>

                            <div class="sponsored_badge">
                                Sponsored
                            </div>
                        </div>
                    </a>
                    <div class="position-absolute top-0 right-0 d-flex gap-2 p-2">
                        <a href=" {{ route('host.apartments.edit', $apartment->slug) }} "
                            class="btn btn-warning btn btn-warning  img_modal rounded-4 d-flex justify-content-center align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" height="18" width="18"
                                viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.-->
                                <path fill="#ffffff"
                                    d="M441 58.9L453.1 71c9.4 9.4 9.4 24.6 0 33.9L424 134.1 377.9 88 407 58.9c9.4-9.4 24.6-9.4 33.9 0zM209.8 256.2L344 121.9 390.1 168 255.8 302.2c-2.9 2.9-6.5 5-10.4 6.1l-58.5 16.7 16.7-58.5c1.1-3.9 3.2-7.5 6.1-10.4zM373.1 25L175.8 222.2c-8.7 8.7-15 19.4-18.3 31.1l-28.6 100c-2.4 8.4-.1 17.4 6.1 23.6s15.2 8.5 23.6 6.1l100-28.6c11.8-3.4 22.5-9.7 31.1-18.3L487 138.9c28.1-28.1 28.1-73.7 0-101.8L474.9 25C446.8-3.1 401.2-3.1 373.1 25zM88 64C39.4 64 0 103.4 0 152V424c0 48.6 39.4 88 88 88H360c48.6 0 88-39.4 88-88V312c0-13.3-10.7-24-24-24s-24 10.7-24 24V424c0 22.1-17.9 40-40 40H88c-22.1 0-40-17.9-40-40V152c0-22.1 17.9-40 40-40H200c13.3 0 24-10.7 24-24s-10.7-24-24-24H88z" />
                            </svg>
                        </a>

                        <!-- Modal trigger button -->
                        <button type="button"
                            class="btn btn-danger img_modal rounded-4 d-flex justify-content-center align-items-center"
                            data-bs-toggle="modal" data-bs-target="#modalId-{{ $apartment->id }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                                class="bi bi-trash" viewBox="0 0 16 16">
                                <path
                                    d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                <path
                                    d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                            </svg>
                        </button>

                        <!-- Modal Body -->
                        <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                        <div class="modal fade" id="modalId-{{ $apartment->id }}" tabindex="-1" data-bs-backdrop="static"
                            data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId-{{ $apartment->id }}"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                role="document">

                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 class="modal-title d-flex justify-content-center align-items-center gap-3 w-100"
                                            id="modalTitleId-{{ $apartment->id }}">
                                            <i class="fa-solid fa-triangle-exclamation text-warning"></i> Warning <i
                                                class="fa-solid fa-triangle-exclamation text-warning"></i>
                                        </h5>
                                    </div>
                                    {{-- /.modal-header --}}

                                    <div class="modal-body text-center">
                                        Are you sure to delete?
                                    </div>
                                    {{-- /.modal-body --}}

                                    <div class="modal-footer d-flex justify-content-center align-items-center gap-3">

                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>

                                        <form action="{{ route('host.apartments.destroy', $apartment->slug) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>

                                        </form>

                                    </div>
                                    {{-- /.modal-footer --}}

                                </div>
                                {{-- /.modal-content --}}

                            </div>
                            {{-- /.modal-dialog --}}

                        </div>
                        {{-- /.modal --}}
                    </div>




                </div>
            @empty
                <h1>no apartments</h1>
            @endforelse

        </div>
        {{-- /.row --}}
        <div class="pt-4"> {{ $apartments->links('pagination::bootstrap-5') }} </div>
    </div>
@endsection
