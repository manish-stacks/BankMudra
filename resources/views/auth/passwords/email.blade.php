@extends('layouts.app')
@section('meta_title', isset($title) ? $title : 'Forgot Password')
@section('content')


    <section class="p-0 d-flex align-items-center position-relative overflow-hidden bg-gradient-two">

        <div class="container-fluid">
            <div class="row">

                <!-- Right -->
                <div class="col-12 col-lg-5 m-auto">
                    <div class="row my-5">
                        <div class="col-sm-10 col-xl-9 m-auto border p-5 bg-white">

                            <!-- Title -->
                            
                            <h1 class="fs-2"><span class="mb-0 fs-3">🤔</span> Forgot Password?</h1>
                            <h5 class="fw-light mb-4 fs-5">To receive a new password, enter your email address below.</h5>

                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <!-- Form START -->
                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf
                                <!-- Email -->

                                <div class="mb-4">
                                    <label for="exampleInputEmail1" class="form-label">Email address *</label>
                                    <div class="input-group input-group-lg">
                                        <span
                                            class="input-group-text bg-light rounded-start border-0 text-secondary px-3"><i
                                                class="bi bi-envelope-fill"></i></span>
                                        <input type="email"
                                            class="form-control border-0 bg-light rounded-end ps-1 @error('email') is-invalid @enderror"
                                            name="email" value="{{ old('email') }}" required autocomplete="email"
                                            autofocus placeholder="E-mail" id="exampleInputEmail1">
                                    </div>
                                    @error('email')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <!-- Button -->
                                <div class="align-items-center">
                                    <div class="d-grid">
                                        <button class="btn btn-primary mb-0"
                                            type="submit">{{ __('Send Password Reset Link') }}</button>
                                    </div>
                                </div>
                            </form>
                            <!-- Form END -->
                        </div>
                    </div> <!-- Row END -->
                </div>
            </div> <!-- Row END -->
        </div>
    </section>





@endsection
