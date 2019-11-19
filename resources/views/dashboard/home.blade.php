@extends('dashboard.app')

@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('lang.home') }}</li>
    {{-- <li class="breadcrumb-item"><a href="#">المستخدم</a></li> --}}
    <li class="breadcrumb-item active">{{ __('lang.dashboard') }}</li>
@endsection

@section('content')

<h1 class="m-b-3">
	{{ __('lang.welcomeDashboard') }}
</h1>

<div class="row dashboard-statistic">
	

	<div class="col-xs-6 col-lg-3">
        <a href="{{ route('admin.users.index') }}">        
	        <div class="card">
	            <div class="card-block p-a-1 clearfix">
	                <i class="icon-people bg-primary p-a-1 font-2xl m-r-1 {{ $currentLangDir == 'rtl' ? 'pull-right' : 'pull-left' }} "></i>
	                <div class="h5 text-primary m-b-0 m-t-h">
	                	{{ countRows('App\User') }}
	                </div>
	                <div class="text-muted text-uppercase font-weight-bold font-xs">{{ __('lang.users') }}</div>
	            </div>
	        </div>
        </a>
    </div>
    
    <div class="col-xs-6 col-lg-3">
    	<a href="{{ route('admin.services.index') }}">
	        <div class="card">
	            <div class="card-block p-a-1 clearfix">
	                <i class="icon-layers bg-danger p-a-1 font-2xl m-r-1 {{ $currentLangDir == 'rtl' ? 'pull-right' : 'pull-left' }} "></i>
	                <div class="h5 text-primary m-b-0 m-t-h">
	                	{{ countRows('App\Models\Service') }}
	                </div>
	                <div class="text-muted text-uppercase font-weight-bold font-xs">{{ __('lang.services') }}</div>
	            </div>
	        </div>
    	</a>
    </div>

    <div class="col-xs-6 col-lg-3">
    	<a href="{{ route('admin.blogs.index') }}">
	        <div class="card">
	            <div class="card-block p-a-1 clearfix">
	                <i class="icon-book-open bg-info p-a-1 font-2xl m-r-1 {{ $currentLangDir == 'rtl' ? 'pull-right' : 'pull-left' }} "></i>
	                <div class="h5 text-primary m-b-0 m-t-h">
	                	{{ countRows('App\Models\Blog') }}
	                </div>
	                <div class="text-muted text-uppercase font-weight-bold font-xs">
	                	{{ __('lang.blogs') }}
	                </div>
	            </div>
	        </div>
    	</a>
    </div>

    <div class="col-xs-6 col-lg-3">
        <a href="{{ route('admin.bookings.index') }}">        
	        <div class="card">
	            <div class="card-block p-a-1 clearfix">
	                <i class="icon-people bg-primary p-a-1 font-2xl m-r-1 {{ $currentLangDir == 'rtl' ? 'pull-right' : 'pull-left' }} "></i>
	                <div class="h5 text-primary m-b-0 m-t-h">
	                	{{ countRows('App\Models\Booking') }}
	                </div>
	                <div class="text-muted text-uppercase font-weight-bold font-xs">{{ __('lang.bookings') }}</div>
	            </div>
	        </div>
        </a>
    </div>

</div>

@endsection
