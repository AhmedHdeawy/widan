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


    				<div class="row py-4 show-details-item">
    					<div class="col-2">Name : </div>
    					<div class="col-10">{{ $branch->name }}</div>
    				</div>

                    <div class="row py-4 show-details-item">
                        <div class="col-2">Price : </div>
                        <div class="col-10">{{ $branch->price }} <span class="text-danger">{{ $branch->currency }}</span> </div>
                    </div>


                    <div class="row py-4 show-details-item">
                        <div class="col-2">Description : </div>
                        <div class="col-10">{{ $branch->description }}</div>
                    </div>

                    <div class="row py-4 show-details-item">
                        <div class="col-2">Details : </div>
                        <div class="col-10">{{ $branch->details }}</div>
                    </div>
                    

    				<div class="row py-4 show-details-item">
    					<div class="col-2">Status : </div>
    					<div class="col-10">
    						
	    					@if($branch->status == 0)
	    						<strong class="text-danger">Not Active</strong>
                            @else
                                <strong class="text-success">Active</strong>
	    					@endif
    					</div>
    				</div>

                    @if($branch->branch)
                        <div class="row py-4 show-details-item">
                            <div class="col-2">branch : </div>
                            <div class="col-10">
                                {{ $branch->branch->name }}
                            </div>
                        </div>
                    @endif


                    

                    @if(count($branch->pictures))
                        <div class="row py-4 show-details-item">
                            <div class="col-2">Pictures : </div>
                            <div class="col-10">
                                @foreach($branch->pictures as $picture)
                                    <img src="{{ asset('img/branches/'.$picture->name) }}" class="img-fluid img-thumbnail mr-2">
                                @endforeach
                            </div>
                        </div>
                    @endif


    				<div class="mt-2">
    					<a href="{{ route('dashboard.branches.edit', $branch->id) }}" class="btn btn-warning">
                          Edit
                        </a>

                        <a href="{{ route('dashboard.branches', $branch->client->id) }}" class="btn btn-secondary">
                          Back
                        </a>
    				</div>

    			</div>
    		</div>
    	</div>
    </section>




@endsection
