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
                    كل التصنيفات
                </h2>

            <div class="rapper row">
                
                @foreach($categories as $category)

                    <div class="place col-12 col-md-3 mb-4">

                        <a href="{{ route('category', $category->slug ) }}">

                            <div class="photo">

                                <img src="{{ asset('img/categories/' . $category->logo) }}" class="img-fluid" 
                                title="{{ $category->name }}" alt="{{ $category->name }}">

                            </div>

                            <div class="foo-place d-flex">

                                <p>{{ $category->name }}</p>

                                <span>عرض</span>

                            </div>

                        </a>

                    </div>
                @endforeach
            </div>

            <div class="row">
                
                {{ $categories->links() }}
            </div>


            <!-- End Categories --> 
            


    </div>

</section>

    <!-- End All sections -->


@endsection
