@extends('layouts.app')

@section('content')
<div class="container">

    @include('../partials.errors')

    <h1 class="display-6 py-4">Messages</h1>

    <div
        class="table-responsive"
    >
        <table
            class="table table-hover align-middle"
        >
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Subject</th>
                    <th scope="col">Date</th>
                    <th scope="col">Message</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($messages as $message)
                <tr class="">
                    <td scope="row">{{$message->name}}</td>
                    <td scope="row">{{$message->email}}</td>
                    <td>{{$message->subject}}</td>
                    <td>{{$message->created_at->format('d-m-Y H:m')}}</td>
                    <td>
                        <!-- Modal trigger button -->
                        <button type="button"
                            class="btn bg_primary rounded-4 m-3"
                            data-bs-toggle="modal" data-bs-target="#modalId-{{ $message->id }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                                <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z"/>
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
                                        <h5 class="modal-title" id="modalTitleId-{{ $message->id }}">
                                            <strong> {{$message->subject}} </strong>
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">

                                        <h5>By: {{$message->email}} </h5>

                                        <div class="pt-4">Message:</div>
                                        <p>
                                            {{$message->message}}
                                        </p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close!</button>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
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
