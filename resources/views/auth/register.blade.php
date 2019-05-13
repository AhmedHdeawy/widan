@extends('layouts.app')


@section('navbar')

@include('layouts.navbar-main')

@endsection

@section('content')



<!-- Start Section Sign In -->

    <section class="sign-in">

        <div class="container">

            <h3 class="font-weight-bold main-color my-5">تسجيل مستخدم جديد</h3>


               {{--  <div class="communication">

                    <button type="button"><a href="#"><i class="fab fa-google"></i>تسجيل الدخول بواسطة جوجل</a></button>

                    <button type="button"><a href="#"><i class="fab fa-facebook-f"></i>تسجيل الدخول بواسطة فيسبوك</a></button>

                </div> --}}


                <form class="form-insid" method="POST" action="{{ route('register') }}">
                    @csrf
    
                    <div class="form-group px-4">
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="الاسم بالكامل" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" required autofocus />
                        @if ($errors->has('name'))
                            <span class="invalid-feedback text-right" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group px-4">
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="البريد الالكتروني" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" required autofocus />
                        @if ($errors->has('email'))
                            <span class="invalid-feedback text-right" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group px-4">
                        <input type="password" placeholder="كلمة المرور" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required />

                        @if ($errors->has('password'))
                            <span class="invalid-feedback text-right" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group px-4">
                        
                        <input type="password" placeholder="تأكيد كلمة المرور" class="form-control" name="password_confirmation" required />
                    </div>



                    <div class="content">

                    </div>
                    
                    <button type="submit">إنشاء حساب</button>

                </form>

                <div class="parg">

                    <p>هل لديك حساب بالفعل؟</p>

                    <a href="{{ route('login') }}">تسجيل الدخول</a>

                </div>
                

        </div>

    </section>

<!-- Start Section  Sign In -->


@endsection
