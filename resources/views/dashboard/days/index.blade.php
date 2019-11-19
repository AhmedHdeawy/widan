@extends('dashboard.app')


@section('breadcrumb')
  <li class="breadcrumb-item">{{ __('lang.home') }}</li>
  {{-- <li class="breadcrumb-item"><a href="#">المستخدم</a></li> --}}
  <li class="breadcrumb-item active">{{ __('lang.daysTimes') }}</li>
@endsection

@section('content')

  @include('dashboard.includes.status')



<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-block">
        
        <form action="{{ route('admin.days.index') }}" method="get" class="form-inline">

            <div class="form-group">
                <input type="date" name="day" class="form-control" value="{{ old('day') }}" placeholder="{{ __('lang.day') }}">
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
              <i class="fa fa-align-justify"></i> {{ __('lang.days') }}

              <a href="{{ route('admin.days.create') }}" class="btn btn-success btn-create {{ $currentLangDir == 'rtl' ? 'pull-left' : 'pull-right' }}">
                <i class="icon-plus"></i> {{ __('lang.create') }}
              </a>
          </div>

          <div class="card-block">
            
            @if(count($days) < 1)
              <div class="row">                
                <h4 class="col-12 text-danger text-xs-center"> {{ __('lang.noData') }} </h4>
              </div>
            @else

                <table class="table table-bordered table-striped table-condensed">
                    {{-- Table Header --}}
                    <thead>
                        <tr>
                            <th class="text-sm-center">{{ __('lang.day') }}</th>
                            <th class="text-sm-center">{{ __('lang.time_from') }}</th>
                            <th class="text-sm-center">{{ __('lang.time_to') }}</th>
                            <th class="text-sm-center">{{ __('lang.times') }}</th>
                            <th class="text-sm-center">{{ __('lang.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>

                      @foreach($days as $day)                    
                          <tr class="text-sm-center">

                              <td> 
                                @php
                                  $datetime = new \DateTime($day->day);
                                @endphp
                                {{ __('lang.'.$datetime->format('D'))  }} ( {{ $day->day }} )
                              </td>
                              <td>                                 
                                  @foreach($day->times()->limit(3)->get() as $time)
                                    @if($loop->last)
                                      {{ $time->time_from }}
                                    @else
                                      {{ $time->time_from }} <br> <hr>
                                    @endif
                                  @endforeach
                              </td>

                              <td>
                                @foreach($day->times()->limit(3)->get() as $time)
                                  @if($loop->last)
                                    {{ $time->time_to }}
                                  @else
                                    {{ $time->time_to }} <br> <hr>
                                  @endif
                                @endforeach
                              </td>

                              <td>
                                @foreach($day->times()->limit(3)->get() as $time)
                                  @if($loop->last)
                                    <a href="{{ route('admin.days.deleteTime', $time->id) }}" class="btn btn-danger btn-sm">
                                      <i class="icon-trash"></i>
                                    </a>
                                  @else
                                    <a href="{{ route('admin.days.deleteTime', $time->id) }}" class="btn btn-danger btn-sm">
                                      <i class="icon-trash"></i>
                                    </a>
                                    <br> <hr>
                                  @endif
                                @endforeach
                                

                              </td>
                              
                              <td>
                                <a href="{{ route('admin.days.show', $day->id) }}" 
                                    class="btn btn-primary btn-sm">
                                  <i class="icon-eye"></i> {{ __('lang.view') }}
                                </a>

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
