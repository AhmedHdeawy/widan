@extends('dashboard.app')


@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard.categories') }}">Categories</a></li>
    <li class="breadcrumb-item active">Show</li>
@endsection

@section('content')


    <section class="show-details mt-4 no-padding-top">
    	<div class="container-fluid">
    		<div class="row bg-white has-shadow p-4">
    			<div class="col-12">

    				<div class="row py-4 show-details-item">
    					<div class="col-2">Name : </div>
    					<div class="col-10">{{ $category->name }}</div>
    				</div>
                    
                    @if(count($category->clients))
                        <div class="row py-4 show-details-item">
                            <div class="col-2">Clients : </div>
                            <div class="col-10">
                                @foreach($category->clients as $client)
                                    @if ($loop->last)
                                      <span class="text-primary">{{ $client->name }}</span>
                                    
                                    @else
                                      <span class="text-primary">{{ $client->name }}</span> 
                                      <strong class="text-danger"> - </strong> 
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endif

    				<div class="row py-4 show-details-item">
    					<div class="col-2">Logo : </div>
    					<div class="col-10">
    						<img src="{{ asset('img/categories/'.$category->logo) }}" class="img-fluid img-thumbnail">
    					</div>
    				</div>

    				<div class="row py-4 show-details-item">
    					<div class="col-2">Status : </div>
    					<div class="col-10">
    						
	    					@if($category->status == 1)
	    						<strong class="text-success">Active</strong>
	    					@else
								<strong class="text-danger">Stopped</strong>
	    					@endif
    					</div>
    				</div>

    				<div class="mt-2">
    					<a href="{{ route('dashboard.categories.edit', $category->id) }}" class="btn btn-warning">
                          Edit
                        </a>

                        <a href="{{ route('dashboard.categories') }}" class="btn btn-secondary">
                          Back
                        </a>
    				</div>

    			</div>
    		</div>
    	</div>
    </section>




@endsection
