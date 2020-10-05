@extends('dashboard.app')

@section('title')  @lang('site.packages_management') @endsection

@section('styles')
    
@endsection


@section('content')
     
<div class="">

    <div class="page-title">
        
    
        <div class="title_right">
            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                <div class="input-group">
                    <form method="get" action="{{ route('admin.search') }}">
                        @csrf
                        <input type="text" class="form-control" name="search_text"
                                value="{{ app('request')->input('search_text') }}">

                        <span class="input-group-btn">
                            <button class="btn btn-default btn-search" type="submit">@lang('site.search')</button>
                        </span>
                    </form>
                </div>
            </div>
        </div>

       
        @if(has_permission('packages_add'))
            <a class="btn btn-warning" data-toggle="modal" data-target=".add_item"> 
                    <i class="fa fa-plus"></i>  @lang('site.add') </a> 
        @endif
 
            

    </div>

   

    <div class="clearfix"></div>
     
<div class="row">
  

    <div class="clearfix"></div>

    <div class="col-md-6">
        <div class="x_panel">
            <div class="x_title">
                <h2> @lang('site.manual_packages')                    
                </h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li> <a class="collapse-link"><i class="fa fa-chevron-up"></i></a> </li>                    
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <table class="table table-striped jambo_table bulk_action" id="myTbl">
                    <thead class=" text-primary">
                        <tr>
                          <th scope="col">#  </th>
                          <th scope="col"> {{ __('site.title') }}  </th>
                          <th scope="col">{{ __('site.stores_no') }}</th>
                          <th scope="col">{{ __('site.price') }}</th>
                          <th scope="col">{{ __('site.discount') }}</th>
                          <th scope="col" style="width: 80px;"></th>
                      </tr>
                      </thead>
                      <tbody>
                       @foreach($manual as $k=>$man)
                          <tr>
                              <td> {{$k+1}} </td>
                              
                              <td> {{$man['title_'.my_lang()]}} </td>
                              
                              <td> {{ $man->stores_no }} </td>
                              
                              <td> {{ $man->price }} </td>  

                              <td> {{ $man->discount }} </td>  

                              <td>
                                @if(has_permission('packages_edit'))
                                  <a href="{{ route('admin.package',$man->id) }}" class="btn btn-info btn-xs">
                                     <i class="fa fa-edit"></i> </a>
                                @endif

                                @if(has_permission('packages_delete'))
                                    <a onclick="deleteItem({{ $man->id }})" class="btn btn-danger btn-xs">
                                        <i class="fa fa-trash"></i> </a>
                                @endif
                              </td>
                          </tr>
                      @endforeach
                         
                      </tbody>
                
                    </table>
 
                  
            </div>
        </div>
    </div>


    <div class="col-md-6">
        <div class="x_panel">
            <div class="x_title">
                <h2> @lang('site.electronic_packages')                    
                </h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li> <a class="collapse-link"><i class="fa fa-chevron-up"></i></a> </li>                    
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                
                <table class="table table-striped jambo_table bulk_action" id="myTbl">
                    <thead class=" text-primary">
                        <tr>
                          <th scope="col">#  </th>
                          <th scope="col"> {{ __('site.title') }}  </th>
                          <th scope="col">{{ __('site.stores_no') }}</th>
                          <th scope="col">{{ __('site.price') }}</th>
                          <th scope="col">{{ __('site.discount') }}</th>
                          <th scope="col" style="width: 80px;"></th>
                      </tr>
                      </thead>
                      <tbody>
                       @foreach($electronic as $k=>$elect)
                          <tr>
                              <td> {{$k+1}} </td>
                              
                              <td> {{$elect['title_'.my_lang()]}} </td>
                              
                              <td> {{ $elect->stores_no }} </td>
                              
                              <td> {{ $elect->price }} </td>  

                              <td> {{ $elect->discount }} </td>  

                              <td>
                                @if(has_permission('packages_edit'))
                                  <a href="{{ route('admin.package',$elect->id) }}" class="btn btn-info btn-xs">
                                     <i class="fa fa-edit"></i> </a>
                                @endif

                                @if(has_permission('packages_delete'))
                                    <a onclick="deleteItem({{ $elect->id }})" class="btn btn-danger btn-xs">
                                        <i class="fa fa-trash"></i> </a>
                                @endif
                              </td>
                          </tr>
                      @endforeach
                         
                      </tbody>
                
                    </table>
                  
            </div>
        </div>
    </div>

    

     

</div>

</div>

@endsection

@section('popup')
    
    @include('dashboard.packages.create')

@endsection

    

@section('scripts')
    

    @include('dashboard.ajax.delete',['target'=>'package']) 
 
@endsection