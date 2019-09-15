@extends('layouts.app')

@section('content')


{{-- Blog  / Start --}}

<div class="container blogs mt-5">
	
	@if($blog->blogs_title)
		<div class="row">

			<div class="col-12 text-center mb-3">
				<img src="{{ asset('uploads/blogs/' . $blog->blogs_logo) }}" alt="" class="img-fluid img-thumbnail">
			</div>
			
			<h3 class="col-12 mb-3">
				{{ $blog->blogs_title }}
			</h3>

			<div class="col-12 mb-4">
				<p>
					{{ $blog->blogs_desc }}
				</p>
			</div>


		</div>
	@else

		<div class="row">

			<div class="col-12 text-center mb-3">
				<img src="{{ asset('uploads/blogs/' . $blog->blogs_logo) }}" alt="" class="img-fluid img-thumbnail">
			</div>
			
			<h3 class="col-12 mb-3">
				{{ $blog->translate($localeLangInverse)->blogs_title }}
			</h3>

			<div class="col-12 mb-4">
				<p>
					{{ $blog->translate($localeLangInverse)->blogs_desc }}
				</p>
			</div>


		</div>

	@endif

</div>

{{-- Blogs  / End --}}


@endsection
