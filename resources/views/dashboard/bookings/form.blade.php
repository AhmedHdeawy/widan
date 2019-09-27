
<h5 class="text-primary m-b-h">
  {{ __('lang.staticData') }}
</h5>



<div class="form-group row">
      <label class="col-md-3 form-control-label" for="user_id"> {{ __('lang.username') }} </label>
      <div class="col-md-9">

          <select name="user_id" id="user_id" class="form-control {{ $errors->first('user_id') ? 'is-invalid' : '' }}">
              @foreach($users as $user)
                      '<option value="{{ $user->id }}" {{ isset($booking) && $booking->user_id == $user->id ? 'selected' : '' }}> 
                        {{ $user->name }} 
                      </option>';
              @endforeach
          </select>
          
          @if ($errors->first('user_id'))
            <div class="invalid-feedback text-danger">{{ $errors->first('user_id') }}</div>
          @endif

      </div>
</div>


<div class="form-group row">
      <label class="col-md-3 form-control-label" for="phone"> {{ __('lang.phone') }} </label>
      <div class="col-md-9">
          
          <input type="text" id="phone" name="phone" 
            class="form-control {{ $errors->first('phone') ? 'is-invalid' : '' }}" 
            placeholder="{{ __('lang.phone') }}"
            value="{{ old('phone', isset($booking) ? $booking->phone : '') }}"
          >
          
          @if ($errors->first('phone'))
            <div class="invalid-feedback text-danger">{{ $errors->first('phone') }}</div>
          @endif

      </div>
</div>


<div class="form-group row">
      <label class="col-md-3 form-control-label" for="email"> {{ __('lang.email') }} </label>
      <div class="col-md-9">
          
          <input type="email" id="email" name="email" 
            class="form-control {{ $errors->first('email') ? 'is-invalid' : '' }}" 
            placeholder="{{ __('lang.email') }}"
            value="{{ old('email', isset($booking) ? $booking->email : '') }}"
          >
          
          @if ($errors->first('email'))
            <div class="invalid-feedback text-danger">{{ $errors->first('email') }}</div>
          @endif

      </div>
  </div>


<h5> {{ __('lang.locationDetails') }} </h5>

<div class="form-group row">
      <label class="col-md-3 form-control-label" for="city"> {{ __('lang.city') }} </label>
      <div class="col-md-9">
          
          <input type="text" id="city" name="city" 
            class="form-control {{ $errors->first('city') ? 'is-invalid' : '' }}" 
            placeholder="{{ __('lang.city') }}"
            value="{{ old('city', isset($booking) ? $booking->city : '') }}"
          >
          
          @if ($errors->first('city'))
            <div class="invalid-feedback text-danger">{{ $errors->first('city') }}</div>
          @endif

      </div>
</div>


<div class="form-group row">
      <label class="col-md-3 form-control-label" for="building"> {{ __('lang.building') }} </label>
      <div class="col-md-9">
          
          <input type="text" id="building" name="building" 
            class="form-control {{ $errors->first('building') ? 'is-invalid' : '' }}" 
            placeholder="{{ __('lang.building') }}"
            value="{{ old('building', isset($booking) ? $booking->building : '') }}"
          >
          
          @if ($errors->first('building'))
            <div class="invalid-feedback text-danger">{{ $errors->first('building') }}</div>
          @endif

      </div>
</div>


<div class="form-group row">
      <label class="col-md-3 form-control-label" for="unit"> {{ __('lang.unit') }} </label>
      <div class="col-md-9">
          
          <input type="text" id="unit" name="unit" 
            class="form-control {{ $errors->first('unit') ? 'is-invalid' : '' }}" 
            placeholder="{{ __('lang.unit') }}"
            value="{{ old('unit', isset($booking) ? $booking->unit : '') }}"
          >
          
          @if ($errors->first('unit'))
            <div class="invalid-feedback text-danger">{{ $errors->first('unit') }}</div>
          @endif

      </div>
</div>

<div class="form-group row">
      <label class="col-md-3 form-control-label" for="street"> {{ __('lang.street') }} </label>
      <div class="col-md-9">
          
          <input type="text" id="street" name="street" 
            class="form-control {{ $errors->first('street') ? 'is-invalid' : '' }}" 
            placeholder="{{ __('lang.street') }}"
            value="{{ old('street', isset($booking) ? $booking->street : '') }}"
          >
          
          @if ($errors->first('street'))
            <div class="invalid-feedback text-danger">{{ $errors->first('street') }}</div>
          @endif

      </div>
</div>


<h5> {{ __('lang.bookingDetails') }} </h5>



<div class="form-group row">
      <label class="col-md-3 form-control-label" for="service_id"> {{ __('lang.selectService') }} </label>
      <div class="col-md-9">

          <select name="service_id" id="service_id" class="form-control {{ $errors->first('service_id') ? 'is-invalid' : '' }}">
              @foreach($services as $service)
                      '<option value="{{ $service->id }}" {{ isset($booking) && $booking->service_id == $service->id ? 'selected' : '' }}> 
                        {{ $service->services_title }} 
                      </option>';
              @endforeach
          </select>
          
          @if ($errors->first('service_id'))
            <div class="invalid-feedback text-danger">{{ $errors->first('service_id') }}</div>
          @endif

      </div>
</div>



<div class="form-group row">
      <label class="col-md-3 form-control-label" for="day"> {{ __('lang.selectService') }} </label>
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
