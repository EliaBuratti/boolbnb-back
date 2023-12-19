@extends('layouts.app')

@section('content')
    <div class="container">

        @include('../partials.errors')

        <h1 class="pt-3">TRASH</h1>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Apartment Name</th>
                        <th>Deleted</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($trash_apartments as $apartment)
                        <tr class="">
                            <td scope="row">{{ $apartment->title }}</td>
                            <td scope="row">{{ $apartment->deleted_at->format('d-m-Y H:m') }}</td>
                            <td scope="row">

                                <div class="actions d-flex gap-2">

                                    <div class="restore">

                                        <button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                                            data-bs-target="#modalId-restore-{{ $apartment->id }}">
                                            Restore
                                        </button>


                                        <!-- Modal Body -->
                                        <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                        <div class="modal fade" id="modalId-restore-{{ $apartment->id }}" tabindex="-1"
                                            data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                            aria-labelledby="modalTitleId-{{ $apartment->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                                role="document">

                                                <div class="modal-content">

                                                    <div class="modal-header">
                                                        <h5 class="modal-title d-flex justify-content-center align-items-center gap-3 w-100"
                                                            id="modalTitleId-{{ $apartment->id }}">
                                                            <i class="fa-solid fa-triangle-exclamation text-warning"></i>
                                                            Warning <i
                                                                class="fa-solid fa-triangle-exclamation text-warning"></i>
                                                        </h5>
                                                    </div>
                                                    {{-- /.modal-header --}}

                                                    <div class="modal-body text-center">
                                                        Are you sure to restore?
                                                    </div>
                                                    {{-- /.modal-body --}}

                                                    <div
                                                        class="modal-footer d-flex justify-content-center align-items-center gap-3">

                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>

                                                        <form
                                                            action="{{ route('host.restore', ['apartments' => $apartment->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')

                                                            <button type="submit" class="btn btn-success">Restore</button>
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
                                    <div class="delete">

                                        <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                                            data-bs-target="#modalId-delete-{{ $apartment->id }}">
                                            Delete
                                        </button>


                                        <!-- Modal Body -->
                                        <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                        <div class="modal fade" id="modalId-delete-{{ $apartment->id }}" tabindex="-1"
                                            data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                            aria-labelledby="modalTitleId-{{ $apartment->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                                role="document">

                                                <div class="modal-content">

                                                    <div class="modal-header">
                                                        <h5 class="modal-title d-flex justify-content-center align-items-center gap-3 w-100"
                                                            id="modalTitleId-{{ $apartment->id }}">
                                                            <i class="fa-solid fa-triangle-exclamation text-warning"></i>
                                                            Warning <i
                                                                class="fa-solid fa-triangle-exclamation text-warning"></i>
                                                        </h5>
                                                    </div>
                                                    {{-- /.modal-header --}}

                                                    <div class="modal-body">
                                                        Are you sure to delete? Irreversible action.
                                                    </div>
                                                    {{-- /.modal-body --}}

                                                    <div
                                                        class="modal-footer d-flex justify-content-center align-items-center gap-3">

                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>

                                                        <form
                                                            action="{{ route('host.forceDelete', ['apartments' => $apartment->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Confirm</button>
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
                            </td>
                        </tr>
                    @empty
                        <tr class="">
                            <td scope="row" colspan="4">No apartment trashed</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pt-4"> {{ $trash_apartments->links('pagination::bootstrap-5') }} </div>


        <a href="{{ url('/') }}" class="btn btn-dark primary my-3">Back to dashboard</a>
        <a href="{{ route('host.apartments.index') }}" class="btn btn-dark primary">Go to apartment list</a>
    </div>
@endsection
