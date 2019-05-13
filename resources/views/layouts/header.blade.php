    <!-- Start Header -->

    <header>

        <div class="header-overlay"></div>

        <!-- Start Navbar -->

            <nav class="navbar navbar-expand-md navbar-light container-fluid">

                <a class="navbar-brand" href="#"><img src="{{ asset('front/images/Logo.png') }}" alt="This Image For Logo In This Websit" /></a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedcontent" aria-controls="navbarSupportedcontent" aria-expanded="false" aria-label="Toggle navigation">
                    
                    <span class="navbar-toggler-icon"></span>
                    <span class="navbar-toggler-icon"></span>
                    <span class="navbar-toggler-icon"></span>

                </button>
                    
                <div class="collapse navbar-collapse" id="navbarSupportedcontent">

                    <ul class="navbar-nav mr-auto">

                        <li class="nav-item active">

                            <a class="nav-link" href="{{ route('categories') }}">التصنيفات<span class="sr-only">(current)</span></a>

                        </li>

                        <li class="nav-item">

                            <a class="nav-link" href="#">الاعلي تقييما</a>

                        </li>

                        <li class="nav-item nav-item-toggle">

                            <a class="nav-link" href="#">الصفحة الشخصية</a>

                        </li>

                        <li class="nav-item">
                            @if(auth()->check())
                                <a class="nav-link" href="{{ route('login') }}">
                                    <i class="fas fa-user"></i>
                                    {{ auth()->user()->name }}
                                </a>

                               
                            @else
                                <a class="nav-link" href="{{ route('login') }}">
                                    <i class="fas fa-user"></i>
                                    تسجيل الدخول
                                </a>
                            @endif
                        </li>
                        
                        @if(auth()->check())
                            <li class="nav-item nav-item-toggle">

                                 <form action="{{ route('logout') }}" method="post">
                                    @csrf 
                                    <button class="logout-btn" type="submit">
                                        <i class="fas fa-sign-out-alt"></i>
                                        خروج
                                    </button>
                                </form>

                            </li>
                        @endif

                    </ul>

                </div>

            </nav>

        <!-- End Navbar -->

        <!-- Start Header_Body -->

        <section class="header-body text-center">

            <div class="header-body-content">

                <h1>اكتشف مدينتك مباشرا</h1>

                <p>نساعدك علي ايجاد فنادق،مطاعم وشركات بطريقة بسيطة</p>

            </div>

            <div class="header-body-top">

                <form class="d-flex flex-wrap">

                    <div class="form-content d-flex flex-wrap justify-content-around">
        
                        <input type="text" placeholder="اكتب اسم المدينة......." />

                        <input list="sections" placeholder="جميع الاقسام.....">

                        <datalist id="sections">

                            <option value="محلات">
                            <option value="دور سينما">
                            <option value="مطاعم">
                            <option value="فنادق">
                            <option value="المزيد">

                        </datalist>

                        <input type="text" placeholder="كلمة البحث....." />

                        <button type="button">

                            ابحث
                            <i class="fas fa-search"></i>
    
                        </button>

                    </div>

                </form>

            </div>

            <div class="header-body-medium d-flex flex-wrap justify-content-between">

                <div class="first content text-center">

                    <a href="#">

                        <i class="fas fa-shopping-cart"></i>

                        <span>محلات</span>
                    </a>

                </div>

                <div class="second content">

                    <a href="#">

                        <i class="fas fa-film"></i>

                        <span>دور سينما</span>
                        
                    </a>

                </div>

                <div class="third content">

                    <a href="#">

                        <i class="fas fa-utensils"></i>

                        <span>مطاعم</span>

                    </a>

                </div>

                <div class="fourth content">

                    <a href="#">

                        <i class="fas fa-hotel"></i>

                        <span>فنادق</span>

                    </a>

                </div>

                <div class="fivth content">

                    <a href="#">

                        <i class="fas fa-plus"></i>

                        <span>المزيد</span>

                    </a>

                </div>

            </div>

            <div class="header-body-bottom">

                <i class="fas fa-sort-down"></i>

            </div>

        </section>

        <!-- Start Header_Body -->

    </header>

    <!-- End Header -->
