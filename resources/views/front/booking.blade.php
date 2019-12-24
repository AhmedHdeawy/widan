@extends('layouts.app')

@section('content')



{{-- Contact Us  / Start --}}

<div class="container contact-us mb-5 mt-5 px-1 px-md-5">
	<div class="row justify-content-center align-items-center">

		<div class="col-12 col-lg-10">

			@if (session('status'))
				<div class="alert alert-success text-sm-center">
					<button class="close" type="button" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<h6>{{ session('status') }}</h6>
				</div>
			@endif

            @if ($errors->any())
                <div class="alert alert-danger text-sm-center">
                    @foreach ($errors->all() as $error)
                        <h6>{{ $error }}</h6>
                    @endforeach
                </div>
            @endif


            <!--Form with header-->
            <form action="{{ route('postBooking') }}" id="bookingForm" method="post">

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
                                <input type="text" class="form-control {{ $errors->first('name') ? 'is-invalid' : '' }}" id="name" name="name" placeholder="{{ __('lang.name') }}" 
                                value="{{ old('name') ? old('name') : auth()->check() ? auth()->user()->name : '' }}" >
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
                                value="{{ old('phone') ? old('phone') : auth()->check() ? auth()->user()->phone : '' }}" 
                                placeholder="{{ __('lang.phone') }}" >

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
                                value="{{ old('email') ? old('email') : auth()->check() ? auth()->user()->email : '' }}" 
                                placeholder="{{ __('lang.email') }}" >
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

                        <h5 class="mt-5 gr-color"> {{ __('lang.bookingDetails') }} </h5>
                        
                        {{-- Services --}}
                        <div class="form-group mb-5">
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
                        
                        {{-- Days --}}
                        <div class="form-group">
                            <div class="input-group mb-2 table-responsive-sm">
                                <h5 class="text-center gr-color col mb-3">
                                    {{ __('lang.selectDayYouWant') }}
                                </h5>
                                
                                <table class="table table-bordered days-table">
                                  <tbody>
                                    <tr>
                                        @foreach($days as $day)
                                            @php
                                                $datetime = new \DateTime($day->day);
                                            @endphp
                                              <th class="text-center day-item" data-id="{{ $day->id }}" data-day="{{ $datetime->format('Y-m-d') }}" scope="col">
                                                <span>
                                                    {{ __('lang.'.$datetime->format('D')) }}
                                                </span>
                                                  <div>
                                                      {{ $datetime->format('d') }}
                                                  </div>
                                              </th>
                                        @endforeach
                                    </tr>
                                  </tbody>
                                </table>
                            </div>
                        </div>


                        {{-- Spinner --}}
                        <div class="text-center col-12 loading-data mb-4 d-none">
                            <i class="fa fa-refresh gr-color fa-2x fa-spin"></i>
                        </div>
                        
                        {{-- Times --}}
                        <div class="form-group available-times d-none">
                            <div class="input-group mb-2 table-responsive-sm">
                                <h6 class="text-center gr-color col-12 mb-3">
                                    {{ __('lang.availableTimes') }}
                                </h6>
                                
                                <table class="table table-bordered days-table times-table">
                                  <tbody>
                                    <tr>
                                       {{-- Here will be filled after choose day --}}
                                    </tr>
                                  </tbody>
                                </table>
                            </div>
                        </div>

                        {{-- Errors --}}
                        <div class="text-center col-12 not-selected-day text-danger mb-4 d-none">
                            <i class="fa fa-exclamation-circle"></i>
                            {{ __('lang.mustSelectDay') }}
                        </div>

                        <div class="text-center col-12 not-selected-time text-danger mb-4 d-none">
                            <i class="fa fa-exclamation-circle"></i>
                            {{ __('lang.mustSelectTime') }}
                        </div>

                        <div class="text-center col-12 not-available-times text-danger mb-4 d-none">
                            <i class="fa fa-exclamation-circle"></i>
                            {{ __('lang.notAvailableTimes') }}
                        </div>
                        {{-- End / Errors --}}

                        {{-- Invoice Details --}}
                        <div class="card text-center invoice-details mt-5 d-none">

                          <div class="card-body">
                            <div class="gr-color">
                                <i class="fa fa-money fa-2x"></i>
                                <h2>{{ __('lang.details') }}</h2>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered">
                                  <thead>
                                    <tr>
                                       <th class="text-center" scope="col">{{ __('lang.day') }}</th>
                                       <th class="text-center" scope="col">{{ __('lang.time') }}</th>
                                       <th class="text-center" scope="col">{{ __('lang.price') }} {{ __('lang.withVat') }}</th>
                                    </tr>
                                  </thead>

                                  <tbody>
                                    <tr>
                                       <td class="invoice-day"></td>
                                       <td class="invoice-time"></td>
                                       <td class="invoice-price"></td>
                                    </tr>
                                  </tbody>

                                </table>

                            </div>
                          </div>
                        </div>

                        {{-- Notes --}}
                        <div class="form-group mt-5">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-comment text-success"></i></div>
                                </div>
                                <textarea rows="5" class="form-control {{ $errors->first('notes') ? 'is-invalid' : '' }}" name="notes" placeholder="{{ __('lang.notes') }}" >{{ old('notes') }}</textarea>
                                @if ($errors->first('notes'))
						            <div class="invalid-feedback">{{ $errors->first('notes') }}</div>
						        @endif
                            </div>
                        </div>

                        {{-- Hidden Inputs --}}
                        <input type="hidden" name="days_id" value="">
                        <input type="hidden" name="times_id" value="">

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


@section('script')

<script>
    
    {{-- Get Day that Selected to Retrieve Times that belongs to this Day --}}
    $('.day-item').click(function(event) {
        
        const btnClicked = $(this);
        let selectedDay = btnClicked.data('day');
        let DayID = btnClicked.data('id');

        // remove any error message
        $('.not-selected-day').addClass('d-none');

        // add hidden input with this Day ID as value
        $('#bookingForm').find('input[name=days_id]').val(DayID);
        // then empty old time id input
        $('#bookingForm').find('input[name=times_id]').val('');
        
        // remove background from other <th>
        btnClicked.siblings('th').removeClass('choosed').find('.day-checked').remove();
        // after reomve class, then focus on this day with gray color
        btnClicked.addClass('choosed');

        // Ajax to get avaiable times based on given Day
        $.ajax({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '{{ route('dayTimes') }}',
            type: 'POST',
            dataType: 'json',
            data: {
                day: selectedDay
            },
            cache: false,
            beforeSend: function(){
                // run spinner
                $('.loading-data').removeClass('d-none');
                // Hide Available Times Section
                $('.available-times').addClass('d-none');
            },
            success: function(data){
                
                if (data.length > 0) {

                    // Show Available times Section
                    $('.available-times').removeClass('d-none');
                    // Remove Old Times
                    $('.available-times table tr th').remove();

                    // Hide Error Message
                    $('.not-available-times').addClass('d-none');

                    // loop through data and show it
                    for (var i = 0; i < data.length; i++) {

                        $('.available-times table tr').append(`
                            <th class="text-center time-item" data-numHours="${data[i].num_of_hours}" data-id="${data[i].id}" scope="col">
                                ${ tConvert(data[i].time_from) } - ${ tConvert(data[i].time_to) }
                            </th>
                        `);
                    }

                    // Show Invoice Details
                    $('.invoice-details').removeClass('d-none')
                                        .find('.invoice-day')
                                        .text(btnClicked.text());

                } else {

                    // Show Error Message
                    $('.not-available-times').removeClass('d-none');
                }


            },
            error: function(){
                console.log('Error');
            },
            complete: function(){
                $('.loading-data').addClass('d-none');
            }

        });

    });

    // Get Time that Selected by the user
    $('body').on('click', '.time-item', function (){
        
        const btnClicked = $(this);
        let TimeID = btnClicked.data('id');

        // remove any error message
        $('.not-selected-time').addClass('d-none');

        // add hidden input with this Time ID as value
        $('#bookingForm').find('input[name=times_id]').val(TimeID);

        // remove background from other <th>
        btnClicked.siblings('th').removeClass('choosed').find('.day-checked').remove();
        // after reomve class, then focus on this day with gray color
        btnClicked.addClass('choosed');

        // Add check mark on choosed Day
        if ($('.days-table .choosed').find('.day-checked').length === 0) {

            $('.days-table').not('.times-table').find('.choosed').prepend(`
                <div class="day-checked">
                    <i class="fa fa-check-circle-o"></i>
                </div>
            `);
        }

        // Show Invoice Details
        const invoiceDetails = $('.invoice-details');
        invoiceDetails.removeClass('d-none');

        // Show Time
        invoiceDetails.find('.invoice-time').text(btnClicked.text());

        // Calculate Price
        let price = {{ $hourPrice }} * btnClicked.data('numhours');
        let vat = 0.05 * price
        let priceWithVat = vat + price;
        
        // Show it to the price
        invoiceDetails.find('.invoice-price').text(priceWithVat);

    });

    // before submit the form, check day and times selected
    $('#bookingForm').submit(function(event) {
        
        // Day input Valud
        let DayVal = $('#bookingForm').find('input[name=days_id]').val();
        let TiemVal = $('#bookingForm').find('input[name=times_id]').val();

        // if not select, show Error Message
        if (!DayVal) {
            $('.not-selected-day').removeClass('d-none');

        } else if (!TiemVal) {
            $('.not-selected-time').removeClass('d-none');

        }
        else {
            // submit the form
            return;
        }

        event.preventDefault();

    });


    /**
     * convert given time to AM/PM Format
     * @param  {String} timeString
     * @return {String}
     */
    function tConvert (timeString) {

        var H = + timeString.substr(0, 2);
        var h = (H % 12) || 12;
        var ampm = H < 12 ? "AM" : "PM";
        timeString = h + timeString.substr(2, 3) + ampm;
        return timeString;
    }


</script>


@endsection
