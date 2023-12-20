@extends('layouts.app')

@section('content')
    <div class="container">

        @include('../partials.session_message')


        <div class="py-3 d-flex justify-content-between align-items-center">

            <h1>{{ $apartment->title }} </h1>

            <div class="d-flex flex-wrap gap-3">
                <a href=" {{ route('host.apartments.edit', $apartment->slug) }} "
                    class="btn primary btn-dark flex-grow-1 flex-lg-grow-0">Edit</a>
                <a href="{{ route('host.sponsorship', $apartment->slug) }}"
                    class="btn primary btn-dark flex-grow-1 flex-lg-grow-0">Sponsorship</a>
            </div>

        </div>

        <div class="" role="alert" id="countdown">
            <div class="col-12" id="timer"></div>
        </div>


        <div class="row mb-4">

            <div class="col-md-8 col-12">
                <img src="{{ asset('storage/' . $apartment->thumbnail) }} " class="w-100 rounded-5">
            </div>
            {{-- /cover thumbnail --}}

            <div class="col-md-4 col-12 mt-md-0 mt-3">

                <div class="row row-cols-md-2 row-cols-3 g-3">

                    @forelse ($gallery as $gallery_image)
                        <div class="img-container position-relative img_overlay">
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

                <form autocomplete="off" action="{{ route('host.addImg') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="input-group mt-3">
                        <input type="hidden" name="apartment_code" value="{{ $apartment->apartment_code }}">
                        <input type="hidden" name="apartment_id" value="{{ $apartment->id }}">
                        <input type="file" name="img" id="img" class="form-control" required>
                        <button type="submit" class="btn bg_primary">
                            Add Image +
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="mb-4">
            <h4 class="mb-3">Basic informations</h4>
            <div class="row row-cols-lg-4 row-cols-md-2 row-cols-sm-2 row-cols-1 g-3">
                <div class="col d-flex justify-content-center">
                    <div class="fs-5 p-3 rounded-4 shadow-sm">
                        <i class="fa-solid fa-square primary"></i>
                        <span class="fw-medium ms-3 me-2">Rooms:</span>
                        <span>{{ $apartment->rooms }}</span>
                    </div>
                </div>
                <div class="col d-flex justify-content-center">
                    <div class="fs-5 p-3 rounded-4 shadow-sm">
                        <i class="fa-solid fa-bed primary"></i>
                        <span class="fw-medium ms-3 me-2">Beds:</span>
                        <span>{{ $apartment->beds }}</span>
                    </div>
                </div>
                <div class="col d-flex justify-content-center">
                    <div class="fs-5 p-3 rounded-4 shadow-sm">
                        <i class="fa-solid fa-bath primary"></i>
                        <span class="fw-medium ms-3 me-2">Bathrooms:</span>
                        <span>{{ $apartment->bathrooms }}</span>
                    </div>
                </div>
                <div class="col d-flex justify-content-center">
                    <div class="fs-5 p-3 rounded-4 shadow-sm">
                        <i class="fa-solid fa-ruler-combined primary"></i>
                        <span class="fw-medium ms-3 me-2">Surface:</span>
                        <span>{{ $apartment->m_square }} m<sup>2</sup></span>
                    </div>
                </div>

            </div>
        </div>

        <div class="mb-4">
            <h4 class="mb-3">Description</h4>
            <p class="mb-4">{{ $apartment->description }}</p>
        </div>




        <div class="mb-4">
            <div class="row align-items-center">
                <div class="col-12 col-lg-7">
                    <h4 class="mb-3">Services</h4>
                    <div class="d-flex gap-2 flex-wrap">
                        @forelse ($apartment->Services as $service)
                            <div class="badge bg_primary text-dark">
                                {{ $service->name }}
                            </div>
                        @empty
                            <div class="badge bg_primary text-dark">
                                No services
                            </div>
                        @endforelse

                    </div>
                </div>

                <div class="col-12 col-lg-5">
                    <div class="views text-center m-auto" style="width: 100%;">
                        <canvas id="singleApartmentViews" data-set="{{ json_encode($views) }}"></canvas>
                    </div>
                </div>
            </div>



        </div>

        <div class="py-5">

            <a href="{{ route('host.apartments.index') }}" class="btn primary btn-dark">Back to apartments List</a>


            {{--             <a href=" {{ route('partials.payment_form', $apartment->slug) }} " class="btn btn-outline-dark">Add
                Sponsorship</a> --}}

        </div>


    </div>
@endsection

@section('scripts')
    @vite(['resources/js/ChartSingle.js'])

    <script>
        const targhetTime = new Date('{{ $sponsored }}')
            .getTime(); //(year, monthIndex, day, hours, minutes, seconds, milliseconds)

        // genero il tempo rimanente in millisecondi
        const secondsMs = 1000;
        const minuteMs = secondsMs * 60;
        const hourMs = minuteMs * 60;
        const dayMs = hourMs * 24;

        const clock = setInterval(function() {

            // ottengo la data attuale in millisecondi e poi faccio la differenza
            const realTime = new Date().getTime();
            const milliSecTime = Number((targhetTime + hourMs) - realTime);

            if (milliSecTime > 0) {

                // calcolo la differernza e la divido a seconda di quello che mi occorre
                let secondsRemain = Math.floor((milliSecTime % minuteMs) / secondsMs);
                let minuteRemain = Math.floor((milliSecTime % hourMs) / minuteMs);
                let hourRemain = Math.floor((milliSecTime % dayMs) / hourMs);
                let dayRemain = Math.floor(milliSecTime / dayMs);


                //stampo in pagina il conto alla rovescia
                document.getElementById("countdown").classList.add('alert', 'alert-primary');
                document.getElementById("timer").innerHTML =
                    `Sponsored until:  
                    ${dayRemain < 1 ? ' ' : `${dayRemain} day${dayRemain < 1 ? '' : 's'},`}
                    ${hourRemain < 1 ? ' ' : `${hourRemain} hour${hourRemain < 1 ? '' : 's'},`}
                    ${minuteRemain < 1 ? ' ' : `${minuteRemain} minute${minuteRemain < 1 ? '' : 's'}.`}`

            } else {
                //quando scatta il timer fermo il loop e stampo in pagina
                clearInterval(clock);
                document.getElementById("countdown").remove();

            };
        }, 1000);
    </script>
@endsection
