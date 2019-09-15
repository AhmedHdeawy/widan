@extends('dashboard.app')


@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('lang.home') }}</li>
    <li class="breadcrumb-item"><a href="{{ route('admin.bookings.index') }}">{{ __('lang.bookings') }}</a></li>
      <li class="breadcrumb-item active">{{ __('lang.show') }}</li>
@endsection

@section('content')

<div class="row">
    <div class="col-12">
        
        <div class="card">
            <div class="card-block">

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('lang.name') }} :
                    </div>
                    <div class="col-sm-10">
                        {{ $booking->name }}
                    </div>
                </div>

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('lang.phone') }} :
                    </div>
                    <div class="col-sm-10">
                        {{ $booking->phone }}
                    </div>
                </div>

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('lang.email') }} :
                    </div>
                    <div class="col-sm-10">
                        {{ $booking->email }}
                    </div>
                </div>

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('lang.address') }} :
                    </div>
                    <div class="col-sm-10">
                        {{ $booking->city . ' - ' . $booking->building . ' - ' . $booking->unit . ' - ' . $booking->street }}
                    </div>
                </div>

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('lang.service') }} :
                    </div>
                    <div class="col-sm-10">
                        {{ $booking->service->services_title }}
                    </div>
                </div>

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('lang.day') }} :
                    </div>
                    <div class="col-sm-10">
                        {{ $booking->day }}
                    </div>
                </div>

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('lang.time') }} :
                    </div>
                    <div class="col-sm-10">
                        {{ $booking->time_from  }} - {{ $booking->time_to }}
                    </div>
                </div>

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('lang.notes') }} :
                    </div>
                    <div class="col-sm-10">
                        {{ $booking->notes }}
                    </div>
                </div>

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('lang.status') }} :
                    </div>
                    <div class="col-sm-10">
                        @if($booking->status == 1)
                            <strong class="text-danger">{{ __('lang.active') }}</strong>
                        @else
                            <strong class="text-success">{{ __('lang.done') }}</strong>
                        @endif
                    </div>
                </div>


            </div>
            <div class="card-footer">
                {{-- <a href="{{ route('admin.bookings.edit', $booking->id) }}" class="btn btn-warning">
                  Edit
                </a> --}}

                <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary">
                  {{ __('lang.back') }}
                </a>
            </div>
        </div>


    </div>
</div>

@endsection
