@extends('dashboard.app')


@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('lang.home') }}</li>
    <li class="breadcrumb-item"><a href="{{ route('admin.days.index') }}">{{ __('lang.daysTimes') }}</a></li>
      <li class="breadcrumb-item active">{{ __('lang.show') }}</li>
@endsection

@section('content')

<div class="row">
    <div class="col-12">
        
        <div class="card">
            <div class="card-block">

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('lang.day') }} :
                    </div>
                    <div class="col-sm-10">
                        @php
                          $datetime = new \DateTime($day->day);
                        @endphp
                        {{ __('lang.'.$datetime->format('D'))  }} ( {{ $day->day }} )
                    </div>
                </div>

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('lang.times') }} :
                    </div>
                    <div class="col-sm-10">

                      <table class="table table-bordered table-striped table-condensed">
                        {{-- Table Header --}}
                        <thead>
                            <tr>
                                <th class="text-sm-center">{{ __('lang.time_from') }}</th>
                                <th class="text-sm-center">{{ __('lang.time_to') }}</th>
                                <th class="text-sm-center">{{ __('lang.nom_of_hours') }}</th>
                                <th class="text-sm-center">{{ __('lang.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>

                          @foreach($day->times as $time)                    
                              <tr class="text-sm-center">

                                  <td>                                 
                                    {{ $time->time_from }}
                                      
                                  </td>

                                  <td>
                                    {{ $time->time_to }}
                                  </td>

                                  <td>
                                    {{ $time->num_of_hours }}
                                  </td>

                                  <td>
                                    <a href="{{ route('admin.days.deleteTime', $time->id) }}" class="btn btn-danger btn-sm">
                                      <i class="icon-trash"></i>
                                    </a>
                                    
                                  </td>

                              </tr>
                          @endforeach
                        </tbody>
                    </table>

                    </div>
                </div>


            </div>
            <div class="card-footer">
                <a href="{{ route('admin.days.index') }}" class="btn btn-secondary">
                  {{ __('lang.back') }}
                </a>
            </div>
        </div>


    </div>
</div>

@endsection
