@extends('dashboard.app')


@section('breadcrumb')
  <li class="breadcrumb-item">{{ __('lang.home') }}</li>
  {{-- <li class="breadcrumb-item"><a href="#">المستخدم</a></li> --}}
  <li class="breadcrumb-item active">{{ __('lang.bookings') }}</li>
@endsection

@section('content')

  @include('dashboard.includes.status')



<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-block">
        
        <form action="{{ route('admin.bookings.index') }}" method="get" class="form-inline">

 {{--            <div class="form-group">
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" placeholder="{{ __('lang.name') }}">
            </div>

            <div class="form-group">
                <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone') }}" placeholder="{{ __('lang.phone') }}">
            </div>

            <div class="form-group">
                <input type="text" id="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="{{ __('lang.email') }}">
            </div> --}}

            <div class="form-group">
                <select id="status" name="status" class="form-control select-search" size="1">
                    <option value="">{{ __('lang.status') }}</option>
                    <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>{{ __('lang.active') }}</option>
                    <option value="2" {{ old('status') == '2' ? 'selected' : '' }}>{{ __('lang.done') }}</option>
                </select>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                  <i class="fa fa-dot-circle-o"></i> {{ __('lang.search') }}
                </button>
            </div>

            <div class="form-group">
                <button type="button" class="btn btn-danger reset-form">
                  <i class="fa fa-ban"></i> {{ __('lang.reset') }}
                </button>
            </div>
        </form>

      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-12">
      <div class="card">
          <div class="card-header">
              <i class="fa fa-align-justify"></i> {{ __('lang.bookings') }}

          </div>

          <div class="card-block">
            
            @if(count($bookings) < 1)
              <div class="row">                
                <h4 class="col-12 text-danger text-xs-center"> {{ __('lang.noData') }} </h4>
              </div>
            @else

                <table class="table table-bordered table-striped table-condensed">
                    {{-- Table Header --}}
                    <thead>
                        <tr>
                            <th class="text-sm-center">{{ __('lang.name') }}</th>
                            <th class="text-sm-center">{{ __('lang.phone') }}</th>
                            <th class="text-sm-center">{{ __('lang.day') }}</th>
                            <th class="text-sm-center">{{ __('lang.address') }}</th>
                            <th class="text-sm-center">{{ __('lang.status') }}</th>
                            <th class="text-sm-center">{{ __('lang.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>

                      @foreach($bookings as $booking)                    
                          <tr class="text-sm-center">

                              <td> {{ $booking->name }} </td>
                              <td> {{ $booking->phone }} </td>
                              <td> {{ $booking->day->day }} </td>
                              <td> 
                                  {{ $booking->city . ' - ' . $booking->building }}
                              </td>

                              <td> 
                                  @if($booking->status == 1)
                                      <strong class="text-danger">{{ __('lang.active') }}</strong>
                                  @else
                                      <strong class="text-success">{{ __('lang.done') }}</strong>
                                  @endif
                              </td>

                              <td>
                                <a href="{{ route('admin.bookings.show', $booking->id) }}" 
                                    class="btn btn-primary btn-sm">
                                  <i class="icon-eye"></i> {{ __('lang.view') }}
                                </a>

                                @if($booking->status == 1)
                                    <a href="{{ route('admin.bookings.doneBooking', $booking->id) }}" class="btn btn-success btn-sm">
                                      {{ __('lang.done') }}
                                    </a>
                                @endif

                                {{-- <a href="{{ route('admin.bookings.edit', $booking->id) }}" class="btn btn-warning btn-sm">
                                  <i class="icon-pencil"></i>
                                </a>

                                <form method="post" action="{{ route('admin.bookings.destroy', $booking->id) }}" class="d-inline-block">
                                  @csrf
                                  @method('delete')
                                  <button class="btn btn-danger btn-sm delete-form" type="submit">
                                    <i class="icon-trash"></i>
                                  </button>
                                </form> --}}

                              </td>

                          </tr>
                      @endforeach
                    </tbody>
                </table>

            @endif

          </div>
      </div>
  </div>
  <!--/col-->
</div>


@endsection
