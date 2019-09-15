@extends('layouts.app')

@section('content')


<h2 class="title mt-5 mb-3 text-center fb-500">
	{{ __('lang.whoWe') }}
</h2>


<div class="container">
	
	<div class="row mb-5">
		
		<div class="col-12 text-center">
			<img src="{{ asset('front/images/who-we-are.png') }}" alt="Widan Who We Are" class="img-fluid img-thumbnail">
		</div>

	</div>
	
	@if(getInfoByKey('message'))

		<div class="row mb-5">
			
			<h2 class="col-12 title mt-2 mb-3 text-center gr-color fb-500">
				{{ __('lang.message') }}
			</h2>
			
			<p class="lead col-12 text-center">
				{{ getInfoByKey('message')->infos_desc }}
			</p>

		</div>
	@endif

	@if(getInfoByKey('mission'))

		<div class="row mb-5">
			
			<h2 class="col-12 title mt-2 mb-3 text-center gr-color fb-500">
				{{ __('lang.mission') }}
			</h2>
			
			<p class="lead col-12 text-center">
				{{ getInfoByKey('mission')->infos_desc }}
			</p>

		</div>
	@endif


	@if(getInfoByKey('vision'))

		<div class="row mb-5">
			
			<h2 class="col-12 title mt-2 mb-3 text-center gr-color fb-500">
				{{ __('lang.vision') }}
			</h2>
			
			<p class="lead col-12 text-center">
				{{ getInfoByKey('vision')->infos_desc }}
			</p>

		</div>
	@endif


</div>



@endsection
