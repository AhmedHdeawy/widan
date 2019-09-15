@extends('layouts.app')

@section('content')



{{-- Contact Us  / Start --}}

<div class="container contact-us mb-5 mt-5 px-1 px-md-5">
	<div class="row justify-content-center align-items-center">

		<div class="col-12 col-md-8">

			@if (session('status'))
				<div class="alert alert-success text-sm-center">
					<button class="close" type="button" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<h6>{{ session('status') }}</h6>
				</div>
			@endif


            <!--Form with header-->
            <form action="{{ route('postBooking') }}" method="post">

				@csrf

                <div class="card border-success rounded-0">
                    <div class="card-header p-0">
                        <div class="bg-success text-white text-center py-2">
                            <h3><i class="fa fa-shopping-cart"></i> {{ __('lang.bookingTitle') }} </h3>
                            <p class="m-0">{{ __('lang.bookingHint') }}</p>
                        </div>
                    </div>
                    <div class="card-body p-3">

                        <!--Body-->

                        <h5 class="mt-3 gr-color"> {{ __('lang.personalDetails') }} </h5>
                        <div class="form-group">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-user text-success"></i></div>
                                </div>
                                <input type="text" class="form-control {{ $errors->first('name') ? 'is-invalid' : '' }}" id="name" name="name" placeholder="{{ __('lang.name') }}" value="{{ old('name') ? old('name') : auth()->user()->name }}" >
                                @if ($errors->first('name'))
						            <div class="invalid-feedback">{{ $errors->first('name') }}</div>
						          @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-phone text-success"></i></div>
                                </div>
                                <input type="text" class="form-control {{ $errors->first('phone') ? 'is-invalid' : '' }}" id="phone" name="phone" 
                                value="{{ old('phone') ? old('phone') : auth()->user()->phone }}" placeholder="{{ __('lang.phone') }}" >

                                @if ($errors->first('phone'))
						            <div class="invalid-feedback">{{ $errors->first('phone') }}</div>
						        @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-envelope text-success"></i></div>
                                </div>
                                <input type="email" class="form-control {{ $errors->first('email') ? 'is-invalid' : '' }}" id="email" name="email" 
                                value="{{ old('email') ? old('email') : auth()->user()->email }}" placeholder="{{ __('lang.email') }}" >
                                @if ($errors->first('email'))
						            <div class="invalid-feedback">{{ $errors->first('email') }}</div>
						        @endif
                            </div>
                        </div>


                        <h5 class="mt-5 gr-color"> {{ __('lang.locationDetails') }} </h5>

                        <div class="form-group">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-location-arrow text-success"></i></div>
                                </div>
                                <input type="text" class="form-control {{ $errors->first('city') ? 'is-invalid' : '' }}" id="city" name="city" value="{{ old('city') }}" placeholder="{{ __('lang.city') }}" >

                                @if ($errors->first('city'))
                                    <div class="invalid-feedback">{{ $errors->first('city') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-map-marker text-success"></i></div>
                                </div>
                                <input type="text" class="form-control {{ $errors->first('building') ? 'is-invalid' : '' }}" id="building" name="building" value="{{ old('building') }}" placeholder="{{ __('lang.building') }}" >

                                @if ($errors->first('building'))
                                    <div class="invalid-feedback">{{ $errors->first('building') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-map-marker text-success"></i></div>
                                </div>
                                <input type="text" class="form-control {{ $errors->first('unit') ? 'is-invalid' : '' }}" id="unit" name="unit" value="{{ old('unit') }}" placeholder="{{ __('lang.unit') }}" >

                                @if ($errors->first('unit'))
                                    <div class="invalid-feedback">{{ $errors->first('unit') }}</div>
                                @endif
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-map-marker text-success"></i></div>
                                </div>
                                <input type="text" class="form-control {{ $errors->first('street') ? 'is-invalid' : '' }}" id="street" name="street" value="{{ old('street') }}" placeholder="{{ __('lang.street') }}" >

                                @if ($errors->first('street'))
                                    <div class="invalid-feedback">{{ $errors->first('street') }}</div>
                                @endif
                            </div>
                        </div>


                        <h5 class="mt-3 gr-color"> {{ __('lang.bookingDetails') }} </h5>

                        <div class="form-group">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fa fa-calendar text-success"></i> <span class="mx-1 gr-color fb-500">{{ __('lang.selectService') }}</span>
                                    </div>
                                </div>
                                <select name="service_id" id="service" class="form-control {{ $errors->first('service') ? 'is-invalid' : '' }}">
                                    @foreach($services as $service)
                                            '<option value="{{ $service->id }}"> {{ $service->services_title }} </option>';
                                    @endforeach
                                </select>
                               
                                @if ($errors->first('service'))
                                    <div class="invalid-feedback">{{ $errors->first('service') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fa fa-calendar text-success"></i> <span class="mx-1 gr-color fb-500">{{ __('lang.day') }}</span>
                                    </div>
                                </div>
                                <select name="day" id="day" class="form-control {{ $errors->first('day') ? 'is-invalid' : '' }}">
                                    @foreach($days as $day)
                                            {!! $day !!}
                                    @endforeach
                                </select>
                               
                                @if ($errors->first('day'))
                                    <div class="invalid-feedback">{{ $errors->first('day') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fa fa-clock-o text-success"></i> <span class="mx-1 gr-color fb-500">{{ __('lang.time_from') }}</span>
                                    </div>
                                </div>
                                <select name="time_from" id="time_from" class="form-control {{ $errors->first('time_from') ? 'is-invalid' : '' }}">
                                    @foreach($times as $time)
                                            {!! $time !!}
                                    @endforeach
                                </select>
                               
                                @if ($errors->first('time_from'))
                                    <div class="invalid-feedback">{{ $errors->first('time_from') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fa fa-clock-o text-success"></i> <span class="mx-1 gr-color fb-500">{{ __('lang.time_to') }}</span>
                                    </div>
                                </div>
                                <select name="time_to" id="time_to" class="form-control {{ $errors->first('time_to') ? 'is-invalid' : '' }}">
                                    @foreach($times as $time)
                                            {!! $time !!}
                                    @endforeach
                                </select>
                               
                                @if ($errors->first('time_to'))
                                    <div class="invalid-feedback">{{ $errors->first('time_to') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-comment text-success"></i></div>
                                </div>
                                <textarea class="form-control {{ $errors->first('notes') ? 'is-invalid' : '' }}" name="notes" placeholder="{{ __('lang.notes') }}" >{{ old('notes') }}</textarea>
                                @if ($errors->first('notes'))
						            <div class="invalid-feedback">{{ $errors->first('notes') }}</div>
						        @endif
                            </div>
                        </div>

                        <div class="text-center">
                            <input type="submit" value="{{ __('lang.send') }}" class="btn btn-success btn-block rounded-0 py-2">
                        </div>
                    </div>

                </div>
            </form>
            <!--Form with header-->

		</div>

	</div>
</div>


{{-- Contact Us  / End --}}



@endsection
