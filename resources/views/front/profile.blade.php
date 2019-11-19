@extends('layouts.app')

@section('content')




{{-- Profile Data  / Start --}}

<div class="container contact-us mb-5 mt-5 px-1 px-md-5">
    <div class="row justify-content-center align-items-center">

        <div class="col-12 col-md-10">

           <div class="card border-success rounded-0">
                <div class="card-header p-0">
                    <div class="bg-success text-white text-center py-2">
                        <h3><i class="fa fa-shopping-cart"></i> {{ __('lang.yourBooking') }} </h3>
                        <p class="m-0">{{ __('lang.yourBookingHint') }}</p>
                    </div>
                </div>
                <div class="card-body p-3">
                    @foreach(auth()->user()->bookings as $booking)

                        <div class="card mb-3">
                          <div class="card-body">
                            
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <b>{{ __('lang.title') }} : </b>
                                        {{ $booking->city . ' - ' . $booking->building . ' - ' . $booking->unit . ' - ' . $booking->street }}
                                    </li>
                                    <li class="list-group-item">
                                        <b>{{ __('lang.day') }} :</b>
                                        {{ $booking->day->day }}
                                    </li>
                                    <li class="list-group-item">
                                        <b>{{ __('lang.time_from') }} :</b>
                                        {{ $booking->time->time_from }}
                                    </li>
                                    <li class="list-group-item">
                                        <b>{{ __('lang.time_to') }} :</b>
                                        {{ $booking->time->time_to }}
                                    </li>
                                    <li class="list-group-item">
                                        <b>{{ __('lang.price') }} :</b>
                                        {{ $booking->price }}
                                    </li>
                                    <li class="list-group-item">
                                        <b>{{ __('lang.notes') }} :</b>
                                        {{ $booking->notes }}
                                    </li>
                                </ul>
                          </div>
                        </div>

                    @endforeach
                </div>

            </div>

        </div>

    </div>
</div>

{{-- Profile Data  / End --}}


{{-- Profile Data  / Start --}}

<div class="container contact-us mb-5 mt-5 px-1 px-md-5">
	<div class="row justify-content-center align-items-center">

		<div class="col-12 col-md-10">

			@if (session('status'))
				<div class="alert alert-success text-sm-center">
					<button class="close" type="button" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<h6>{{ session('status') }}</h6>
				</div>
			@endif


            <!--Form with header-->
            <form action="{{ route('updateProfile') }}" method="post" enctype="multipart/form-data">

				@csrf

                <div class="card border-success rounded-0">
                    <div class="card-header p-0">
                        <div class="bg-success text-white text-center py-2">
                            <h3><i class="fa fa-shopping-cart"></i> {{ __('lang.profileTitle') }} </h3>
                            <p class="m-0">{{ __('lang.profileHint') }}</p>
                        </div>
                    </div>
                    <div class="card-body p-3">

                        <!--Body-->

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

                        <div class="form-group">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-lock text-success"></i></div>
                                </div>
                                <input type="password" class="form-control {{ $errors->first('password') ? 'is-invalid' : '' }}" id="password" name="password" placeholder="{{ __('lang.password') }}" value="" >
                                @if ($errors->first('password'))
                                    <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                                  @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-lock text-success"></i></div>
                                </div>
                                <input type="password" class="form-control {{ $errors->first('password_confirmation') ? 'is-invalid' : '' }}" id="password_confirmation" name="password_confirmation" placeholder="{{ __('lang.password_confirmation') }}" value="" >
                                @if ($errors->first('password_confirmation'))
                                    <div class="invalid-feedback">{{ $errors->first('password_confirmation') }}</div>
                                  @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group mb-2">
                                {{-- <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-lock text-success"></i></div>
                                </div> --}}
                                @include('dashboard.includes.uploadImage', 
                                  ['name' =>  'avatar', 'value' =>  auth()->check() ? auth()->user()->avatar : null, 'path' =>  'uploads/users/']
                                )

                                @if ($errors->first('avatar'))
                                    <div class="invalid-feedback">{{ $errors->first('avatar') }}</div>
                                  @endif
                            </div>
                        </div>

                        <div class="text-center">
                            <input type="submit" value="{{ __('lang.update') }}" class="btn btn-success btn-block rounded-0 py-2">
                        </div>
                    </div>

                </div>
            </form>
            <!--Form with header-->

		</div>

	</div>
</div>

{{-- Profile Data  / End --}}



@endsection
