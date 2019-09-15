@extends('layouts.app')

@section('content')


{{-- Blog  / Start --}}

<div class="container blogs mt-5">
	
	<div class="row">

		<div class="col-12 text-center mb-3">
			<img src="{{ asset('uploads/services/' . $service->services_logo) }}" alt="" class="img-fluid img-thumbnail">
		</div>
		
		<h3 class="col-12 mb-3">
			{{ $service->services_title }}
		</h3>

		<div class="col-12 mb-4">
			<p>
				{{ $service->services_desc }}
			</p>
		</div>


	</div>

</div>

{{-- Blogs  / End --}}


@endsection
