@extends('layouts.app')

@section('content')
    <div class="container py-3">

        <div class="d-flex justify-content-between align-items-center py-4">
            <h1>Analitics</h1>
        </div>


        @include('../partials.session_message')


        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3">
            {{ $stats }}
        </div>
    </div>
@endsection
