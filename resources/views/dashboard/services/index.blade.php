@extends('dashboard.app')


@section('breadcrumb')
  <li class="breadcrumb-item">{{ __('lang.home') }}</li>
  {{-- <li class="breadcrumb-item"><a href="#">المستخدم</a></li> --}}
  <li class="breadcrumb-item active">{{ __('lang.services') }}</li>
@endsection

@section('content')

  @include('dashboard.includes.status')


<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-block">
        
        <form action="{{ route('admin.services.index') }}" method="get" class="form-inline">

            <div class="form-group">
                <input type="text" id="title" name="title" class="form-control" value="{{ old('title') }}" placeholder="{{ __('lang.services_title') }}">
            </div>

            <div class="form-group">
                <select id="status" name="status" class="form-control select-search" size="1">
                    <option value="">{{ __('lang.status') }}</option>
                    <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>{{ __('lang.active') }}</option>
                    <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>{{ __('lang.stopped') }}</option>
                </select>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                  <i class="fa fa-dot-circle-o"></i> {{ __('lang.search') }}
                </button>
            </div>

            <div class="form-group">
                <button type="button" class="btn btn-danger reset-form">
                  <i class="fa fa-ban"></i> {{ __('lang.reset') }}
                </button>
            </div>
        </form>

      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-12">
      <div class="card">
          <div class="card-header">
              <i class="fa fa-align-justify"></i> {{ __('lang.services') }}
              <a href="{{ route('admin.services.create') }}" class="btn btn-success btn-create {{ $currentLangDir == 'rtl' ? 'pull-left' : 'pull-right' }}">
                <i class="icon-plus"></i> {{ __('lang.create') }}
              </a>
          </div>

          <div class="card-block">
            
            @if(count($services) < 1)
              <div class="row">                
                <h4 class="col-12 text-danger text-xs-center"> {{ __('lang.noData') }} </h4>
              </div>
            @else

                <table class="table table-bordered table-striped table-condensed">
                    {{-- Table Header --}}
                    <thead>
                        <tr>
                            <th class="text-sm-center">{{ __('lang.id') }}</th>
                            <th class="text-sm-center">{{ __('lang.lang') }}</th>
                            <th class="text-sm-center">{{ __('lang.name') }}</th>
                            <th class="text-sm-center">{{ __('lang.image') }}</th>
                            <th class="text-sm-center">{{ __('lang.status') }}</th>
                            <th class="text-sm-center">{{ __('lang.show') }}</th>
                            <th class="text-sm-center">{{ __('lang.actions') }}</th>
                        </tr>
                    </thead>
                    
                      @foreach($services as $service)
                        
                        <tbody>
                            @foreach($service->translations as $serviceTranslation)
                                  
                              <tr class="text-sm-center">

                                  <td> 
                                    @if($loop->first)
                                      {{ $service->id }}
                                    @endif
                                  </td>
                                  
                                  <td> 
                                      {{ $serviceTranslation->locale }} 
                                  </td>
                                  
                                  <td> {{ $serviceTranslation->services_title }} </td>
                                  
                                  <td class="text-sm-center">
                                    @if($loop->first)
                                      <img src="{{ asset('uploads/services/' . $service->services_logo) }}" width="30px" class="img-fluid d-inline-block">
                                    @endif
                                  </td>

                                  <td> 
                                    @if($loop->first)
                                      @if($serviceTranslation->service->services_status == '0')
                                        <span class="tag tag-danger">{{ __('lang.stopped') }}</span>
                                      @else
                                        <span class="tag tag-success">{{ __('lang.active') }}</span>
                                      @endif

                                    @endif
                                  </td>

                                  <td> 
                                      <a href="{{ route('admin.services.show', [$service->id, 'showLang'  => $serviceTranslation->locale ] ) }}" 
                                          class="btn btn-primary btn-sm">
                                        <i class="icon-eye"></i>
                                      </a>
                                  </td>
                                  
                                  <td>
                                    
                                    @if($loop->first)
                                      

                                      <a href="{{ route('admin.services.edit', $service->id) }}" class="btn btn-warning btn-sm">
                                        <i class="icon-pencil"></i>
                                      </a>

                                      <form method="post" action="{{ route('admin.services.destroy', $service->id) }}" class="d-inline-block">
                                        @csrf
                                        @method('delete')

                                        <button class="btn btn-danger btn-sm delete-form" type="submit">
                                          <i class="icon-trash"></i>
                                        </button>
                                      </form>
                                    @endif

                                  </td>
                              </tr>
                            @endforeach
                        </tbody>
                      
                      @endforeach
                </table>

                {{ $services->links() }} 
            @endif

          </div>
      </div>
  </div>
  <!--/col-->
</div>


@endsection
