@extends('dashboard.app')


@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('lang.home') }}</li>
    <li class="breadcrumb-item"><a href="{{ route('admin.sliders.index') }}">{{ __('lang.sliders') }}</a></li>
      <li class="breadcrumb-item active">{{ __('lang.show') }}</li>
@endsection

@section('content')

<div class="row">
	<div class="col-12">
        
        <div class="card">
            <div class="card-block">

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('lang.sliders_title') }} :
                    </div>
                    <div class="col-sm-10">
                        {{ $slider->translate($showLang)->sliders_title }}
                    </div>
                </div>

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('lang.sliders_desc') }} :
                    </div>
                    <div class="col-sm-10">
                        {{ $slider->translate($showLang)->sliders_desc }}
                    </div>
                </div>

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('lang.sliders_desc') }} :
                    </div>
                    <div class="col-sm-10">
                        <img src="{{ asset('uploads/sliders/'.$slider->sliders_img) }}" class="img-fluid img-thumbnail" width="300px">
                    </div>
                </div>

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('lang.sliders_status') }} :
                    </div>
                    <div class="col-sm-10">
                        @if($slider->sliders_status == 1)
                            <strong class="text-success">{{ __('lang.'.$showLang.'.active') }}</strong>
                        @else
                            <strong class="text-danger">{{ __('lang.'.$showLang.'.stopped') }}</strong>
                        @endif
                    </div>
                </div>


            </div>
            <div class="card-footer">
                <a href="{{ route('admin.sliders.edit', $slider->id) }}" class="btn btn-warning">
                  Edit
                </a>

                <a href="{{ route('admin.sliders.index') }}" class="btn btn-secondary">
                  Back
                </a>
            </div>
        </div>


	</div>
</div>

@endsection
