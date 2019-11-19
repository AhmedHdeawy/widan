@extends('layouts.app')

@section('content')

{{-- Contact Us  / Start --}}

<div class="container contact-us my-5 px-1 px-md-5">
    
    <div class="row justify-content-center align-items-center">
        
        <div class="col-12 col-lg-6">
            
            <div class="mapouter">
                <div class="gmap_canvas">
                    <iframe width="400" height="300" id="gmap_canvas" src="https://maps.google.com/maps?q=%D8%A7%D9%84%D8%AE%D9%84%D9%8A%D8%AC%20%D8%A7%D9%84%D8%AA%D8%AC%D8%A7%D8%B1%D9%8A%20%2C%20%D8%AF%D8%A8%D9%8A&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0">
                    </iframe>
                </div>
                <style>
                    .mapouter{position:relative;text-align:right;height:100%;width:600px;}.gmap_canvas {overflow:hidden;background:none!important;height:100%;width:600px;}
                </style>
            </div>

        </div>

        <div class="col-12 col-lg-6 mt-5 mt-md-0 p-0 p-md-4">
            
            <ul class="list-group list-group-flush">
              <li class="list-group-item fb-400">
                <i class="mx-1 fa fa-phone"></i>
                <a target="_blank" href="tel:{{ getSettingByKey('phone')->settings_value }}"> {{ getSettingByKey('phone')->settings_value }} </a>
              </li>

              <li class="list-group-item fb-400">
                <i class="mx-1 fa fa-envelope-o"></i>
                <a target="_blank" href="mailto:{{ getSettingByKey('email')->settings_value }}"> {{ getSettingByKey('email')->settings_value }} </a>                
              </li>

               <li class="list-group-item fb-400">
                <i class="mx-1 fa fa-facebook"></i>
                <a target="_blank" href="{{ getSettingByKey('facebook')->settings_value }}">{{ getSettingByKey('facebook')->settings_value }}</a>
              </li>

               <li class="list-group-item fb-400">
                <i class="mx-1 fa fa-twitter"></i>
                <a target="_blank" href="{{ getSettingByKey('twitter')->settings_value }}">{{ getSettingByKey('twitter')->settings_value }}</a>
              </li>

               <li class="list-group-item fb-400">
                <i class="mx-1 fa fa-instagram"></i>
                <a target="_blank" href="{{ getSettingByKey('instagram')->settings_value }}">{{ getSettingByKey('instagram')->settings_value }}</a>
              </li>
            </ul>

        </div>

    </div>

    <div class="row justify-content-center align-items-center mt-5">
        
        <div class="col-10 col-md-8 p-0 p-md-4">

            @if (session('status'))
                <div class="alert alert-success text-sm-center">
                    <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h6>{{ session('status') }}</h6>
                </div>
            @endif


            <!--Form with header-->
            <form action="{{ route('postContactUs') }}" method="post">

                @csrf

                <div class="card border-success rounded-0">
                    <div class="card-header p-0">
                        <div class="bg-success text-white text-center py-2">
                            <h3><i class="fa fa-envelope"></i> {{ __('lang.contactUsTitle') }} </h3>
                            <p class="m-0">{{ __('lang.contactUsMessage') }}</p>
                        </div>
                    </div>
                    <div class="card-body p-3">

                        <!--Body-->
                        <div class="form-group">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-user text-success"></i></div>
                                </div>
                                <input type="text" class="form-control {{ $errors->first('name') ? 'is-invalid' : '' }}" id="name" name="name" placeholder="{{ __('lang.name') }}" value="{{ old('name') }}" >
                                @if ($errors->first('name'))
                                    <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                                  @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-phone text-success"></i></div>
                                </div>
                                <input type="text" class="form-control {{ $errors->first('phone') ? 'is-invalid' : '' }}" id="phone" name="phone" value="{{ old('phone') }}" placeholder="{{ __('lang.phone') }}" >

                                @if ($errors->first('phone'))
                                    <div class="invalid-feedback">{{ $errors->first('phone') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-envelope text-success"></i></div>
                                </div>
                                <input type="email" class="form-control {{ $errors->first('email') ? 'is-invalid' : '' }}" id="email" name="email" value="{{ old('email') }}" placeholder="{{ __('lang.email') }}" >
                                @if ($errors->first('email'))
                                    <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-comment text-success"></i></div>
                                </div>
                                <textarea class="form-control {{ $errors->first('message') ? 'is-invalid' : '' }}" name="message" placeholder="{{ __('lang.message') }}" >{{ old('message') }}</textarea>
                                @if ($errors->first('message'))
                                    <div class="invalid-feedback">{{ $errors->first('message') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="text-center">
                            <input type="submit" value="{{ __('lang.send') }}" class="btn btn-success btn-block rounded-0 py-2">
                        </div>
                    </div>

                </div>
            </form>
            <!--Form with header-->

        </div>

    </div>

</div>


{{-- Contact Us  / End --}}


@endsection
