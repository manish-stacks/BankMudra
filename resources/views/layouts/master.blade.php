<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="site-url" content="{{ url('/') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>@yield('meta_title', get_setting('website_name')) {{ ' | ' . get_setting('site_motto') }}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{uploaded_asset(get_setting('fav_icon'))}}">

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;700&family=Roboto:wght@400;500;700&display=swap">

    <!-- Plugins CSS -->
    <link rel="stylesheet" type="text/css" href="{{ static_asset('assets/vendor/font-awesome/css/all.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ static_asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ static_asset('assets/vendor/apexcharts/css/apexcharts.css') }}">
    @stack('custom_css')
    <link rel="stylesheet" type="text/css"
        href="{{ static_asset('assets/vendor/overlay-scrollbar/css/overlayscrollbars.min.css') }}">

    <!-- Theme CSS -->
    <link rel="stylesheet" type="text/css" href="{{ static_asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <!-- Dark mode -->
    <script src="{{ static_asset('assets/js/dark_mode.js') }}"></script>
     <!-- Include Dropify CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" rel="stylesheet">

    <!-- Toastr CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    
 <!-- Dropify text small  -->
    <style>
        .dropify-message p {
            margin: 5px 0 0 0;
            font-size: 14px !important;
        }
    </style>
</head>

<body>


    <!-- **************** MAIN CONTENT START **************** -->
    <main>

        <!-- Sidebar START -->
        @include('backend.includes.sidebar')
        <!-- Sidebar END -->

        <!-- Page content START -->
        <div class="page-content">

            <!-- Top bar START -->
            @include('backend.includes.header')
            <!-- Top bar END -->

            <!-- Page main content START -->
            @yield('contant')
            <!-- Page main content END -->
        </div>
        <!-- Page content END -->

    </main>
    <!-- **************** MAIN CONTENT END **************** -->

    <!-- Back to top -->
    <div class="back-top"><i class="bi bi-arrow-up-short position-absolute top-50 start-50 translate-middle"></i>
    </div>

    <!-- Bootstrap JS -->
    <script src="{{ static_asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Vendors -->
    <script src="{{ static_asset('assets/vendor/purecounterjs/dist/purecounter_vanilla.js') }}"></script>
    <script src="{{ static_asset('assets/vendor/apexcharts/js/apexcharts.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    @stack('custom_js')
    <script src="{{ static_asset('assets/vendor/overlay-scrollbar/js/overlayscrollbars.min.js') }}"></script>
    
    <!-- Template Functions -->
    <script src="{{ static_asset('assets/js/functions.js') }}"></script>
    <script src="{{ static_asset('assets/js/custom.js') }}"></script>

    @include('sweetalert::alert')

    {!! Toastr::message() !!}

    @if ($errors->any())
        <script>
            @foreach ($errors->all() as $error)
                toastr.error("{{ $error }}");
            @endforeach
        </script>
    @endif
<!-- Include Dropify JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script>
        function deleteConfirm() {
            return confirm('Are you sure you want to delete this item?');
        }
        $('.dropify').dropify();

        // Used events
        var drEvent = $('.dropify-event').dropify();
        drEvent.on('dropify.beforeClear', function(event, element) {
            return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
        });
        drEvent.on('dropify.afterClear', function(event, element) {
            alert('File deleted');
        });
    </script>




</body>

</html>
