
<h5 class="text-primary m-b-h">
  {{ __('lang.staticData') }}
</h5>




<div class="form-group row">
      <label class="col-md-3 form-control-label" for="day"> {{ __('lang.day') }} </label>
      <div class="col-md-9">

          <select name="day" id="day" class="form-control {{ $errors->first('day') ? 'is-invalid' : '' }}">
              @foreach($days as $day)
                      {!! $day !!}
              @endforeach
          </select>
          
          @if ($errors->first('day'))
            <div class="invalid-feedback text-danger">{{ $errors->first('day') }}</div>
          @endif

      </div>
</div>


<div class="form-group row">
      <label class="col-md-3 form-control-label" for="day"> {{ __('lang.time_from') }} </label>
      <div class="col-md-9">

          <select name="time_from" id="time_from" class="form-control {{ $errors->first('time_from') ? 'is-invalid' : '' }}">
              @foreach($times as $time)
                      {!! $time !!}
              @endforeach
          </select>
          
          @if ($errors->first('time_from'))
            <div class="invalid-feedback text-danger">{{ $errors->first('time_from') }}</div>
          @endif

      </div>
</div>


<div class="form-group row">
      <label class="col-md-3 form-control-label" for="day"> {{ __('lang.time_to') }} </label>
      <div class="col-md-9">

          <select name="time_to" id="time_to" class="form-control {{ $errors->first('time_to') ? 'is-invalid' : '' }}">
              @foreach($times as $time)
                      {!! $time !!}
              @endforeach
          </select>
          
          @if ($errors->first('time_to'))
            <div class="invalid-feedback text-danger">{{ $errors->first('time_to') }}</div>
          @endif

      </div>
</div>
