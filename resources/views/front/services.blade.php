@extends('layouts.app')

@section('content')

<h2 class="title my-5 text-center gr-color fb-500">
	{{ __('lang.services') }}
</h2>

{{-- Blog  / Start --}}

<div class="container blogs">
	
	<div class="row">
		
		@foreach($services as $service)

			<div class="col-12 col-md-4">
				<a href="{{ route('service', $service->id . '-' . make_slug($service->services_title) ) }}">
					<div class="card mb-5">
					  <img class="card-img-top mb-2" src="{{ asset('uploads/services/' . $service->services_logo) }}" alt="Card image cap">
					  <div class="card-title p-2">
					  		<h4> 
					  			<a class="gr-color" href="{{ route('service', $service->id . '-' . make_slug($service->services_title) ) }}">
					  				{{ $service->services_title }}
					  			</a> 
					  		</h4>
					  </div>
					  <div class="card-body p-2">
					    <p class="card-text">
					    	{{ substr($service->services_desc, 0, 150) }} ...
					    </p>
					  </div>
				  </a> 
				</div>

			</div>
		@endforeach


	</div>

</div>

{{-- Blogs  / End --}}


@endsection
