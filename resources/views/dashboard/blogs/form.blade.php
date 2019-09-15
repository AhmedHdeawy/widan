
<h5 class="text-primary m-b-h">
  {{ __('lang.staticData') }}
</h5>


<div class="form-group row">
    <label class="col-md-3 form-control-label" for="blogs_logo"> {{ __('lang.image') }} </label>
    <div class="col-md-9">
        
        @include('dashboard.includes.uploadImage', 
          ['name' =>  'blogs_logo', 'value' =>  isset($blog) ? $blog->blogs_logo : null, 'path' =>  'uploads/blogs/']
        )

        @if ($errors->first('blogs_logo'))
          <div class="invalid-feedback text-danger">{{ $errors->first('blogs_logo') }}</div>
        @endif

    </div>
</div>


<div class="form-group row">
  <label class="col-md-3 form-control-label"> {{ __('lang.status') }} </label>

  <div class="col-md-9">

    @php
      $status = old('blogs_status', isset($blog) ? $blog->blogs_status : 1);
    @endphp

      <label class="radio-inline" for="active">
          <input type="radio" id="active" name="blogs_status" value="1" {{ $status == 1 ? 'checked' : '' }}>
          {{ __('lang.active') }}
      </label>

      <label class="radio-inline" for="stopped">
          <input type="radio" id="stopped" name="blogs_status" value="0" {{ $status == 0 ? 'checked' : '' }}>
          {{ __('lang.stopped') }}
      </label>

      @if ($errors->first('blogs_status'))
        <div class="invalid-feedback text-danger">{{ $errors->first('blogs_status') }}</div>
      @endif

  </div>
</div>


@foreach($languages as $languag)


  <h5 class="text-primary m-t-h m-b-h p-t-h">
    {{ __('lang.'. $languag->locale .'Data') }}
  </h5>


  
  <div class="form-group row">
      <label class="col-md-3 form-control-label" for="{{ $languag->locale }}[blogs_title]"> {{ __('lang.blogs_title') }} </label>
      <div class="col-md-9">
          
          <input type="text" id="{{ $languag->locale }}[blogs_title]" name="{{ $languag->locale }}[blogs_title]" 
            class="form-control {{ $errors->first($languag->locale .'.blogs_title') ? 'is-invalid' : '' }}" 
            placeholder="{{ __('lang.blogs_title') }}"
            value="{{ old($languag->locale .'blogs_title', isset($blog) ? $blog->translate($languag->locale)->blogs_title : '') }}"
          >
          
          @if ($errors->first($languag->locale .'.blogs_title'))
            <div class="invalid-feedback text-danger">{{ $errors->first($languag->locale .'.blogs_title') }}</div>
          @endif

      </div>
  </div>


   <div class="form-group row">
      <label class="col-md-3 form-control-label" for="{{ $languag->locale }}[blogs_desc]"> {{ __('lang.blogs_desc') }} </label>
      <div class="col-md-9">
          
          <textarea type="text" id="{{ $languag->locale }}[blogs_desc]" name="{{ $languag->locale }}[blogs_desc]" 
            class="form-control {{ $errors->first($languag->locale .'.blogs_desc') ? 'is-invalid' : '' }}" 
            placeholder="{{ __('lang.blogs_desc') }}"
          >{{ old($languag->locale .'blogs_desc', isset($blog) ? $blog->translate($languag->locale)->blogs_desc : '') }}</textarea>
          
          @if ($errors->first($languag->locale .'.blogs_desc'))
            <div class="invalid-feedback text-danger">{{ $errors->first($languag->locale .'.blogs_desc') }}</div>
          @endif

      </div>
  </div>

@endforeach


