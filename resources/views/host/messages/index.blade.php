@extends('layouts.app')

@section('content')
    <div class="container">

        @include('../partials.errors')

        <h1 class="display-6 py-4">Messages</h1>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th class="d-none d-lg-table-cell" scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th class="d-none d-sm-table-cell" scope="col">Subject</th>
                        <th class="d-none d-lg-table-cell" scope="col">Date</th>
                        <th scope="col">Message</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($messages as $message)
                        <tr>
                            <td class="d-none d-lg-table-cell" scope="row">{{ $message->name }}</td>
                            <td scope="row">{{ $message->email }}</td>
                            <td class="d-none d-sm-table-cell" scope="row">{{ ucfirst($message->subject) }}</td>
                            <td class="d-none d-lg-table-cell" scope="row">{{ $message->created_at->format('d-m-Y H:m') }}</td>
                            <td class="d-flex gap-2">
                                <!-- Modal trigger button -->
                                <button type="button"
                                    class="bg_primary border-0 d-flex justify-content-between align-items-center p-2 rounded-3 message-btn"
                                    data-bs-toggle="modal" data-bs-target="#modalId-{{ $message->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                                        <path
                                            d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z" />
                                    </svg>
                                </button>

                                <!-- Modal Body -->
                                <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                <div class="modal modal-lg fade" id="modalId-{{ $message->id }}" tabindex="-1"
                                    data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                    aria-labelledby="modalTitle-{{ $message->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered"
                                        role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <div>
                                                    <h5>Message from: {{ $message->name }} </h5>
                                                    <div>
                                                        Email: {{ $message->email }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-body">
                                                <strong class="modal-title fs-5" id="modalTitleId-{{ $message->id }}">
                                                    {{ ucfirst($message->subject) }}
                                                </strong>
                                                <p class="mt-2">
                                                    {{ $message->message }}
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn primary btn-dark"
                                                    data-bs-dismiss="modal">Close!</button>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- BUTTON DELETE --}}
                                <button type="button" class="btn btn-danger border-0 d-flex justify-content-between align-items-center p-2 rounded-3" data-bs-toggle="modal"
                                    data-bs-target="#modalId-delete-{{ $message->id }}">
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
                                <div class="modal fade" id="modalId-delete-{{ $message->id }}" tabindex="-1"
                                    data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                    aria-labelledby="modalTitleId-{{ $message->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                        role="document">

                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h5 class="modal-title d-flex justify-content-center align-items-center gap-3 w-100"
                                                    id="modalTitleId-{{ $message->id }}">
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
                                                    action="{{ route('host.messages.destroy',$message->id) }}"
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

                            </td>
                        </tr>
                    @empty
                        <tr class="">
                            <td scope="row" colspan="4">No messages</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
@endsection
