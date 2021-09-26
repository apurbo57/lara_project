<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>@yield('title')</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{ asset('assets/frontend/css/styles.css') }}" rel="stylesheet" />
    </head>
    <body>

        @include('frontend.components.header')

        <!-- Page content-->
        <div class="container">
            <div class="row">
                <!-- Blog entries-->
                <div class="col-lg-8">
                    <!-- Featured blog post-->
                    @yield('content')
                </div>
                <!-- Side widgets-->
                @include('frontend.components.sidebar')
            </div>
        </div>
        <!-- Footer-->
        @include('frontend.components.footer')
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{ asset('assets/frontend/js/scripts.js') }}"></script>
    </body>
</html>