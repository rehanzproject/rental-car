@extends('auth.layouts.app')


@section('content')

    <div class="no-bottom no-top" id="content">
        <section id="section-hero" aria-label="section" class="jarallax">
            <img src="{{ asset('img/background/auth-header.jpg') }}" class="jarallax-img" alt="">

            <div class="v-center">
                <div class="container" style="margin-top: 100px; padding-bottom: 200px;">
                    <div class="row" id="pwd-container">
                        <div class="col-md-4"></div>

                        <div class="col-md-4">
                            <section class="mt-5 shadow-lg p-3" style="background-color: #000000cd; backdrop-filter: blur(10px);">
                                <div class="d-flex justify-content-center">
                                    <img src="{{ asset('img/Logo.png') }}" class="mb-5" alt="Logo" width="100" />
                                    <span class="fs-1 mt-3 fw-bold">WheelsRent</span>
                                </div>

                                <form method="POST" class="form-border" action="{{ route('register') }}">
                                    @csrf

                                    {{-- Name --}}
                                    <div class="form-group mb-3">
                                        <label for="name">Name</label>
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    {{-- Email --}}
                                    <div class="form-group mb-3">
                                        <label for="email">Email Address</label>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    {{-- Password --}}
                                    <div class="form-group mb-3">
                                        <label for="password">Password</label>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    {{-- Confirm Password --}}
                                    <div class="form-group mb-3">
                                        <label for="password_confirmation">Confirm Password</label>
                                        <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                        @error('password_confirmation')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <button type="submit" class="d-flex btn btn-danger mt-3 w-100 justify-content-center">Register</button>

                                    <div class="text-center mt-3">
                                        <a href="/login">Login</a>
                                        or
                                        @if (Route::has('password.request'))
                                            <a href="{{ route('password.request') }}">Forgot Your Password?</a>
                                        @endif
                                    </div>
                                </form>
                            </section>
                        </div>

                        <div class="col-md-4"></div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
