<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    @yield('metatag')

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{ asset('front/images/logo-icon.png') }}" type="image/png" sizes="16x16">

    <title>{{ __('lang.websiteName') }}</title>

    {{-- Styles --}}
    @if($currentLangDir == 'rtl')
        {{-- RTL Styles --}}
        <link rel="stylesheet" href="{{ asset('front/css/bootstrap-rtl.css') }}">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tajawal:400,500,700,800,900">
    @else
        <link rel="stylesheet" href="{{ asset('front/css/bootstrap.css') }}">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700,900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700,900&display=swap" rel="stylesheet">
    @endif

    <link rel="stylesheet" href="{{ asset('front/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/custom.css') }}">

    @if($currentLangDir == 'rtl')
        {{-- RTL Styles --}}
        <link rel="stylesheet" href="{{ asset('front/css/custom-rtl.css') }}">
    @endif

    <!-- Start of HubSpot Embed Code -->
        <script type="text/javascript" id="hs-script-loader" async defer src="//js.hs-scripts.com/6545880.js"></script>
    <!-- End of HubSpot Embed Code -->

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-152729939-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-152729939-1');
    </script>

    <!-- Facebook Pixel Code -->
    <script>
      !function(f,b,e,v,n,t,s)
      {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
      n.callMethod.apply(n,arguments):n.queue.push(arguments)};
      if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
      n.queue=[];t=b.createElement(e);t.async=!0;
      t.src=v;s=b.getElementsByTagName(e)[0];
      s.parentNode.insertBefore(t,s)}(window, document,'script',
      'https://connect.facebook.net/en_US/fbevents.js');
      fbq('init', '509292469992912');
      fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
      src="https://www.facebook.com/tr?id=509292469992912&ev=PageView&noscript=1"
    /></noscript>
    <!-- End Facebook Pixel Code -->


</head>

<!-- class="rtl" -->
<body class="{{ $currentLangDir == 'rtl' ? 'rtl' : ''  }}">

    {{-- Navbar --}}
    @include('layouts.navbar')

    @yield('content')

    <!--Start Footer -->

    <footer>
        <div class="container">
            
            <div class="row align-items-center justify-content-center">
                <div class="col-12 col-md-9">
                    <p class="fb-500 m-0 ">
                        <i class="fa fa-copyright" aria-hidden="true"></i>
                       {{ __('lang.copyRight') }}
                       {{ date('Y') }}
                    </p>
                </div>
                <div class="col-12 col-md-3">
                    <p class="fb-500 m-0 ">
                       {{ __('lang.poweredBy') }}
                       <a href="https://eg.mostaql.com/u/AhmedHdeawy/portfolio" target="_blank" class="gr-color">
                         Ahmed Hdeawy
                       </a>
                    </p>
                </div>
            </div>
        </div>
    </footer>


    <!--End Footer -->


    {{-- Scripts --}}
    <script src="{{ asset('front/js/jquery.min.js') }}"></script>
    <script src="{{ asset('front/js/popper.min.js') }}"></script>

    @if($currentLangDir == 'rtl')
        {{-- RTL Scripts --}}
        <script src="{{ asset('front/js/bootstrap-rtl.min.js') }}"></script>
    @else
        <script src="{{ asset('front/js/bootstrap.min.js') }}"></script>
    @endif

    <script src="{{ asset('front/js/custom.js') }}"></script>

    @yield('script')

</body>
</html>
