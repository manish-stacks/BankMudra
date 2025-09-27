@extends('layouts.app')
@section('meta_title', isset($title) ? $title : 'Verify')
@section('content')



    <section class="p-0 d-flex align-items-center position-relative overflow-hidden bg-gradient-two">

        <div class="container-fluid">
            <div class="row">

                <!-- Right -->
                <div class="col-12 col-lg-5 m-auto">
                    <div class="row my-5">
                        <div class="col-sm-10 col-xl-9 m-auto border p-5 bg-white">

                            <!-- Form START -->

                            @if (session('resent'))
                                <div class="alert alert-success" role="alert">
                                    {{ __('A fresh verification link has been sent to your email address.') }}
                                </div>
                            @endif

                            {{ __('Before proceeding, please check your email for a verification link.') }}
                            {{ __('If you did not receive the email') }},
                            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                                @csrf



                                <!-- Button -->
                                <div class="align-items-center">
                                    <div class="d-grid">
                                        <button class="btn btn-primary mb-0"
                                            type="submit">{{ __('click here to request another') }}</button>
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
