@extends('layouts.app')


@section('style')

    <link rel="stylesheet" href="{{ asset('front/plugins/css/fileinput.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/plugins/css/fileinput-rtl.css') }}">
    <link rel="stylesheet" href="{{ asset('front/plugins/css/chosen.min.css') }}">

@endsection

@section('navbar')

    @include('layouts.navbar-main')

@endsection


@section('content')

<!-- Start Section Add Business-->

<section class="add-business text-right">

    <div class="container">

        <h3 class="font-weight-bold main-color">
            @if(isset($client))
                تعديل بيانات {{ $client->name }}
            @else

                اضافة بيانات عمل جديد
            @endif
        </h3>

        <form method="post" action="{{ route('updateClient') }}" enctype="multipart/form-data">
            
            @csrf
            <div class="first section d-flex flex-wrap justify-content-between mb-4">

                <label>التصنيف : </label>

                <select class="custom-select pr-4 categories-select" name="categories[]" multiple>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" 
                            {{ in_array($category->id, $clientCategoriesID) ? 'selected' : ''  }} >
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>

            </div>


            <div class="first section d-flex flex-wrap justify-content-between mb-4">

                <label>المدينة : </label>

                <select class="custom-select pr-4 city-select" name="cities[]">
                    @foreach($cities as $city)
                        <option value="{{ $city->id }}" 
                            {{ $client->city->id == $city->id ? 'selected' : ''  }} 
                        >
                            {{ $city->name }}
                        </option>
                    @endforeach
                </select>

            </div>

            <div class="second section d-flex flex-wrap justify-content-between">

                <label for="name">الاسم : </label>

                <input type="text" id="name" name="name" class="{{ $errors->first('name') ? 'is-invalid' : '' }}" placeholder="ضع الاسم المناسب...." value="{{ old('name', isset($client) ? $client->name : '') }}" />
                @if ($errors->first('name'))
                    <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                @endif

            </div>

            <div class="third section d-flex flex-wrap justify-content-between">

                <label for="email">البريد الالكتروني : </label>

                <input type="text" id="email" name="email" class="{{ $errors->first('email') ? 'is-invalid' : '' }}" placeholder="اكتب بريد الشركة" value="{{ old('email', isset($client) ? $client->email : '') }}" />
                @if ($errors->first('email'))
                    <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                @endif

            </div>

            <div class="third section d-flex flex-wrap justify-content-between">

                <label for="phone">رقم الهاتف : </label>

                <input type="text" id="phone" name="phone" class="{{ $errors->first('phone') ? 'is-invalid' : '' }}" placeholder="اكتب رقم الهاتف" value="{{ old('phone', isset($client) ? $client->phone : '') }}" />
                @if ($errors->first('phone'))
                    <div class="invalid-feedback">{{ $errors->first('phone') }}</div>
                @endif

            </div>

            <div class="third section d-flex flex-wrap justify-content-between">

                <label for="description">الوصف : </label>

                <textarea type="text" id="description" name="description" class="{{ $errors->first('description') ? 'is-invalid' : '' }}" placeholder="اوصف العمل بما يناسبه">
                    {{ old('description', isset($client) ? $client->description : '') }}
                </textarea>
                @if ($errors->first('description'))
                    <div class="invalid-feedback">{{ $errors->first('description') }}</div>
                @endif

            </div>

            <div class="forth section d-flex flex-wrap justify-content-between">

                <label for="address">العنوان : </label>

                <textarea type="text" id="address" name="address" class="{{ $errors->first('address') ? 'is-invalid' : '' }}" placeholder="اوصف العمل بما يناسبه">
                    {{ old('address', isset($client) ? $client->address : '') }}
                </textarea>
                @if ($errors->first('address'))
                    <div class="invalid-feedback">{{ $errors->first('address') }}</div>
                @endif

            </div>

           {{--  <div class="seventh section d-flex flex-wrap justify-content-between">

                <label>اوقات العمل : </label>

                <div class="seventh-content d-flex flex-wrap justify-content-between">

                    <input type="time" />

                    <input type="time" />

                </div>

            </div> --}}

            <div class="eightth section d-flex flex-wrap justify-content-between">

                <label>
                    الشعار :
                    @if(isset($client))                        
                        <div class="img-preview">
                            <img src="{{ asset('img/clients/'. $client->logo) }}" class="img-fluid img-thumbnail">
                        </div> 
                    @endif
                </label>

                <div class="input-file-1 input-file">
                    <input type="file" id="clientImage" name="logo">
                      @if ($errors->first('logo'))
                        <div class="invalid-feedback">{{ $errors->first('logo') }}</div>
                      @endif
        
                </div>

            </div>

           
            <div class="button-add text-left">

                <button class="text-center text-white bg-color" type="submit">اضافة</button>

            </div>

        </form>

    </div>

</section>

<!-- End Section Add Business-->

@endsection


@section('script')

<script src="{{ asset('front/plugins/js/piexif.min.js') }}"></script>
<script src="{{ asset('front/plugins/js/fileinput.min.js') }}"></script>
<script src="{{ asset('front/plugins/js/fileinput-ar.js') }}"></script>
<script src="{{ asset('front/plugins/js/theme.min.js') }}"></script>
<script src="{{ asset('front/plugins/js/chosen.jquery.js') }}"></script>

<script>
    
    $(document).ready(function(){


        $(".categories-select").chosen();
        $(".city-select").chosen();

        // Initialize File Input Plugin
       $("#clientImage").fileinput({
            'showUpload':false, 
            'showCancel':false, 
            'previewFileType':'any',
            previewClass: 'myFileInputOwnClass',
            theme: "fa",
            language: "ar",
            required: true,
            rtl: "true",
            autoReplace: true,
            overwriteInitial: false,
            allowedFileTypes: ['image'],
            maxFileCount: 5
        });

    })

</script>

@endsection
