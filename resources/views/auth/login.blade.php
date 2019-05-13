@extends('layouts.app')

@section('navbar')

    @include('layouts.navbar-main')

@endsection


@section('content')


<!-- Start Section Sign In -->

    <section class="sign-in">

        <div class="container">
            
            <h3 class="font-weight-bold main-color my-5">تسجيل دخول</h3>


               {{--  <div class="communication">

                    <button type="button"><a href="#"><i class="fab fa-google"></i>تسجيل الدخول بواسطة جوجل</a></button>

                    <button type="button"><a href="#"><i class="fab fa-facebook-f"></i>تسجيل الدخول بواسطة فيسبوك</a></button>

                </div> --}}

                <p>
                    @if ($errors->has('email'))
                        <strong class="text-danger">الايميل او كلمة المرور خطأ</strong>
                    @endif
                </p>

                <form class="form-insid" method="POST" action="{{ route('login') }}">
                    @csrf
    
                    <div class="form-group px-4 mb-5">
                        
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="البريد الالكتروني" class="form-control" required autofocus />
                        
                    </div>

                    <div class="form-group px-4">
                        
                        <input type="password" placeholder="كلمة المرور" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required />

                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif

                    </div>

                    <div class="form-group form-check text-right px-4">
                        <input type="checkbox" name="remember" class="form-check-input" id="remember">
                        <label class="form-check-label" for="remember">تذكرني</label>
                    </div>


                    <div class="content">

                    </div>
                    
                    <button type="submit">تسجيل الدخول</button>

                </form>

                <div class="parg">

                    <p>هل انت مستخدم جديد؟</p>

                    <a href="{{ route('register') }}">انشاء حساب</a>

                </div>
                

        </div>

    </section>

<!-- Start Section  Sign In -->


@endsection
