@extends('layouts.app')

@section('navbar')

    @include('layouts.header')

@endsection


@section('content')

<!-- start All sections -->

<section class="parent-allsections">
        
    <div class="container">

        {{-- <div class="rapper d-flex flex-wrap justify-content-between"> --}}

            <!-- Start Categories -->
            
                <h2 class="text-center mb-5 taqiim-color">
                    {{ $category->name }}
                </h2>

            <div class="rapper row">
                @if(count($category->clients))

                    @foreach($category->clients as $client)

                        <div class="place col-12 col-md-4 mb-4">

                            <a href="{{ route('client', $client->slug ) }}">

                                <div class="photo">

                                    <img src="{{ asset('img/clients/' . $client->logo) }}" class="img-fluid" 
                                    title="{{ $client->name }}" alt="{{ $client->name }}">

                                </div>

                                <div class="foo-place d-flex">

                                    <p>{{ $client->name }}</p>

                                    <span>عرض</span>

                                </div>

                            </a>

                        </div>
                    @endforeach
                
                @else
                    <h3 class="taqiim-color col-12 text-center text-danger">
                        لايوجد بيانات لهذا التصنيف
                    </h3>
                @endif

                
            </div>

            <!-- End Categories --> 
            


    </div>

</section>

    <!-- End All sections -->


@endsection
