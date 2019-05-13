
<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>TAQIIM - Dashboard</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="robots" content="all,follow">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Bootstrap CSS-->
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="shortcut icon" href="{{ asset('vendor/font-awesome/css/all.min.css') }}">


  <!-- Fontastic Custom icon font-->
  <link rel="stylesheet" href="{{ asset('css/fontastic.css') }}">
  
  <!-- Google fonts - Poppins -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">
  
  <!-- theme stylesheet-->
  <link rel="stylesheet" href="{{ asset('css/style.default.css') }}" id="theme-stylesheet">
  
  <!-- Select2-->
  <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">

  <!-- Custom stylesheet - for your changes-->
  <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
  

  <!-- Tweaks for older IEs--><!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->

</head>
<body>

  <div class="page home-page">
   
    <!-- Main Navbar-->
      <header class="header">
        <nav class="navbar">
          <!-- Search Box-->
          <div class="search-box">
            <button class="dismiss"><i class="icon-close"></i></button>
            <form id="searchForm" action="#" role="search">
              <input type="search" placeholder="What are you looking for..." class="form-control">
            </form>
          </div>
          <div class="container-fluid">
            <div class="navbar-holder d-flex align-items-center justify-content-between">
              <!-- Navbar Header-->
              <div class="navbar-header">
                <!-- Navbar Brand --><a href="index.html" class="navbar-brand d-none d-sm-inline-block">
                  <div class="brand-text d-none d-lg-inline-block"><span>Taqiim </span><strong>Dashboard</strong></div>
                  <div class="brand-text d-none d-sm-inline-block d-lg-none"><strong>BD</strong></div></a>
                <!-- Toggle Button--><a id="toggle-btn" href="#" class="menu-btn active"><span></span><span></span><span></span></a>
              </div>
              <!-- Navbar Menu -->
              <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                <!-- Search-->
                <li class="nav-item d-flex align-items-center"><a id="search" href="#"><i class="icon-search"></i></a></li>
                <!-- Logout    -->
                <li class="nav-item">

                  <a href="{{ route('admin-logout') }}" class="nav-link logout"> 
                    <span class="d-none d-sm-inline">Logout</span>
                    <i class="fas fa-sign-out-alt"></i>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
      </header>
    <!-- End / Main Navbar-->

    {{-- Page Content --}}
    <div class="page-content d-flex align-items-stretch">
        
        <!-- Side Navbar -->
          @include('dashboard.sidebar')
        <!-- End / Side Navbar -->

        <div class="content-inner">
          
          <!-- Breadcrumb -->
            <div class="breadcrumb-holder container-fluid">
              <ul class="breadcrumb">
                  @yield('breadcrumb')
              </ul>
            </div>
          <!-- End / Breadcrumb -->

            
          {{-- Page Content --}}
            <main>            
              @yield('content')
            </main>
          {{-- End / Page Content --}}


          <!-- Page Footer-->
            <footer class="main-footer">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-sm-6">
                    <p>Your company &copy; 2017-2019</p>
                  </div>
                  <div class="col-sm-6 text-right">
                    <p>Design by <a href="https://bootstrapious.com/admin-templates" class="external">Bootstrapious</a></p>
                    <!-- Please do not remove the backlink to us unless you support further theme's development at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
                  </div>
                </div>
              </div>
            </footer>
          <!-- End / Page Footer-->

        </div>



    </div>

  </div>

  
    <!-- Javascript files-->
    
    <script src="{{ asset('js/jquery-3.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendor/font-awesome/js/all.min.js') }}"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>


    <!-- Google Analytics: change UA-XXXXX-X to be your site's ID.-->
   {{--  <script>
      (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
      function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
      e=o.createElement(i);r=o.getElementsByTagName(i)[0];
      e.src='//www.google-analytics.com/analytics.js';
      r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
      ga('create','UA-XXXXX-X');ga('send','pageview');
    </script>
   --}}


</body>
</html>
