@extends('dashboard.app')


@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ route('dashboard.clients') }}">Clients</a></li>
@endsection

@section('content')

<div class="container-fluid">  
    @include('dashboard.status')
</div>


<section class="tables">
  <div class="container-fluid">
    <div class="row">

      <div class="col-12">

        <div class="card p-2">
          
          <div class="card-body">
            <form class="form-inline py-4" action="{{ route('dashboard.clients') }}" method="GET">

              <div class="col-5">                
                <div class="form-group">
                  <input type="text" placeholder="Name" value="{{ old('name') }}" name="name" class="form-control">
                </div>
              </div>

              <div class="col-4">                
                <div class="form-group">       
                  <select name="status" class="form-control w-100">
                    <option value>Select Status</option>
                    <option value="0" {{ old('status') === '0' ? 'selected' : '' }}>Not Active</option>
                    <option value="1" {{ old('status') === '1' ? 'selected' : '' }}>Active</option>
                    <option value="2" {{ old('status') === '2' ? 'selected' : '' }}>Stopped</option>
                  </select>
                </div>
              </div>

              <div class="col-3">                

                <div class="form-group float-right">
                  <button class="btn btn-primary" type="submit">
                    <i class="fa fa-search"></i> Search
                  </button>

                  <button class="btn btn-danger ml-2 search-reset" type="button">
                    <i class="fa fa-ban"></i>
                  </button>
                </div>
              </div>

            </form>
          </div>
        </div>
      </div>
      
      <div class="col-12">
        <div class="card">

          <div class="card-close">
              <div class="dropdown">
                <a href="{{ route('dashboard.clients.create') }}" role="button" class="btn btn-sm btn-primary mb-2">
                    <span>New Client</span>
                    <i class="fa fa-plus-square"></i>
                </a>
              </div>
          </div>
          
          <div class="card-header d-flex align-items-center">
            <h3 class="h4">
              Clients List
            </h3>
          </div>
          
          <div class="card-body">
            <div class="table-responsive">  
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Services</th>
                    <th>Branches</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                </thead>

                <tbody>
                  @foreach($clients as $client)

                    <tr>
                      <th>{{ $client->id }}</th>
                      <td>{{ $client->name }}</td>
                      <td> 
                        <a href="{{ route('dashboard.services',  $client->id) }}" class="btn btn-primary btn-sm">
                          Services
                        </a>
                      </td>
                      <td>
                        <a href="{{ route('dashboard.branches', $client->id) }}" class="btn btn-secondary btn-sm">
                          Branches
                        </a>
                      </td>
                      <td>
                        @if($client->status == '0')
                          <span class="text-primary">Not Active</span>
                        @elseif($client->status == '1')
                          <span class="text-success">Active</span>
                        @else
                          <span class="text-danger">Stopped</span>
                        @endif
                      </td>
                      <td>
                        
                        <a href="{{ route('dashboard.clients.show', $client->id) }}" class="btn btn-primary btn-sm">
                          <i class="fa fa-eye"></i>
                        </a>

                        <a href="{{ route('dashboard.clients.edit', $client->id) }}" class="btn btn-warning btn-sm">
                          <i class="fa fa-edit"></i>
                        </a>

                        <form method="POST" class="d-inline" action="{{ route('dashboard.clients.destroy', $client->id) }}">
                          @csrf
                          @method('DELETE')
                          <button class="btn btn-sm btn-danger delete-item">
                            <i class="fa fa-trash"></i>
                          </button>
                        </form>

                      </td>
                    </tr>
                  @endforeach

                  
                </tbody>
              </table>
            </div>
          </div>

          <div class="card-footer">    
            {{ $clients->links() }}              
          </div>

        </div>
      </div>

    </div>
  </div>
</section>


@endsection
