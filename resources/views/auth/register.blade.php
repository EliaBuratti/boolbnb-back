@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                            @csrf

                            {{-- Name --}}
                            <div class="mb-4 row">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" autocomplete="name" required minlength="2" maxlength="30" />

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Last Name --}}
                            <div class="mb-4 row">
                                <label for="last_name"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

                                <div class="col-md-6">
                                    <input id="last_name" type="text"
                                        class="form-control @error('last_name') is-invalid @enderror" name="last_name"
                                        value="{{ old('last_name') }}" required minlength="2" maxlength="40">

                                    @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            {{-- Date of birth --}}
                            <div class="mb-4 row">
                                <label for="date_of_birth"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Date of birth') }}</label>

                                <div class="col-md-6">
                                    <input id="date_of_birth" type="date"
                                        class="form-control @error('date_of_birth') is-invalid @enderror"
                                        name="date_of_birth" value="{{ old('date_of_birth') }}"
                                        autocomplete="date_of_birth" required>

                                    @error('date_of_birth')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>                            
                            
                            {{-- Mail --}}
                            <div class="mb-4 row">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" autocomplete="email" required>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Password --}}
                            <div class="mb-4 row">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    autocomplete="new-password" required minlength="8">
                                    
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            {{-- Password Confirm --}}
                            <div class="mb-4 row">
                                <label for="password-confirm"
                                class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                                
                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" autocomplete="new-password" required minlength="8">
                                </div>
                            </div>
                            
                            {{-- Register Btn --}}
                            <div class="mb-4 row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary" id="submitBtn">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @vite(['resources/js/registrationForm.js'])
@endsection

{{-- CAMPI NON UTILIZZATI --}}

{{-- Phone --}}
{{-- <div class="mb-4 row">
    <label for="phone"
        class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>

    <div class="col-md-6">
        <input id="phone" type="text"
            class="form-control @error('phone') is-invalid @enderror" name="phone"
            value="{{ old('phone') }}" autocomplete="phone"  maxlength="15">

        @error('phone')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div> --}}

{{-- Host --}}
{{-- <div class="mb-4 row">
    <div class="col-md-4 col-form-label text-md-right">{{ __('Host') }}</div>
    <div class="col-md-6">
        <div class="form-check form-check-inline">
            <input class="form-check-input @error('host') is-invalid @enderror" type="radio"
                name="host" id="false" value="0"
                {{ old('host') == 0 ? 'checked' : '' }} />
            <label class="form-check-label" for="false"> I DON'T want to become a host
            </label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input @error('host') is-invalid @enderror" type="radio"
                name="host" id="true" value="1"
                {{ old('host') == 1 ? 'checked' : '' }} />
            <label class="form-check-label" for="true">
                I want to become a host
            </label>
        </div>
        @error('host')
            <div class="text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </div>
        @enderror
    </div>
</div> --}}

{{-- Thumb --}}
{{-- <div class="mb-4 row">
    <label for="thumb"
        class="col-md-4 col-form-label text-md-right">{{ __('Thumb') }}</label>

    <div class="col-md-6">
        <input type="file" class="form-control @error('thumb') is-invalid @enderror"
            name="thumb" id="thumb" />
        @error('thumb')
            <div class="text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </div>
        @enderror
    </div>
</div> --}}

{{-- City --}}
{{-- <div class="mb-4 row">
    <label for="city"
        class="col-md-4 col-form-label text-md-right">{{ __('City') }}</label>

    <div class="col-md-6">
        <input id="city" type="text"
            class="form-control @error('city') is-invalid @enderror" name="city"
            value="{{ old('city') }}"  maxlength="30">

        @error('city')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div> --}}

{{-- Postal Code --}}
{{-- <div class="mb-4 row">
    <label for="postal_code"
        class="col-md-4 col-form-label text-md-right">{{ __('Postal Code') }}</label>

    <div class="col-md-6">
        <input id="postal_code" type="text"
            class="form-control @error('postal_code') is-invalid @enderror" name="postal_code"
            value="{{ old('postal_code') }}" autocomplete="postal_code" 
            maxlength="10">

        @error('postal_code')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div> --}}

{{-- Address --}}
{{-- <div class="mb-4 row">
    <label for="address"
        class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

    <div class="col-md-6">
        <input id="address" type="text"
            class="form-control @error('address') is-invalid @enderror" name="address"
            value="{{ old('address') }}" autocomplete="address"  maxlength="100">

        @error('address')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div> --}}