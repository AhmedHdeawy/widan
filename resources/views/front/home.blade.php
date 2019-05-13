@extends('layouts.app')

@section('navbar')

    @include('layouts.header')

@endsection

@section('content')




    <!-- start The Most Common Categories Sections -->

    <section class="most-common-categories text-center">

        <div class="container">

            <h3>التصنيفات الاكثر شيوعا</h3>

            <div class="rapper d-flex flex-wrap justify-content-between">

                <!-- Start Categories Section -->
                @foreach($categories as $category)

                    <div class="place">

                        <a href="{{ route('category', $category->slug) }}">

                            <div class="photo">

                                <div class="overlay-place"></div>

                                <img src="{{ asset('img/categories/'. $category->logo) }}" alt="{{ $category->name }}" width="100%" height="100%">

                            </div>

                            <div class="foo-place">

                                <i class="fas fa-hotel icon"></i> {{ $category->name }}

                            </div>

                        </a>

                    </div>
                @endforeach


                <!-- End Categories Section --> 
                
               

                <!-- Start More Section -->

                <div class="place">

                    <div class="photo d-flex flex-wrap">

                        <div class="overlay-place">
        
                            <a href="{{ route('categories') }}">والمزيد</a>

                        </div>

                        <div class="photo-first photo-image">

                            <img src="{{ asset('front/images/More_Image_1.png') }}" title="فندق كارافيلي" alt="هذة الصورة تخص فندق كارافيلي" width="100%" />

                            <img src="{{ asset('front/images/More_Image_2.png') }}" title="فندق كارافيلي" alt="هذة الصورة تخص فندق كارافيلي" width="100%" />
                        
                        </div>

                        <div class="photo-second photo-image">

                            <img src="{{ asset('front/images/More_Image_3.png') }}" title="فندق كارافيلي" alt="هذة الصورة تخص فندق كارافيلي" width="100%" />

                            <img src="{{ asset('front/images/More_Image_4.png') }}" title="فندق كارافيلي" alt="هذة الصورة تخص فندق كارافيلي" width="100%" />

                        </div>

                        <div class="photo-third photo-image">

                            <img src="{{ asset('front/images/More_Image_5.png') }}" title="فندق كارافيلي" alt="هذة الصورة تخص فندق كارافيلي" width="100%" />

                        </div>

                        <div class="photo-forth photo-image">

                            <img src="{{ asset('front/images/More_Image_6.png') }}" title="فندق كارافيلي" alt="هذة الصورة تخص فندق كارافيلي" width="100%" />

                            <img src="{{ asset('front/images/More_Image_7.png') }}" title="فندق كارافيلي" alt="هذة الصورة تخص فندق كارافيلي" width="100%" />

                        </div>

                    </div>

                </div>

                <!-- End More Section -->

            </div>

        </div>

    </section>

    <!-- End The Most Common Categories Sections -->


    <!-- start Top Rated Services Sections -->

    <section class="top-rated-services text-center">

        <div class="container">

            <h3>الخدمات الاعلي تقييما</h3>

            <div class="rapper d-flex flex-wrap justify-content-between">

                <!-- Start First Place -->

                <div class="place">

                    <a href="#">

                        <div class="photo">

                            <div class="overlay-place"></div>

                            <img src="{{ asset('front/images/all-sections.png') }}" title="فندق كارافيلي" alt="هذة الصورة تخص فندق كارافيلي" width="100%" height="100%">

                        </div>

                        <div class="foo-place">
                                
                            <i class="fas fa-hotel icon"></i>فنادق

                            <i class="fas fa-star"></i><span>4.5\5</span>

                        </div>

                    </a>

                </div>

                <!-- End First Place --> 
                
                <!-- Start Second Place -->

                <div class="place">

                    <a href="#">

                        <div class="photo">

                            <div class="overlay-place"></div>

                            <img src="{{ asset('front/images/Home_Companies.png') }}" title="فندق كارافيلي" alt="هذة الصورة تخص فندق كارافيلي" width="100%" height="100%">

                        </div>

                        <div class="foo-place">
                                
                            <i class="fas fa-building"></i>شركات

                            <i class="fas fa-star"></i><span>4.5\5</span>

                        </div>

                    </a>

                </div>

                <!-- End Second Place --> 

                <!-- Start Third Place -->

                <div class="place">

                    <a href="#">

                        <div class="photo">

                            <div class="overlay-place"></div>

                            <img src="{{ asset('front/images/Home_Cinemas.png') }}" title="فندق كارافيلي" alt="هذة الصورة تخص فندق كارافيلي" width="100%" height="100%">

                        </div>

                        <div class="foo-place">
                                
                            <i class="fas fa-film icon"></i>دور سينما

                            <i class="fas fa-star"></i><span>4.5\5</span>

                        </div>

                    </a>

                </div>

                <!-- End Third Place -->
                
                <!-- Start Forth Place -->

                <div class="place">

                    <a href="#">

                        <div class="photo">

                            <div class="overlay-place"></div>

                            <img src="{{ asset('front/images/Home_Restaurants.png') }}" title="فندق كارافيلي" alt="هذة الصورة تخص فندق كارافيلي" width="100%" height="100%">

                        </div>

                        <div class="foo-place">

                            <i class="fas fa-utensils icon"></i>مطاعم

                            <i class="fas fa-star"></i><span>4.5\5</span>

                        </div>

                    </a>

                </div>

                <!-- End Forth Place -->

            </div>

        </div>

    </section>

    <!-- End Top Rated Services Sections -->


    <!-- Start The Method Of Work Section -->

    <div class="methodWork text-center">

        <div class="container">

            <h4>طريقة العمل</h4>

            <div class="methodWorkContent d-flex flex-wrap justify-content-between">

                <div class="methodWorkFirst methodWorkSection">

                    <h3>اولا</h3>

                    <h5>اختر القسم الذي تريد</h5>

                    <p>جديدة الاعمال لبلجيكا.عل لم.بل مليون وقامت الا قامت الشرق عل دول ان قامت الاعمال اضف علي بال مرمي العد اوروبا بعد قائمة والمعدات ما</p>

                </div>

                <div class="methodWorkSecond methodWorkSection">

                    <h3>ثانيا</h3>

                    <h5>تجد المكان</h5>

                    <p>جديدة الاعمال لبلجيكا.عل لم.بل مليون وقامت الا قامت الشرق عل دول ان قامت الاعمال اضف علي بال مرمي العد اوروبا بعد قائمة والمعدات ما</p>

                </div>

                <div class="methodWorkThird methodWorkSection">

                    <h3>واخيرا</h3>

                    <h5>استمتع بوقتك</h5>

                    <p>جديدة الاعمال لبلجيكا.عل لم.بل مليون وقامت الا قامت الشرق عل دول ان قامت الاعمال اضف علي بال مرمي العد اوروبا بعد قائمة والمعدات ما</p>

                </div>

            </div>

        </div>

    </div>

    <!-- End The Method Of Work Section -->




@endsection
