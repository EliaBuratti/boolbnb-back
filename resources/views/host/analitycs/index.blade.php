@extends('layouts.app')

@section('content')
    <div class="container py-3">

        <div class="d-flex justify-content-between align-items-center py-4">
            <h1>Analitics</h1>
        </div>


        @include('../partials.session_message')


        <div class="row justify-content-center align-items-center">
            <div class="col col-md-9">
                <div style="width: 100%;">
                    <canvas id="chartViews" data-set="{{ json_encode($views) }}"></canvas>
                </div>
            </div>
            <div class="col col-md-3">
                <h3>Total views for yours apartments : {{ $totalViews }}</h3>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @vite(['resources/js/Chart.js'])
@endsection
