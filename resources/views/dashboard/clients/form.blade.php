<div class="form-group row">
    <label for="fileInput" class="col-sm-2 form-control-label">Name</label>
    <div class="col-sm-10">      
      <input class="form-control {{ $errors->first('name') ? 'is-invalid' : '' }}" placeholder="Name" id="name" type="text" name="name" 
      value="{{ old('name', isset($client) ? $client->name : '') }}">
      @if ($errors->first('name'))
        <div class="invalid-feedback">{{ $errors->first('name') }}</div>
      @endif
    </div>
</div>
<div class="line"></div>


<div class="form-group row">
    <label for="fileInput" class="col-sm-2 form-control-label">Slug</label>
    <div class="col-sm-10">      
      <input class="form-control {{ $errors->first('slug') ? 'is-invalid' : '' }}" placeholder="Slug" id="slug" type="text" name="slug" 
      value="{{ old('slug', isset($client) ? $client->slug : '') }}">
      @if ($errors->first('slug'))
        <div class="invalid-feedback">{{ $errors->first('slug') }}</div>
      @endif
    </div>
</div>
<div class="line"></div>

<div class="form-group row">
    <label for="fileInput" class="col-sm-2 form-control-label">Email</label>
    <div class="col-sm-10">      
      <input class="form-control {{ $errors->first('email') ? 'is-invalid' : '' }}" placeholder="Email" id="email" type="email" name="email" 
      value="{{ old('email', isset($client) ? $client->email : '') }}">
      @if ($errors->first('email'))
        <div class="invalid-feedback">{{ $errors->first('email') }}</div>
      @endif
    </div>
</div>
<div class="line"></div>

<div class="form-group row">
    <label for="fileInput" class="col-sm-2 form-control-label">Phone</label>
    <div class="col-sm-10">      
      <input class="form-control {{ $errors->first('phone') ? 'is-invalid' : '' }}" placeholder="Phone" id="phone" type="text" name="phone" 
      value="{{ old('phone', isset($client) ? $client->phone : '') }}">
      @if ($errors->first('phone'))
        <div class="invalid-feedback">{{ $errors->first('phone') }}</div>
      @endif
    </div>
</div>
<div class="line"></div>



<div class="form-group row">
    <label for="fileInput" class="col-sm-2 form-control-label">Description</label>
    <div class="col-sm-10">      
      
      <textarea name="description" id="description" cols="30" rows="10" 
      class="form-control {{ $errors->first('description') ? 'is-invalid' : '' }}">
        {{ old('description', isset($client) ? $client->description : '') }}
      </textarea>
      @if ($errors->first('description'))
        <div class="invalid-feedback">{{ $errors->first('description') }}</div>
      @endif
    </div>
</div>
<div class="line"></div>

<div class="form-group row">
    <label for="fileInput" class="col-sm-2 form-control-label">Address</label>
    <div class="col-sm-10">      
      
      <textarea name="address" id="address" cols="30" rows="10" 
      class="form-control {{ $errors->first('address') ? 'is-invalid' : '' }}">
        {{ old('address', isset($client) ? $client->address : '') }}
      </textarea>
      @if ($errors->first('address'))
        <div class="invalid-feedback">{{ $errors->first('address') }}</div>
      @endif
    </div>
</div>
<div class="line"></div>


<div class="form-group row">
  <label for="fileInput" class="col-sm-2 form-control-label">Logo</label>
  <div class="col-sm-10">
    @include('dashboard.uploadImage', 
    ['name' =>  'logo', 'value' =>  isset($client) ? $client->logo : null, 'path' =>  'img/clients/']
    )
    @if ($errors->first('logo'))
      <div class="invalid-feedback">{{ $errors->first('logo') }}</div>
    @endif
  </div>
</div>

<div class="line"></div>

<div class="form-group row">
    <label for="fileInput" class="col-sm-2 form-control-label">Location</label>
    <div class="col-sm-10">      
      <input class="form-control {{ $errors->first('location') ? 'is-invalid' : '' }}" placeholder="Phone" id="location" type="text" name="location" 
      value="{{ old('location', isset($client) ? $client->location : '') }}">
      @if ($errors->first('location'))
        <div class="invalid-feedback">{{ $errors->first('location') }}</div>
      @endif
    </div>
</div>
<div class="line"></div>

<div class="form-group row">

    <label class="col-sm-2 form-control-label">Status</label>
    
    @php
      $status = old('status', isset($client) ? $client->status : 1);
    @endphp
    <div class="col-sm-10">
      
      <div class="form-check form-check-inline mr-1">
        <input class="form-check-input" id="notactive" type="radio" value="0" name="status" {{ $status == 0 ? 'checked' : '' }}>
        <label class="form-check-label" for="notactive">Not Active</label>
      </div>
      <div class="form-check form-check-inline mr-1">
        <input class="form-check-input" id="active" type="radio" value="1" name="status" {{ $status == 1 ? 'checked' : '' }}>
        <label class="form-check-label" for="active">Active</label>
      </div>
      <div class="form-check form-check-inline mr-1">
        <input class="form-check-input" id="stopped" type="radio" value="2" name="status" {{ $status == 2 ? 'checked' : '' }}>
        <label class="form-check-label" for="stopped">Stopped</label>
      </div>
      @if ($errors->first('status'))
        <div class="invalid-feedback">{{ $errors->first('status') }}</div>
      @endif
    </div>
</div>
<div class="line"></div>

<div class="form-group row">
    <label for="fileInput" class="col-sm-2 form-control-label">User</label>
    <div class="col-sm-10" id="select2Parent">      
      
      <select class="clientUser form-control w-100 p-2" name="user_id">
        @foreach($users as $user)
        <option value="{{ $user->id }}" {{ isset($client) && $client->user->id == $user->id ? 'selected' : ''  }} >{{ $user->name }}</option>
        @endforeach
      </select>

      @if ($errors->first('location'))
        <div class="invalid-feedback">{{ $errors->first('user_id') }}</div>
      @endif
    </div>
</div>
<div class="line"></div>

<div class="form-group row">
    <label for="fileInput" class="col-sm-2 form-control-label">City</label>
    <div class="col-sm-10" id="select2Parent">      
      
      <select class="clientUser form-control w-100 p-2" name="city_id">
        @foreach($cities as $city)
        <option value="{{ $city->id }}" {{ isset($client) && $client->city->id == $city->id ? 'selected' : ''  }}>{{ $city->name }}</option>
        @endforeach
      </select>

      @if ($errors->first('location'))
        <div class="invalid-feedback">{{ $errors->first('city_id') }}</div>
      @endif
    </div>
</div>
<div class="line"></div>



  
