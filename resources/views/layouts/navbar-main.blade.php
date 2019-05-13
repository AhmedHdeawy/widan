
    <!-- Start Navbar -->

    <div class="navbar-sign-in">

        <div class="container-fluid">

            <nav class="inside-nav navbar navbar-expand-md navbar-light bg-color navbar fixed-top">

                <a class="navbar-brand" href="/">
                    
                    <img src="{{ asset('front/images/Logo.png') }} " alt="هذة الصورة تخص لوجو هذا الموقع" width="100%" height="100%" />
                
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    
                    <span class="navbar-toggler-icon bg-white"></span>
                    <span class="navbar-toggler-icon bg-white"></span>
                    <span class="navbar-toggler-icon bg-white"></span>

                </button>
                    
                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <ul class="navbar-nav mr-auto">

                        <li class="nav-item item-click">

                            <input type="text" placeholder="بحث...." />

                            <i class="fas fa-search fa-toggle main-color"></i>

                        </li>

                        <li class="nav-item active">

                            <a class="nav-link text-white" href="{{ route('categories') }}">التصنيفات<span class="sr-only">(current)</span></a>

                        </li>

                        <li class="nav-item">

                            <a class="nav-link text-white" href="categories.html">الاعلي تقييما</a>

                        </li>

                        <li class="nav-item nav-item-toggle">

                            <a class="nav-link text-white" href="user-profile.html">الصفحة الشخصية</a>

                        </li>

                        <li class="nav-item">

                            @if(auth()->check())

                                <a class="nav-link text-white" href="sign-in.html">
                                    <i class="fas fa-user"></i>
                                    {{ auth()->user()->name }}
                                </a>
                            @else
                                <a class="nav-link text-white" href="{{ route('login') }}">
                                    <i class="fas fa-user"></i>
                                    تسجيل الدخول
                                </a>
                            @endif
                        </li>

                        @if(auth()->check())
                            <li class="nav-item nav-item-toggle">

                                 <form action="{{ route('logout') }}" method="post">
                                    @csrf 
                                    <button class="logout-btn logout-btn-nav" type="submit">
                                        <i class="fas fa-sign-out-alt"></i>
                                        خروج
                                    </button>
                                </form>

                            </li>
                        @endif

                    </ul>

                </div>

            </nav>

        </div>

        <!-- Start formSearh After Navbar -->

        <div class="after-nabvbar text-center">

            <form class="d-flex justify-content-between">
    
                <input type='text' placeholder="بحث....." />
    
                <i class="fas fa-times bg-color text-white"></i>
    
            </form>
    
        </div>
    
        <!-- End formSearh After Navbar -->

    </div>

    <!-- End Navbar -->
