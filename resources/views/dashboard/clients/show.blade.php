@extends('dashboard.app')


@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard.clients') }}">Clients</a></li>
    <li class="breadcrumb-item active">Show</li>
@endsection

@section('content')


    <section class="show-details mt-4 no-padding-top">
    	<div class="container-fluid">
    		<div class="row bg-white has-shadow p-4">
    			<div class="col-12">

                    @if(count($client->categories))
                        <div class="row py-4 show-details-item">
                            <div class="col-2">Categories : </div>
                            <div class="col-10">
                                @foreach($client->categories as $category)
                                    
                                    @if ($loop->last)
                                      <span class="text-primary">{{ $category->name }}</span>
                                    
                                    @else
                                      <span class="text-primary">{{ $category->name }}</span> 
                                      <strong class="text-danger"> - </strong> 
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endif

    				<div class="row py-4 show-details-item">
    					<div class="col-2">Name : </div>
    					<div class="col-10">{{ $client->name }}</div>
    				</div>

                    <div class="row py-4 show-details-item">
                        <div class="col-2">Email : </div>
                        <div class="col-10">{{ $client->email }}</div>
                    </div>

                    <div class="row py-4 show-details-item">
                        <div class="col-2">Phone : </div>
                        <div class="col-10">{{ $client->phone }}</div>
                    </div>

                    <div class="row py-4 show-details-item">
                        <div class="col-2">Description : </div>
                        <div class="col-10">{{ $client->description }}</div>
                    </div>

                    <div class="row py-4 show-details-item">
                        <div class="col-2">Address : </div>
                        <div class="col-10">{{ $client->address }}</div>
                    </div>
                    

    				<div class="row py-4 show-details-item">
    					<div class="col-2">Logo : </div>
    					<div class="col-10">
    						<img src="{{ asset('img/clients/'.$client->logo) }}" class="img-fluid img-thumbnail">
    					</div>
    				</div>

    				<div class="row py-4 show-details-item">
    					<div class="col-2">Status : </div>
    					<div class="col-10">
    						
	    					@if($client->status == 0)
	    						<strong class="text-primary">Not Active</strong>
	    					@elseif($client->status == 1)
								<strong class="text-success">Active</strong>
                            @else
                                <strong class="text-danger">Stopped</strong>
	    					@endif
    					</div>
    				</div>


                    @if(count($client->services))
                        <div class="row py-4 show-details-item">
                            <div class="col-2">Services : </div>
                            <div class="col-10">
                                @foreach($client->services as $service)
                                    @if ($loop->last)
                                      <span class="text-primary">{{ $service->name }}</span>
                                    @else
                                      <span class="text-primary">{{ $service->name }}</span> 
                                      <strong class="text-danger"> - </strong> 
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if(count($client->pictures))
                        <div class="row py-4 show-details-item">
                            <div class="col-2">Pictures : </div>
                            <div class="col-10">
                                @foreach($client->pictures as $picture)
                                    <img src="{{ asset('img/clients/'.$picture->name) }}" class="img-fluid img-thumbnail mr-2">
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="row py-4 show-details-item">
                        <div class="col-2">User : </div>
                        <div class="col-10">{{ $client->user->name }}</div>
                    </div>

                    <div class="row py-4 show-details-item">
                        <div class="col-2">City : </div>
                        <div class="col-10">{{ $client->city->name }}</div>
                    </div>
                    

    				<div class="mt-2">
    					<a href="{{ route('dashboard.clients.edit', $client->id) }}" class="btn btn-warning">
                          Edit
                        </a>

                        <a href="{{ route('dashboard.clients') }}" class="btn btn-secondary">
                          Back
                        </a>
    				</div>

    			</div>
    		</div>
    	</div>
    </section>




@endsection
