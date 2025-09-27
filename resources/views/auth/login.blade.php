@extends('layouts.app')
@section('meta_title', isset($title) ? $title : 'Login')
@section('content')


    <section class="p-0 d-flex align-items-center position-relative overflow-hidden bg-gradient-two">

        <div class="container-fluid">
            <div class="row">

                <!-- Right -->
                <div class="col-12 col-lg-5 m-auto">
                    <div class="row my-5">
                        <div class="col-sm-10 col-xl-9 m-auto border p-5 bg-white">
                            <!-- Title -->

                            <h1 class="fs-2">Login <span class="mb-0 fs-3 wave-emoji">👋</span></h1>
                            <p class="lead mb-4">Nice to see you! Please log in with your account.</p>
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif


                            <!-- Form START -->
                            <form method="POST" action="#" >
                                @csrf
                                {{-- <input type="hidden" name="intendedUrl" value="{{ request()->input('intendedUrl', route('student.dashboard')) }}"> --}}
                                <!-- Email -->

                                <!-- Hidden input to store intended URL -->
                                <input type="hidden" name="intendedUrl" id="intendedUrlInput">
                                <div class="mb-4">
                                    <label for="exampleInputEmail1" class="form-label">{{ __('Email Address') }} *</label>
                                    <div class="input-group input-group-lg">
                                        <span
                                            class="input-group-text bg-light rounded-start border-0 text-secondary px-3"><i
                                                class="bi bi-envelope-fill"></i></span>
                                        <input type="email"
                                            class="form-control border-0 bg-light rounded-end ps-1 @error('email') is-invalid @enderror"
                                            name="email" value="" required
                                            autocomplete="email" autofocus placeholder="E-mail" id="exampleInputEmail1">

                                    </div>
                                    @error('email')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <!-- Password -->
                                <div class="mb-4">
                                    <label for="inputPassword5" class="form-label">{{ __('Password') }} *</label>
                                    <div class="input-group input-group-lg">
                                        <span
                                            class="input-group-text bg-light rounded-start border-0 text-secondary px-3"><i
                                                class="fas fa-lock"></i></span>
                                        <input type="password"
                                            class="form-control border-0 bg-light rounded-end ps-1 @error('password') is-invalid @enderror"
                                            name="password" required autocomplete="current-password" placeholder="password"
                                            id="inputPassword5" value="">
                                    </div>
                                    <div id="passwordHelpBlock" class="form-text">
                                        Your password must be 8 characters at least
                                    </div>

                                    @error('password')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                                <!-- Check box -->
                                <div class="mb-4 d-flex justify-content-between mb-4">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="remember"> {{ __('Remember Me') }}</label>
                                    </div>
                                </div>
                                <!-- Button -->
                                <div class="align-items-center mt-0">
                                    <div class="d-grid">
                                        <button class="btn btn-primary mb-0" type="submit">Login</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div> <!-- Row END -->
                </div>
            </div> <!-- Row END -->
        </div>
    </section>




@endsection

