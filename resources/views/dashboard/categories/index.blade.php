@extends('dashboard.app')


@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ route('dashboard.categories') }}">Categories</a></li>
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
            <form class="form-inline py-4" action="{{ route('dashboard.categories') }}" method="GET">

              <div class="col-5">                
                <div class="form-group">
                  <input type="text" placeholder="Name" value="{{ old('name') }}" name="name" class="form-control">
                </div>
              </div>

              <div class="col-4">                
                <div class="form-group">       
                  <select name="status" class="form-control w-100">
                    <option value>Select Status</option>
                    <option value="1" {{ old('status') === '1' ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ old('status') === '0' ? 'selected' : '' }}>Stopped</option>
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
                <a href="{{ route('dashboard.categories.create') }}" role="button" class="btn btn-sm btn-primary mb-2">
                    <span>New Category</span>
                    <i class="fa fa-plus-square"></i>
                </a>
              </div>
            </div>
          
          <div class="card-header d-flex align-items-center">
            <h3 class="h4">
              Categories List
            </h3>
          </div>
          
          <div class="card-body">
            <div class="table-responsive">  
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th class="text-center">Clients</th>
                    <th class="text-center">Logo</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                </thead>

                <tbody>
                  @foreach($categories as $category)

                    <tr>
                      <th>{{ $category->id }}</th>
                      <td>{{ $category->name }}</td>
                      <td class="text-center">{{ $category->clients->count() }}</td>
                      <td class="text-center">
                        @if($category->logo)
                          <img src="{{ asset('img/categories/'.$category->logo) }}" class="img-fluid table-img">
                        @else
                          --
                        @endif
                      </td>
                      <td>
                        @if($category->status == 0)
                          <span class="text-danger">Stopped</span>
                        @else
                          <span class="text-success">Active</span>
                        @endif
                      </td>
                      <td>
                        
                        <a href="{{ route('dashboard.categories.show', $category->id) }}" class="btn btn-primary btn-sm">
                          <i class="fa fa-eye"></i>
                        </a>

                        <a href="{{ route('dashboard.categories.edit', $category->id) }}" class="btn btn-warning btn-sm">
                          <i class="fa fa-edit"></i>
                        </a>

                        <form method="POST" class="d-inline" action="{{ route('dashboard.categories.destroy', $category->id) }}">
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
            {{ $categories->links() }}              
          </div>

        </div>
      </div>

    </div>
  </div>
</section>


@endsection
