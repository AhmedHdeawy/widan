
<h5 class="text-primary m-b-h">
  {{ __('lang.staticData') }}
</h5>


<div class="form-group row">
    <label class="col-md-3 form-control-label" for="sliders_img"> {{ __('lang.image') }} </label>
    <div class="col-md-9">
        
        @include('dashboard.includes.uploadImage', 
          ['name' =>  'sliders_img', 'value' =>  isset($slider) ? $slider->sliders_img : null, 'path' =>  'uploads/sliders/']
        )

        @if ($errors->first('sliders_img'))
          <div class="invalid-feedback text-danger">{{ $errors->first('sliders_img') }}</div>
        @endif

    </div>
</div>


<div class="form-group row">
  <label class="col-md-3 form-control-label"> {{ __('lang.status') }} </label>

  <div class="col-md-9">

    @php
      $status = old('sliders_status', isset($slider) ? $slider->sliders_status : 1);
    @endphp

      <label class="radio-inline" for="active">
          <input type="radio" id="active" name="sliders_status" value="1" {{ $status == 1 ? 'checked' : '' }}>
          {{ __('lang.active') }}
      </label>

      <label class="radio-inline" for="stopped">
          <input type="radio" id="stopped" name="sliders_status" value="0" {{ $status == 0 ? 'checked' : '' }}>
          {{ __('lang.stopped') }}
      </label>

      @if ($errors->first('sliders_status'))
        <div class="invalid-feedback text-danger">{{ $errors->first('sliders_status') }}</div>
      @endif

  </div>
</div>


@foreach($languages as $languag)


  <h5 class="text-primary m-t-h m-b-h p-t-h">
    {{ __('lang.'. $languag->locale .'Data') }}
  </h5>


  
  <div class="form-group row">
      <label class="col-md-3 form-control-label" for="{{ $languag->locale }}[sliders_title]"> {{ __('lang.sliders_title') }} </label>
      <div class="col-md-9">
          
          <input type="text" id="{{ $languag->locale }}[sliders_title]" name="{{ $languag->locale }}[sliders_title]" 
            class="form-control {{ $errors->first($languag->locale .'.sliders_title') ? 'is-invalid' : '' }}" 
            placeholder="{{ __('lang.sliders_title') }}"
            value="{{ old($languag->locale .'sliders_title', isset($slider) ? $slider->translate($languag->locale)->sliders_title : '') }}"
          >
          
          @if ($errors->first($languag->locale .'.sliders_title'))
            <div class="invalid-feedback text-danger">{{ $errors->first($languag->locale .'.sliders_title') }}</div>
          @endif

      </div>
  </div>


   <div class="form-group row">
      <label class="col-md-3 form-control-label" for="{{ $languag->locale }}[sliders_desc]"> {{ __('lang.sliders_desc') }} </label>
      <div class="col-md-9">
          
          <textarea type="text" id="{{ $languag->locale }}[sliders_desc]" name="{{ $languag->locale }}[sliders_desc]" 
            class="form-control {{ $errors->first($languag->locale .'.sliders_desc') ? 'is-invalid' : '' }}" 
            placeholder="{{ __('lang.sliders_desc') }}"
          >{{ old($languag->locale .'sliders_desc', isset($slider) ? $slider->translate($languag->locale)->sliders_desc : '') }}</textarea>
          
          @if ($errors->first($languag->locale .'.sliders_desc'))
            <div class="invalid-feedback text-danger">{{ $errors->first($languag->locale .'.sliders_desc') }}</div>
          @endif

      </div>
  </div>

@endforeach


