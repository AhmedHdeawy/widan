

<div class="bg-white pt-4">
	<div class="container social-navbar">
		<div class="row align-items-center pb-2">
			
			<div class="col-12 col-md-8">
				
				<ul class="nav justify-content-lg-start justify-content-center mb-3 mb-lg-0">
				  <li class="nav-item">
				    <a class="nav-link" href="{{ getSettingByKey('facebook')->settings_value }}" target="_blank">
				    	{{-- <i class="fa fa-facebook"></i> --}}
				    	<img src="{{ asset('front/images/facebook.png') }}" alt="">
				    </a>
				  </li>

				  <li class="nav-item">
				    <a class="nav-link" href="{{ getSettingByKey('instagram')->settings_value }}" target="_blank">
				    	{{-- <i class="fa fa-instagram"></i> --}}
				    	<img src="{{ asset('front/images/instagram.png') }}" alt="">
				    </a>
				  </li>

				  <li class="nav-item">
				    <a class="nav-link" href="{{ getSettingByKey('twitter')->settings_value }}" target="_blank">
				    	{{-- <i class="fa fa-twitter"></i> --}}
				    	<img src="{{ asset('front/images/twitter.png') }}" alt="">
				    </a>
				  </li>
				  
				</ul>
			</div>
			
			<div class="col-12 col-md-4 gr-color social-phone text-center">
				
				<span>
					<i class="mx-1 fa fa-mobile"></i>
					<a target="_blank" class="gr-color" href="tel:{{ getSettingByKey('phone')->settings_value }}"> 
						{{ getSettingByKey('phone')->settings_value }} 
					</a>
				</span>
				<span class="mx-2">
					
					<i class="mx-1 fa fa-phone"></i>
					<a target="_blank" class="gr-color" href="tel:{{ getSettingByKey('mobile')->settings_value }}"> 
						{{ getSettingByKey('mobile')->settings_value }} 
					</a>
				</span>

			</div>

			<div class="col-12 d-md-none">
				
				<h2 class="title my-5 text-center fb-500">
					<a href="{{ route('booking') }}" class="btn btn-success btn-lg rounded-2 w-75"> {{ __('lang.bookingTitle') }} </a>
				</h2>

			</div>

		</div>

	</div>

</div>


<nav class="navbar navbar-expand-lg navbar-light bg-white">

	<div class="container">

		  <a class="navbar-brand" href="{{ route('home') }}">
		  	<img src="{{ asset('front/images/logo.png') }}" alt="Widan" class="img-fluid logo">
		  </a>
		  
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>

		  <div class="collapse navbar-collapse mx-4" id="navbarSupportedContent">

		    <ul class="navbar-nav {{ $currentLangDir == 'ltr' ? 'mr-auto' : '' }}">
		    
		      <li class="nav-item">
		        <a class="nav-link mx-2 fb-500" href="{{ route('home') }}"> {{ __('lang.home') }}</span></a>
		      </li>
		      
		      <li class="nav-item">
		        <a class="nav-link mx-2 fb-500" href="{{ route('about') }}"> {{ __('lang.about') }} </a>
		      </li>
		      
		      <li class="nav-item">
		        <a class="nav-link mx-2 fb-500" href="{{ route('services') }}">{{ __('lang.services') }}</a>
		      </li>

		      <li class="nav-item">
		        <a class="nav-link mx-2 fb-500" href="{{ route('blogs') }}">{{ __('lang.blogs') }}</a>
		      </li>

		      <li class="nav-item">
		        <a class="nav-link mx-2 fb-500" href="{{ route('contactus') }}">{{ __('lang.contactUs') }}</a>
		      </li>

		      <li class="nav-item">
		        <a class="nav-link mx-2 fb-500 btn btn-success rounded-2" href="{{ route('booking') }}">
		        	
		        	{{ __('lang.bookingTitle') }}
		        </a>
		      </li>

		    </ul>


		    <ul class="navbar-nav ml-auto">

				@if(auth()->check())
				      <li class="nav-item">
				        <a class="nav-link fb-500" href="{{ route('profile', auth()->user()->username ) }}">
				        	<img src="{{ auth()->user()->avatar ? asset('uploads/users/' . auth()->user()->avatar) : asset('front/images/man.png')  }}" class="img-fluid navbar-profile mx-1">
				        	{{ auth()->user()->name }}
				        </a>
				      </li>

				      <li class="nav-item">
				      	<form action="{{ route('logout') }}" method="post">
				      		@csrf
	                        <button type="submit" class="nav-link fb-500 btn-link logout-btn">
	                            {{ __('lang.logout') }}
	                        </button>
				      	</form>
				      </li>

				@else
				
			      <li class="nav-item">
			        <a class="nav-link fb-500" href="{{ route('login') }}">{{ __('lang.login') }}</a>
			      </li>

			      <li class="nav-item">
			        <a class="nav-link fb-500" href="{{ route('register') }}">{{ __('lang.register') }}</a>
			      </li>

				@endif

				<li class="nav-item">
			        <a class="nav-link fb-500" href="{{ str_replace( '/'.$localeLang,  '/'.$localeLangInverse, url()->full() ) }}">
			        	<i class="fa fa-globe"></i>	
			        	{{ __('lang.'.$localeLangInverse.'.inverse') }}
			    	</a>
			     </li>


		    </ul>

		  </div>

	</div>
</nav>


