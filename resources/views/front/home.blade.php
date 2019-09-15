@extends('layouts.app')

@section('content')

{{-- Carousel / Start --}}

<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>

  <div class="carousel-inner">

	@foreach($sliders as $slider)

	    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
	      <img class="d-block w-100" src="{{ asset('uploads/sliders/' . $slider->sliders_img) }}" alt="{{ $slider->sliders_title }}">

	      <div class="carousel-caption">
		    <h4>{{ $slider->sliders_title }}</h4>
		    <p>{{ $slider->sliders_desc }}</p>
		  </div>
	    </div>
	    
	@endforeach()

  </div>
  
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>

</div>

{{-- Carousel / End --}}


<h2 class="title my-5 text-center fb-500">
	{{ __('lang.services') }}
</h2>

{{-- Services  / Start --}}

<div class="container our-services">
	
	<div class="row">
		
		@foreach($services as $service)

			<div class="col-12 col-md-4 mb-5">
				
				<a href="{{ route('service', $service->id . '-' . make_slug($service->services_title) ) }}">
					
					<div class="service-card">
						
					  <img class="img-fluid" src="{{ asset('uploads/services/' . $service->services_logo) }}" alt="Card image cap">

					  <div class="service-title p-3">

					  	<h5>
					  		
					  		<a href="{{ route('service', $service->id . '-' . make_slug($service->services_title) ) }}"> 
					  			{{ str_limit(strip_tags($service->services_title), 60, '...') }}
					  		</a> 
					  	</h5>
						 {{--  
						  <p>
						  	{{ str_limit(strip_tags($service->services_desc), 70, '...') }}
						  </p>
 --}}
					  </div>


					</div>
				</a>
				
			</div>
		@endforeach


	</div>

</div>

{{-- Services  / End --}}



<h2 class="title my-5 text-center fb-500">
	{{ __('lang.latestArticle') }}
</h2>

{{-- Blog  / Start --}}

<div class="container blogs">
	
	<div class="row">
		
		@foreach($blogs as $blog)

			<div class="col-12 col-md-4">
				<a href="{{ route('blog', $blog->id . '-' . make_slug($blog->blogs_title) ) }}">
					<div class="card mb-5">
					  <img class="card-img-top mb-2" src="{{ asset('uploads/blogs/' . $blog->blogs_logo) }}" alt="Card image cap">
					  <div class="card-title p-2">
					  		<h4> 
					  			<a href="{{ route('blog', $blog->id . '-' . make_slug($blog->blogs_title) ) }}">
					  				{{ str_limit(strip_tags($blog->blogs_title), 50, '...') }}
					  			</a> 
					  		</h4>
					  </div>
					  <div class="card-body p-2">
					    <p class="card-text">
					    	{{ str_limit(strip_tags($blog->blogs_desc), 170, '...') }}
					    </p>
					  </div>
					</div>
				</a>

			</div>
		@endforeach


	</div>

</div>

{{-- Blogs  / End --}}


<h2 class="title my-5 text-center fb-500">
	{{ __('lang.contactUs') }}
</h2>

{{-- Contact Us  / Start --}}

<div class="container contact-us mb-5 px-1 px-md-5">
	<div class="row">
		
		<div class="col-12 col-md-6">
			
			<div class="mapouter"><div class="gmap_canvas"><iframe width="400" height="300" id="gmap_canvas" src="https://maps.google.com/maps?q=%D8%A7%D9%84%D8%AE%D9%84%D9%8A%D8%AC%20%D8%A7%D9%84%D8%AA%D8%AC%D8%A7%D8%B1%D9%8A%20%2C%20%D8%AF%D8%A8%D9%8A&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://www.embedgooglemap.net/blog/20-off-discount-for-elegant-themes-divi-sale-coupon-code-2019/">divi discount code</a></div><style>.mapouter{position:relative;text-align:right;height:500px;width:600px;}.gmap_canvas {overflow:hidden;background:none!important;height:500px;width:600px;}</style></div>

		</div>

		<div class="col-12 col-md-6 p-0 p-md-4">
			
			<ul class="list-group list-group-flush">
			  <li class="list-group-item fb-400">
			  	<i class="mx-1 fa fa-phone"></i>
			  	<a target="_blank" href="tel:{{ getSettingByKey('phone')->settings_value }}"> {{ getSettingByKey('phone')->settings_value }} </a>
			  </li>

			  <li class="list-group-item fb-400">
			  	<i class="mx-1 fa fa-envelope-o"></i>
			  	<a target="_blank" href="mailto:{{ getSettingByKey('email')->settings_value }}"> {{ getSettingByKey('email')->settings_value }} </a>			  	
			  </li>

			   <li class="list-group-item fb-400">
			  	<i class="mx-1 fa fa-facebook"></i>
			  	<a target="_blank" href="{{ getSettingByKey('facebook')->settings_value }}">{{ getSettingByKey('facebook')->settings_value }}</a>
			  </li>

			   <li class="list-group-item fb-400">
			  	<i class="mx-1 fa fa-twitter"></i>
			  	<a target="_blank" href="{{ getSettingByKey('twitter')->settings_value }}">{{ getSettingByKey('twitter')->settings_value }}</a>
			  </li>

			   <li class="list-group-item fb-400">
			  	<i class="mx-1 fa fa-google"></i>
			  	<a target="_blank" href="{{ getSettingByKey('google')->settings_value }}">{{ getSettingByKey('google')->settings_value }}</a>
			  </li>

		</div>

	</div>
</div>


{{-- Contact Us  / End --}}



@endsection
