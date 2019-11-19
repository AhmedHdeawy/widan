@extends('dashboard.app')


@section('breadcrumb')
  <li class="breadcrumb-item">{{ __('lang.home') }}</li>
  {{-- <li class="breadcrumb-item"><a href="#">المستخدم</a></li> --}}
  <li class="breadcrumb-item active">{{ __('lang.infos') }}</li>
@endsection

@section('content')

  @include('dashboard.includes.status')

<div class="row">
  <div class="col-12">
      <div class="card">
          <div class="card-header">
              <i class="fa fa-align-justify"></i> {{ __('lang.infos') }}
          </div>

          <div class="card-block">
            
            @if(count($infos) < 1)
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
                            <th class="text-sm-center">{{ __('lang.desc') }}</th>
                            <th class="text-sm-center">{{ __('lang.status') }}</th>
                            <th class="text-sm-center">{{ __('lang.show') }}</th>
                            <th class="text-sm-center">{{ __('lang.actions') }}</th>
                        </tr>
                    </thead>
                    
                      @foreach($infos as $info)
                        
                        <tbody>
                            @foreach($info->translations as $infoTranslation)
                                  
                              <tr class="text-sm-center">

                                  <td> 
                                    @if($loop->first)
                                      {{ $info->id }}
                                    @endif
                                  </td>
                                  
                                  <td> {{ $infoTranslation->locale }} </td>
                                  
                                  <td> 
                                    @if($loop->first)
                                      {{ __('lang.'.$infoTranslation->info->infos_key) }} 
                                    @endif
                                  </td>
                                  
                                  <td class="text-sm-center"> {{ substr($infoTranslation->infos_desc, 0, 20)  }}... </td>

                                  <td> 
                                    @if($loop->first)
                                      @if($infoTranslation->info->infos_status == '0')
                                        <span class="tag tag-danger">{{ __('lang.stopped') }}</span>
                                      @else
                                        <span class="tag tag-success">{{ __('lang.active') }}</span>
                                      @endif

                                    @endif
                                  </td>

                                  <td> 
                                      <a href="{{ route('admin.infos.show', [$info->id, 'showLang'  => $infoTranslation->locale ] ) }}" 
                                          class="btn btn-primary btn-sm">
                                        <i class="icon-eye"></i>
                                      </a>
                                  </td>
                                  
                                  <td>
                                    
                                    @if($loop->first)
                                      

                                      <a href="{{ route('admin.infos.edit', $info->id) }}" class="btn btn-warning btn-sm">
                                        <i class="icon-pencil"></i>
                                      </a>
                                    @endif

                                  </td>
                              </tr>
                            @endforeach
                        </tbody>
                      
                      @endforeach
                </table>

                {{ $infos->links() }} 
            @endif

          </div>
      </div>
  </div>
  <!--/col-->
</div>


@endsection
