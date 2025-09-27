    <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
   
    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;700&family=Roboto:wght@400;500;700&display=swap">

    <!-- Plugins CSS -->
    <link rel="stylesheet" type="text/css" href="{{ static_asset('assets/vendor/font-awesome/css/all.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ static_asset('assets/vendor/bootstrap-icons/bootstrap-icons.css')}}">

    <!-- Theme CSS -->
    <link rel="stylesheet" type="text/css" href="{{ static_asset('assets/css/style.css')}}">

</head>

<body>
    <section class="p-0 d-flex align-items-center position-relative overflow-hidden bg-gradient-two h-100vh">

        <div class="container-fluid">
            <div class="row">

                <!-- Right -->
                <div class="col-12 col-lg-5 m-auto">
                    <div class="row my-5">
                        <div class="col-sm-10 col-xl-9 m-auto border p-5 bg-white" >
                            <!-- Title -->

                            <h1 class="fs-2">Login <span class="mb-0 fs-3 wave-emoji">👋</span></h1>
                            <p class="lead mb-4">Nice to see you! Please log in with your account.</p>

                            <!-- Form START -->
                            <form method="POST" action="{{ route('admin.login.auth') }}">
                                @csrf


                                <!-- Email -->
                                <div class="mb-4">
                                    <label for="exampleInputEmail1" class="form-label">{{ __('Email Address') }}
                                        *</label>
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
                                            name="password" required autocomplete="current-password"
                                            placeholder="password" id="inputPassword5" value="">
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

                                    @if (Route::has('password.request'))
                                        <div class="text-primary-hover">
                                            <a href="{{ route('password.request') }}" class="text-secondary">
                                                <u>Forgot password?</u>
                                            </a>
                                        </div>
                                    @endif
                                </div>
                                <!-- Button -->
                                <div class="align-items-center mt-0">
                                    <div class="d-grid">
                                        <button class="btn btn-primary mb-0" type="submit">Login</button>
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

    <script src="{{ static_asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Template Functions -->
    <script src="{{ static_asset('assets/js/functions.js')}}"></script>
</body>

</html>
