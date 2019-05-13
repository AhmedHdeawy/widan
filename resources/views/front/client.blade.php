@extends('layouts.app')

@section('style')

    <link rel="stylesheet" href="{{ asset('front/plugins/css/star-rating.css') }}">
    <link rel="stylesheet" href="{{ asset('front/plugins/themes/krajee-fas/theme.css') }}">
    <link rel="stylesheet" href="{{ asset('front/plugins/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('front/plugins/css/owl.theme.default.css') }}">

@endsection

@section('navbar')

    @include('layouts.navbar-main')

@endsection


@section('content')

<!-- Start Company Profile -->

    <div class="company-profile">

        <!-- Start First Section -->

        <div class="container">

            <div class="flex-avatar">

                <!-- Start Avatar -->

                <div class="avatar">
                    
                    <div class="comp-img">

                        <img src="{{ asset('img/clients/'. $client->logo) }}" alt="{{ $client->name }}" width="100%" height="300" />

                    </div>

                    <div class="comp-bio">

                        <h3>{{ $client->name }}</h3>

                        <p>
                            <span class=" {{ count($client->followers) < 1 ? 'd-none' : '' }}">
                                <span class="followers-count">{{ count($client->followers) }}</span>
                                {{ count($client->followers) > 1 ? 'متابعين' : 'متابع' }}
                            </span>

                            <button class="follow-btn mr-4 taqiim-color btn btn-sm btn-taqiim" 
                                data-follow="{{ $userFollower ? '0' : '1' }}">
                                <i class="fas {{ $userFollower ? 'fa-minus-circle' : 'fa-plus-circle' }} "></i>
                                <span class="mr-1">
                                    {{ $userFollower ? 'الغاء متابعة' : 'متابعة' }}
                                </span>
                                
                            </button>

                        </p>

                        <div class="my-3" dir="ltr">

                            <input class="client-evaluated" value="{{ $client->rate }}" dir="rtl" data-size="sm">
                            <span class="mx-4 font-weight-bold">
                                ( {{ count($client->reviews) }} )
                            </span>
                            <div class='clearfix'></div>

                        </div>

                        <!-- Start addresses-communicationsdata_First -->

                <div class="addresses-communicationsdata-body-first addresses-communicationsdata-body-content mt-3">

                    <div class="">
                        <div class="addresses-communicationsdata-body-first-body addresses-communicationsdata-body-content-body text-right">

                            <p class="mb-2">
                                <i class="fas fa-envelope mx-2"></i>
                                {{ $client->email }}
                            </p>

                            <p class="mb-2">
                                <i class="fas fa-phone mx-2"></i>
                                {{ $client->phone }}
                            </p>

                            <p>
                                <i class="fas fa-map-marker-alt mx-2"></i>
                                {{ $client->address }}
                            </p>

                        </div>  
                    </div>

                </div>

                <!-- End addresses-communicationsdata_First -->

                    </div>

                    <!-- Start Controls -->
                    
                    <div class="controls">

                        @if(auth()->check() && $client->user_id === auth()->user()->id)
                            <ul class="d-flex">
                            
                                <li>
                                    <i class="fas fa-pen"></i>
                                    <a href="{{ route('editClient', $client->id) }}">تعديل</a>
                                </li>

                                <li>
                                    <i class="fas fa-user-plus"></i>
                                    <a href="#">إضافة خدمة</a>
                                </li>

                                <li>
                                    <i class="fas fa-exchange-alt"></i>
                                    <a href="#">اضافة فرع</a>
                                </li>
                            </ul>
                        @endif
                    </div>

                    
                    <!-- End Controls -->

                </div>

                <!-- End avatar -->

            </div>

        <!-- End first Section-->

        </div>

    </div>

    <div class="container">
        <div class="row">
            <div class="col-12 text-right p-3 mb-4 client-description">
                {{ $client->description }}
            </div>
        </div>
    </div>
    
    <!-- End Company Profile -->

    

    <!-- Start Services Provided -->
    @if(count($client->pictures))
        <section class="services-provided">

            <div class="container">

                <h3>الصور</h3>

                <div class="services-provided-content">
                    
                        <div class="owl-carousel">
                            @foreach($client->pictures as $pictur)
                                <div class="mx-2"> 
                                    <img src="{{ asset('img/clients/'.$pictur->name) }}" class="img-thumbnail">
                                </div>
                            @endforeach
                        </div>

                </div>

            </div>

        </section>
    @endif

    <!-- End Services Provided -->


    <!-- Start Services Provided -->

    <section class="services-provided">

        <div class="container">

            <h3>الخدمات المقدمة</h3>

            <div class="services-provided-content">

                @forelse($client->services as $service)
                    @if($loop->iteration < 4)
                        
                        <div class="first section-content">

                            <div class="image-content">
                                <a href="">
                                    <img src="{{ asset('img/services/' . $service->logo) }}" alt="" height="100%" width="100%" />
                                </a>

                            </div>

                            <div class="content-par">
                                <a href="" class="taqiim-color">
                                    <h5 class="mb-2">{{ $service->name }}</h5>
                                </a>
                                <p class="h6">السعر : {{ $service->price  }} {{ $service->currency  }}</p>


                            </div>

                            <ul>
                                <input class="client-evaluated" value="{{ $service->rate }}" dir="rtl" data-size="sm">
                                <li>233</li>

                            </ul>

                            <div class="content-body">

                                <p> {{ $service->description }} </p>

                            </div>

                        </div>
                    @endif
                    

                @empty
                    <h3 class="text-center taqiim-color">
                        لايوجد خدمات مقدمة من {{ $client->name }}
                    </h3>
                @endforelse


            </div>

        </div>

    </section>

    <!-- End Services Provided -->

    <div class="spacer my-5"></div>

    <!-- Start Feedbacks And Followers -->

    <div class="feedbacks-followers mt-5">

        <div class="container">
            <form action="{{ route('evaluation', $client->id) }}" method="post">
                @csrf

                <div class="up-textarea">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="" dir="ltr">
                        <input name="evaluation" class="evaluation" value="0" dir="rtl" data-size="xl" >
                        <div class='clearfix'></div>
                    </div>

                </div>

            

                <textarea 
                    name="comment"
                    class="form-control {{ $errors->first('comment') ? 'is-invalid' : '' }}"
                    placeholder="تذكر ان تقييمك سوف يساعد الاخرين للتعرف علي هذا العمل. برجاء وضع تقييم مناسب ومفيد">{{ old('comment', isset($client) ? $client->comment : '') }}</textarea>
                    @if ($errors->first('comment'))
                        <div class="invalid-feedback">{{ $errors->first('comment') }}</div>
                    @endif

                <button type="submit"><i class="fas fa-paper-plane"></i>نشر</button>

            </form>

        </div>

    </div>

    <!-- End Feedbacks And Followers -->


    <!-- Start User Ratings -->

    <section class="user-ratings">

        <div class="container">

            <h3 class="text-right">تقيمات المستخدمين</h3>

            <div class="general-assessments">

                <div class="top font-weight-bold">
                    <p>
                        قيم هذا العمل 
                        <span class="text-danger">
                            {{ count($client->reviews) }}
                        </span>
                        {{ count($client->reviews) > 1 ? 'اشخاص' : 'شخص' }}
                    </p>
                </div>

                <section>
                   

                    <div class="progress mb-2">
                      <div class="progress-bar bg-success" role="progressbar" 
                            style="width: {{ getReviewByKey($client->id, 5) }}%" 
                            aria-valuenow="{{ getReviewByKey($client->id, 5) }}" 
                            aria-valuemin="0" 
                            aria-valuemax="100">
                            ممتاز
                      </div>
                    </div>

                    <div class="progress mb-2">
                      <div class="progress-bar bg-primary" role="progressbar" 
                            style="width: {{ getReviewByKey($client->id, 4) }}%" 
                            aria-valuenow="{{ getReviewByKey($client->id, 4) }}" 
                            aria-valuemin="0" 
                            aria-valuemax="100">
                            جيد جدا
                      </div>
                    </div>

                    <div class="progress mb-2">
                      <div class="progress-bar bg-info" role="progressbar" 
                            style="width: {{ getReviewByKey($client->id, 3) }}%" 
                            aria-valuenow="{{ getReviewByKey($client->id, 3) }}" 
                            aria-valuemin="0" 
                            aria-valuemax="100">
                            جيد
                      </div>
                    </div>

                    <div class="progress mb-2">
                      <div class="progress-bar bg-warning" role="progressbar" 
                            style="width: {{ getReviewByKey($client->id, 2) }}%" 
                            aria-valuenow="{{ getReviewByKey($client->id, 2) }}" 
                            aria-valuemin="0" 
                            aria-valuemax="100">
                            مقبول
                      </div>
                    </div>

                    <div class="progress mb-2">
                      <div class="progress-bar bg-danger" role="progressbar" 
                            style="width: {{ getReviewByKey($client->id, 1) }}%" 
                            aria-valuenow="{{ getReviewByKey($client->id, 1) }}" 
                            aria-valuemin="0" 
                            aria-valuemax="100">
                            ضعيف جدا
                      </div>
                    </div>

                </section>

            </div>

            <div class="user-ratings-content mt-4">

                @forelse($client->reviews as $review)
                   

                    <div class="first-rating rating-sec">

                        <div class="top mt-4 pb-4">

                            <div class="content">

                                <div class="content-right">

                                    <div class="content-img">

                                        <img 
                                            src="{{ $review->user->avatar ? asset('img/users/'. $review->user->avatar) 
                                                :  asset('img/man.png') }}" 
                                            width="100%" height="100%" />

                                    </div>

                                    <div class="content-par">

                                        <p>{{ $review->user->name }}</p>

                                        <p>{{ date('d-m-Y', strtotime($review->created_at)) }}</p>

                                    </div>

                                </div>

                            </div>

                            <p class="comment pr-5">
                                {{ $review->comment }}
                            </p>

                            <input class="comment-evaluated" value="{{ $review->evaluation }}" dir="rtl" data-size="xs">

                        </div>

                    </div>
                @empty
                    <h3 class="text-center taqiim-color">
                        لايوجد خدمات مقدمة من {{ $client->name }}
                    </h3>
                @endforelse



            </div>

        </div>

    </section>

    <!-- End User Ratings -->


@endsection


@section('script')

    <script src="{{ asset('front/plugins/js/star-rating.js') }}"></script>
    <script src="{{ asset('front/plugins/js/star-rating-ar.js') }}"></script>
    <script src="{{ asset('front/plugins/themes/krajee-fas/theme.js') }}"></script>
    <script src="{{ asset('front/plugins/js/owl.carousel.js') }}"></script>


<script>

    $(document).ready(function(){

        $(".owl-carousel").owlCarousel({
            nav: true,
            // loop: true
            items: 4,
            dots: false,
            margin: 10,
            center: true,
        });

        // Show starts for this client 
        $('.client-evaluated').rating({
            theme: 'krajee-fas',
            showClear: false,
            language: 'ar',
            filledStar: '<i class="fas fa-star"></i>',
            emptyStar: '<i class="fas fa-star"></i>',
            readonly: true,
            showCaption: false,
            showCaptionAsTitle: false
        });

        $('.comment-evaluated').rating({
            theme: 'krajee-fas',
            showClear: false,
            language: 'ar',
            filledStar: '<i class="fas fa-star"></i>',
            emptyStar: '<i class="fas fa-star"></i>',
            readonly: true,
            showCaption: false,
            showCaptionAsTitle: false
        });

        // Evaluation the Client
        $('.evaluation').rating({
            theme: 'krajee-fas',
            containerClass: 'is-star',
            language: 'ar',
            step: 1,
            showClear: false,
            showCaptionAsTitle: false,
            defaultCaption: '{rating} hearts',
            clearCaption: 'لم يتم التقييم',
            starCaptions: {
                1: 'ضعيف جدا',
                2: 'مقبول',
                3: 'جيد',
                4: 'جيد جدا',
                5: 'ممتاز'
            },
        });

        let userRatedClient = false;

        // Function to change star color after select star
        $('.evaluation').on('rating:change', function(event, value, caption) {
            // call function te get color            
            let starColor = getColorByValue(value);
            $('.rating-container .filled-stars').css('color', starColor);
        });

        // Function to return color hex based on value
        function getColorByValue(value) {

            let starColor = '#fde16d';
            switch (value) {
                case '1':
                    starColor = '#dc3545';
                    break;

                case '2':
                    starColor = '#ffc107';
                    break;

                case '3':
                    starColor = '#17a2b8';
                    break;

                case '4':
                    starColor = '#007bff';
                    break;

                case '5':
                    starColor = '#28a745';
                    break;
                default:
                    starColor = '#fde16d';
                    break;
            }

            return starColor;
        }

        {{-- Make Ajax to Follow or Unfollow --}}
        $(document).on('click', '.follow-btn', function(e){

            e.preventDefault();
            
            // Check if User Authenticated
            @if(!auth()->check())
                // If not, then go to Login Page
                window.location.href = '{{ route('login') }}';
            @else
                // If Auth, then Next
                var btn = $(this),
                    requestUrl = '{{ route('followClient', $client->id) }}',
                    type = btn.data('follow');

                    $.ajax({
                        type: 'POST',
                        url: requestUrl,
                        dataType: 'JSON',
                        data: {
                            type
                        },
                        cache: false,
                        beforeSend: function(){
                            // btn.hide(300);
                        },
                        success: function(data) {
                            if(data.suc)
                            {
                                btn.show();

                                // Change Followers Count
                                $('.followers-count').text(data.FCount)

                                // Swap Button
                                if (data.type == '0') {
                                    // change data
                                    btn.data('follow', '1')
                                    // change text
                                    btn.children('span').text('متابعة');
                                    // change icon
                                    btn.children('i').removeClass().addClass('fas fa-plus-circle')
                                }

                                if (data.type == '1') {
                                    
                                    btn.data('follow', '0')
                                    btn.children('span').text('الغاء المتابعة');
                                    btn.children('i').removeClass().addClass('fas fa-minus-circle')
                                }
                            }
                            if(data.err)
                            {
                                window.location.href = '{{ route('login') }}';
                            }

                        }
                    })
            @endif

        });
    });

</script>

@endsection
