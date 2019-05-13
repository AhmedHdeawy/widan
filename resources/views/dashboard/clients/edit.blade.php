@extends('dashboard.app')


@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard.clients') }}">Clients</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')

<div class="container-fluid">  
    @include('dashboard.status')
</div>

<section class="forms"> 
  <div class="container-fluid">
    <div class="row">
      
      <!-- Basic Form-->
      <div class="col-12">

        <div class="card">

          <div class="card-header d-flex align-items-center">
            <h3 class="h4">Edit Client</h3>
          </div>
          
          <form class="form-horizontal" action="{{ route('dashboard.clients.update', ['id' =>  $client->id]) }}" method="post" enctype="multipart/form-data">
            <div class="card-body">
              @method('PUT')
              @csrf

              @include('dashboard.clients.form')
            </div>

            <div class="card-footer">
                <div class="form-group">       
                  <input type="submit" value="Update" class="btn btn-primary">
                  <a href="{{ route('dashboard.clients') }}" class="btn btn-secondary">
                    Back
                  </a>
                </div>
            </div>

          </form>
          
        
        </div>
      </div>

    </div>
  </div>
</section>


@endsection
