@extends('layouts.app')

@section('content')
    <div class="container py-3">
        
        @include('../partials.session_message')

        <a href="{{route('host.apartments.create')}}" class="btn btn-primary mt-5">Crea un nuovo appartamento</a>


        <div class="row">
            @forelse ($apartments as $apartment)
                <div class="col-4 g-3">
                    <div class="card shadow h-100">
                        <div class="h-20 card-header ">
                            <h3>{{ $apartment->title }}</h3>
                        </div>
                        <div class="card-body">
                            <img class="img-fluid rounded-4 card-thumbnail"
                                src="{{ asset('storage/' . $apartment->thumbnail) }}" alt="">
                        </div>
                        <div class="card-footer">
                            <h6>{{ $apartment->city }} - {{ $apartment->address }}</h6>
                            <a href="{{ route('host.apartments.show', $apartment->slug) }}" class="btn btn-primary">show</a>
                            <a href=" {{ route('host.apartments.edit', $apartment->slug) }} "
                                class="btn btn-warning">Edit</a>

                            <!-- Modal trigger button -->
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalId-{{$apartment->id}}">
                                Delete
                            </button>

                            <!-- Modal Body -->
                            <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                            <div class="modal fade" id="modalId-{{$apartment->id}}" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId-{{$apartment->id}}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">

                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h5 class="modal-title d-flex justify-content-center align-items-center gap-3 w-100" id="modalTitleId-{{$apartment->id}}">
                                                <i class="fa-solid fa-triangle-exclamation text-warning"></i> Warning <i class="fa-solid fa-triangle-exclamation text-warning"></i>
                                            </h5>
                                        </div>
                                        {{-- /.modal-header --}}

                                        <div class="modal-body text-center">
                                            Are you sure to delete?
                                        </div>
                                        {{-- /.modal-body --}}

                                        <div class="modal-footer d-flex justify-content-center align-items-center gap-3">

                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                            <form action="{{ route('host.apartments.destroy', $apartment->slug) }}" method="POST">
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
                </div>
            @empty
                <h1>no apartments</h1>
            @endforelse
        </div>
    </div>
@endsection
