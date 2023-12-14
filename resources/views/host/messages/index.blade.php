@extends('layouts.app')

@section('content')
<div class="container">

    @include('../partials.errors')

    @forelse ($messages as $message)
        <div class="mb-5">
            {{$message->name}} <br>
            {{$message->subject}} <br>
            {{$message->email}} <br>
            {{$message->message}} <br>
            {{$message->apartment_id}} <br>
        </div>
    @empty
        <div>
            No messages
        </div>
    @endforelse


    
</div>
@endsection
