
<h5 class="text-primary m-b-h">
  {{ __('lang.staticData') }}
</h5>


<div class="form-group row">
    <label class="col-md-3 form-control-label" for="services_logo"> {{ __('lang.image') }} </label>
    <div class="col-md-9">
        
        @include('dashboard.includes.uploadImage', 
          ['name' =>  'services_logo', 'value' =>  isset($service) ? $service->services_logo : null, 'path' =>  'uploads/services/']
        )

        @if ($errors->first('services_logo'))
          <div class="invalid-feedback text-danger">{{ $errors->first('services_logo') }}</div>
        @endif

    </div>
</div>


<div class="form-group row">
  <label class="col-md-3 form-control-label"> {{ __('lang.status') }} </label>

  <div class="col-md-9">

    @php
      $status = old('services_status', isset($service) ? $service->services_status : 1);
    @endphp

      <label class="radio-inline" for="active">
          <input type="radio" id="active" name="services_status" value="1" {{ $status == 1 ? 'checked' : '' }}>
          {{ __('lang.active') }}
      </label>

      <label class="radio-inline" for="stopped">
          <input type="radio" id="stopped" name="services_status" value="0" {{ $status == 0 ? 'checked' : '' }}>
          {{ __('lang.stopped') }}
      </label>

      @if ($errors->first('services_status'))
        <div class="invalid-feedback text-danger">{{ $errors->first('services_status') }}</div>
      @endif

  </div>
</div>


@foreach($languages as $languag)


  <h5 class="text-primary m-t-h m-b-h p-t-h">
    {{ __('lang.'. $languag->locale .'Data') }}
  </h5>


  
  <div class="form-group row">
      <label class="col-md-3 form-control-label" for="{{ $languag->locale }}[services_title]"> {{ __('lang.services_title') }} </label>
      <div class="col-md-9">
          
          <input type="text" id="{{ $languag->locale }}[services_title]" name="{{ $languag->locale }}[services_title]" 
            class="form-control {{ $errors->first($languag->locale .'.services_title') ? 'is-invalid' : '' }}" 
            placeholder="{{ __('lang.services_title') }}"
            value="{{ old($languag->locale .'services_title', isset($service) ? $service->translate($languag->locale)->services_title : '') }}"
          >
          
          @if ($errors->first($languag->locale .'.services_title'))
            <div class="invalid-feedback text-danger">{{ $errors->first($languag->locale .'.services_title') }}</div>
          @endif

      </div>
  </div>


   <div class="form-group row">
      <label class="col-md-3 form-control-label" for="{{ $languag->locale }}[services_desc]"> {{ __('lang.services_desc') }} </label>
      <div class="col-md-9">
          
          <textarea type="text" id="{{ $languag->locale }}[services_desc]" name="{{ $languag->locale }}[services_desc]" 
            class="form-control {{ $errors->first($languag->locale .'.services_desc') ? 'is-invalid' : '' }}" 
            placeholder="{{ __('lang.services_desc') }}"
          >{{ old($languag->locale .'services_desc', isset($service) ? $service->translate($languag->locale)->services_desc : '') }}</textarea>
          
          @if ($errors->first($languag->locale .'.services_desc'))
            <div class="invalid-feedback text-danger">{{ $errors->first($languag->locale .'.services_desc') }}</div>
          @endif

      </div>
  </div>

@endforeach


