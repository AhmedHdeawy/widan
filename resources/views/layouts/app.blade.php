<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Taqiim</title>
    
    {{-- Styles --}}
    <link rel="stylesheet" href="{{ asset('front/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/fontawesome.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tajawal">
    <link rel="stylesheet" href="{{ asset('front/css/custom.css') }}">

    @yield('style')
    
</head>
<body>
    <div id="app">

        
        @yield('navbar')

        <main class="py-4">
            @yield('content')
        </main>

        <!--Start Footer -->
        <footer class="bg-color">

            <div class="container-fluid">

                <div class="rapper d-flex flex-wrap justify-content-between">

                    <p class="copy-right text-white">جميع الحقوق محفوظه

                        <img src="{{ asset('front/images/Logo.png') }}" title="لوجو الموقع" alt="هذة الصورة تخص لوجو الموقع" width="80px" height="50px" />

                        2019 &copy;

                    </p>

                    <div class="social-icons">

                        <a href="#"><i class="fab fa-twitter text-center bg-white main-color"></i></a>
                        <a href="#"><i class="fab fa-instagram text-center bg-white main-color"></i></a>
                        <a href="#"><i class="fab fa-facebook-f text-center bg-white main-color"></i></a>

                    </div>  

                </div>

            </div>

        </footer>

        <!--End Footer -->

    </div>


    {{-- Scripts --}}
    <script src="{{ asset('front/js/jquery.min.js') }}"></script>
    <script src="{{ asset('front/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('front/js/popper.min.js') }}"></script>
    <script src="{{ asset('front/js/custom.js') }}"></script>
    @yield('script')
</body>
</html>
