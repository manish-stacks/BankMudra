@extends('layouts.app')
@section('meta_title', isset($title) ? $title : 'Confirm Password')
@section('content')


    <section class="p-0 d-flex align-items-center position-relative overflow-hidden bg-gradient-two">

        <div class="container-fluid">
            <div class="row">

                <!-- Right -->
                <div class="col-12 col-lg-5 m-auto">
                    <div class="row my-5">
                        <div class="col-sm-10 col-xl-9 m-auto border p-5 bg-white">

                            <!-- Title -->
                            <h1 class="fs-2">Confirm Password</h1>
                            <h5 class="fw-light mb-4">{{ __('Please confirm your password before continuing.') }}</h5>

                            <!-- Form START -->


                            <form method="POST" action="{{ route('password.confirm') }}">
                                @csrf

                                <!-- Password -->
                                <div class="mb-4">
                                    <label for="inputPassword5" class="form-label">Password *</label>
                                    <div class="input-group input-group-lg">
                                        <span
                                            class="input-group-text bg-light rounded-start border-0 text-secondary px-3"><i
                                                class="fas fa-lock"></i></span>
                                        <input type="password"
                                            class="form-control border-0 bg-light rounded-end ps-1 @error('password') is-invalid @enderror"
                                            name="password" required autocomplete="current-password" id="inputPassword5"
                                            placeholder="*********">
                                    </div>
                                    @error('password')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>


                                <!-- Button -->
                                <div class="align-items-center">
                                    <div class="d-grid">
                                        <button class="btn btn-primary mb-0"
                                            type="submit">{{ __('Confirm Password') }}</button>
                                    </div>
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
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
