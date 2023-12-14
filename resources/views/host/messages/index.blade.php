@extends('layouts.app')

@section('content')
<div class="container">

    @include('../partials.errors')

    @foreach ($messages as $message)
        <div class="mt-5">
            {{$message->name}}
        </div>
    @endforeach
    
</div>
@endsection
