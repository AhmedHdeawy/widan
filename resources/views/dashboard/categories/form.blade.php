<div class="form-group row">
    <label for="fileInput" class="col-sm-2 form-control-label">Name</label>
    <div class="col-sm-10">      
      <input class="form-control {{ $errors->first('name') ? 'is-invalid' : '' }}" placeholder="Name" id="name" type="text" name="name" 
      value="{{ old('name', isset($category) ? $category->name : '') }}">
      @if ($errors->first('name'))
        <div class="invalid-feedback">{{ $errors->first('name') }}</div>
      @endif
    </div>
</div>

<div class="line"></div>


<div class="form-group row">
  <label for="fileInput" class="col-sm-2 form-control-label">File input</label>
  <div class="col-sm-10">
    {{-- <input name="logo" type="file" class="file-upload form-control-file {{ $errors->first('logo') ? 'is-invalid' : '' }}">
    <img src="{{ $value ? asset('img/images/original/'. $value) : asset('img/no-image.png') }}" id="{{ $name }}-preview" class="mt-2 img-fluid img-thumbnail"> --}}
    @include('dashboard.uploadImage', 
    ['name' =>  'logo', 'value' =>  isset($category) ? $category->logo : null, 'path' =>  'img/categories/']
    )
    @if ($errors->first('logo'))
      <div class="invalid-feedback">{{ $errors->first('logo') }}</div>
    @endif
  </div>
</div>

<div class="line"></div>

<div class="form-group row">

    <label for="fileInput" class="col-sm-2 form-control-label">Status</label>
    
    @php
      $status = old('status', isset($category) ? $category->status : 1);
    @endphp
    <div class="col-sm-10">
      
      <div class="form-check form-check-inline mr-1">
        <input class="form-check-input" id="active" type="radio" value="1" name="status" {{ $status == 1 ? 'checked' : '' }}>
        <label class="form-check-label" for="active">Active</label>
      </div>
      <div class="form-check form-check-inline mr-1">
        <input class="form-check-input" id="stopped" type="radio" value="0" name="status" {{ $status == 0 ? 'checked' : '' }}>
        <label class="form-check-label" for="stopped">Stopped</label>
      </div>
      @if ($errors->first('status'))
        <div class="invalid-feedback">{{ $errors->first('status') }}</div>
      @endif
    </div>

</div>

  
