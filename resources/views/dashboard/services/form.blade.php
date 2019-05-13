<div class="form-group row">
    <label for="fileInput" class="col-sm-2 form-control-label">Name</label>
    <div class="col-sm-10">      
      <input class="form-control {{ $errors->first('name') ? 'is-invalid' : '' }}" placeholder="Name" id="name" type="text" name="name" 
      value="{{ old('name', isset($service) ? $service->name : '') }}">
      @if ($errors->first('name'))
        <div class="invalid-feedback">{{ $errors->first('name') }}</div>
      @endif
    </div>
</div>
<div class="line"></div>


<div class="form-group row">
    <label for="fileInput" class="col-sm-2 form-control-label">Price</label>
    <div class="col-sm-10">      
      <input class="form-control {{ $errors->first('price') ? 'is-invalid' : '' }}" placeholder="Price" id="price" type="text" name="price" 
      value="{{ old('price', isset($service) ? $service->price : '') }}">
      @if ($errors->first('price'))
        <div class="invalid-feedback">{{ $errors->first('price') }}</div>
      @endif
    </div>
</div>
<div class="line"></div>


<div class="form-group row">
    <label for="fileInput" class="col-sm-2 form-control-label">Currency</label>
    <div class="col-sm-10">      
      
      <select class="form-control" name="currency">
        <option value="">None</option>
        <option value="egp" {{ isset($service) && $service->currency == 'egp' ? 'selected' : ''  }} >EGP</option>
        <option value="uae" {{ isset($service) && $service->currency == 'uae' ? 'selected' : ''  }} >UAE</option>
        <option value="dar" {{ isset($service) && $service->currency == 'dar' ? 'selected' : ''  }} >DAR</option>
        <option value="usd" {{ isset($service) && $service->currency == 'usd' ? 'selected' : ''  }} >USD</option>
      </select>

      @if ($errors->first('currency'))
        <div class="invalid-feedback">{{ $errors->first('currency') }}</div>
      @endif
    </div>
</div>
<div class="line"></div>



<div class="form-group row">
    <label for="fileInput" class="col-sm-2 form-control-label">Description</label>
    <div class="col-sm-10">      
      
      <textarea name="description" id="description" cols="30" rows="10" 
      class="form-control {{ $errors->first('description') ? 'is-invalid' : '' }}">
        {{ old('description', isset($service) ? $service->description : '') }}
      </textarea>
      @if ($errors->first('description'))
        <div class="invalid-feedback">{{ $errors->first('description') }}</div>
      @endif
    </div>
</div>
<div class="line"></div>

<div class="form-group row">
    <label for="fileInput" class="col-sm-2 form-control-label">Details</label>
    <div class="col-sm-10">
      <textarea name="details" id="details" rows="5" 
      class="form-control {{ $errors->first('details') ? 'is-invalid' : '' }}">
        {{ old('details', isset($service) ? $service->details : '') }}
      </textarea>
      @if ($errors->first('details'))
        <div class="invalid-feedback">{{ $errors->first('details') }}</div>
      @endif
    </div>
</div>
<div class="line"></div>

<div class="form-group row">

    <label class="col-sm-2 form-control-label">Status</label>
    
    @php
      $status = old('status', isset($service) ? $service->status : 1);
    @endphp
    <div class="col-sm-10">
      
      <div class="form-check form-check-inline mr-1">
        <input class="form-check-input" id="active" type="radio" value="1" name="status" {{ $status == 1 ? 'checked' : '' }}>
        <label class="form-check-label" for="active">Active</label>
      </div>
      
      <div class="form-check form-check-inline mr-1">
        <input class="form-check-input" id="notactive" type="radio" value="0" name="status" {{ $status == 0 ? 'checked' : '' }}>
        <label class="form-check-label" for="notactive">Not Active</label>
      </div>
      @if ($errors->first('status'))
        <div class="invalid-feedback">{{ $errors->first('status') }}</div>
      @endif
    </div>
</div>
<div class="line"></div>


<div class="form-group row">
    <label for="fileInput" class="col-sm-2 form-control-label">Branch</label>
    <div class="col-sm-10" id="select2Parent">      
      
      <select class="serviceUser form-control w-100 p-2" name="branch_id">
        @foreach($branches as $branch)
        <option value="{{ $branch->id }}" {{ isset($service) && $service->branch && $service->branch->id == $branch->id ? 'selected' : ''  }}>{{ $branch->name }}</option>
        @endforeach
      </select>

      @if ($errors->first('location'))
        <div class="invalid-feedback">{{ $errors->first('branch_id') }}</div>
      @endif
    </div>
</div>
<div class="line"></div>



  
