@extends('dashboard.app')


@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('lang.home') }}</li>
    <li class="breadcrumb-item"><a href="{{ route('admin.blogs.index') }}">{{ __('lang.blogs') }}</a></li>
      <li class="breadcrumb-item active">{{ __('lang.show') }}</li>
@endsection

@section('content')

<div class="row">
	<div class="col-12">
        
        <div class="card">
            <div class="card-block">

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('lang.blogs_title') }} :
                    </div>
                    <div class="col-sm-10">
                        {{ $blog->translate($showLang)->blogs_title }}
                    </div>
                </div>

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('lang.blogs_desc') }} :
                    </div>
                    <div class="col-sm-10">
                        {{ $blog->translate($showLang)->blogs_desc }}
                    </div>
                </div>

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('lang.blogs_desc') }} :
                    </div>
                    <div class="col-sm-10">
                        <img src="{{ asset('uploads/blogs/'.$blog->blogs_logo) }}" class="img-fluid img-thumbnail" width="300px">
                    </div>
                </div>

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('lang.blogs_status') }} :
                    </div>
                    <div class="col-sm-10">
                        @if($blog->blogs_status == 1)
                            <strong class="text-success">{{ __('lang.'.$showLang.'.active') }}</strong>
                        @else
                            <strong class="text-danger">{{ __('lang.'.$showLang.'.stopped') }}</strong>
                        @endif
                    </div>
                </div>


            </div>
            <div class="card-footer">
                <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="btn btn-warning">
                  Edit
                </a>

                <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary">
                  {{ __('lang.back') }}
                </a>
            </div>
        </div>


	</div>
</div>

@endsection
