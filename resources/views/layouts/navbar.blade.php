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
		      <li class="nav-item active">
		        <a class="nav-link mx-2 fb-500" href="{{ route('home') }}"> {{ __('lang.home') }} <span class="sr-only">(current)</span></a>
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
		        <a class="nav-link mx-2 fb-500" href="{{ route('booking') }}">{{ __('lang.bookings') }}</a>
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


