@extends('layouts.app')

@section('content')

<h2 class="title my-5 text-center gr-color fb-500">
	{{ __('lang.blogs') }}
</h2>

{{-- Blog  / Start --}}

<div class="container blogs">
	
	<div class="row">
		
		@foreach($blogs as $blog)
			
			{{-- Check if This Blog Has Translation --}}

			@if($blog->blogs_title)
			
				<div class="col-12 col-md-4">
					<a href="{{ route('blog', $blog->id . '-' . make_slug($blog->blogs_title) ) }}">
						
						<div class="card mb-5">
						  <img class="card-img-top mb-2" src="{{ asset('uploads/blogs/' . $blog->blogs_logo) }}" alt="Card image cap">
						  <div class="card-title p-2">
						  		<h5> 
						  			<a href="{{ route('blog', $blog->id . '-' . make_slug($blog->blogs_title) ) }}">
						  				{{ str_limit(strip_tags($blog->blogs_title), 60, '...') }}
						  			</a> 
						  		</h5>
						  </div>
						  <div class="card-body p-2">
						    <p class="card-text">
						    	{{ str_limit(strip_tags($blog->blogs_desc), 170, '...') }}
						    </p>
						  </div>
						</div>
					</a>
				</div>

			@else
				{{-- Get another lang Details --}}
				<div class="col-12 col-md-4">

					<a href="{{ route('blog', $blog->id . '-' . make_slug($blog->translate($localeLangInverse)->blogs_title) ) }}">
						<div class="card mb-5">
						  <img class="card-img-top mb-2" src="{{ asset('uploads/blogs/' . $blog->blogs_logo) }}" alt="Card image cap">
						  <div class="card-title p-2">
						  		<h5> 
						  			<a href="{{ route('blog', $blog->id . '-' . make_slug($blog->translate($localeLangInverse)->blogs_title) ) }}">
						  				{{ str_limit(strip_tags($blog->translate($localeLangInverse)->blogs_title), 60, '...') }}
						  			</a> 
						  		</h5>
						  </div>
						  <div class="card-body p-2">
						    <p class="card-text">
						    	{{ str_limit(strip_tags($blog->translate($localeLangInverse)->blogs_desc), 170, '...') }}
						    </p>
						  </div>
						</div>
					</a>

				</div>

			@endif

		@endforeach


	</div>

</div>

{{-- Blogs  / End --}}


@endsection
