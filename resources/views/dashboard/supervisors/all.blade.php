@extends('dashboard.app')

@section('title') @lang('site.supervisors') @endsection

@section('styles')

    <link href="{{ dashboard('vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">
    
@endsection


@section('content')
  
<div class="col-md-12 col-sm-12 col-xs-12">
  
    
    <div class="x_panel">
         
        <div class="x_content">
    
            <div class="table-responsive">
                @include('dashboard.supervisors.filter')
            </div>
        </div>
    </div>



    <div class="x_panel">
        <div class="x_title">
            <h2> @yield('title') </h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                  
            </ul>
            <div class="clearfix"></div>
        </div>
    
        <div class="x_content">
    
            <div class="table-responsive">
     
                <div class="row">
                    <div class="col-md-10 btn-group">
                        @if(has_permission('supervisors_show'))
                            <a href="{{route('export.excel.users')}}" class="btn btn-info">
                                <i class="fa fa-download"></i>  @lang('site.excel') </a>
                        @endif
    
                        @if(has_permission('supervisors_show'))
                            <a href="{{route('export.pdf.users')}}" class="btn btn-info">
                                <i class="fa fa-file"></i>  @lang('site.pdf') </a>
                        @endif
            
                        @if(has_permission('supervisors_show'))
                            <a class="btn btn-success" data-toggle="modal" data-target=".add_item">                     
                                <span class="glyphicon glyphicon-export" aria-hidden="true"></span>                                        
                                @lang('site.import') 
                            </a>
                        @endif
                    </div>
            
                    <div class="col-md-2 text-left">
                        @if(has_permission('supervisors_add'))
                            <a href="{{route('admin.supervisor.add')}}" class="btn btn-warning">
                                <i class="fa fa-plus"></i>  @lang('site.add') </a>
                        @endif
                    </div>
             
                </div>
 
            
            <br/> <br/>
            
            <table class="table table-striped jambo_table bulk_action text-center">
                <thead class="th-center">
                <tr>
                    <th>#  </th>
                    <th> @lang('site.user_id')</th>
                    <th> <i class="fa fa-camera"> </i> </th>
                    <th> @lang('site.name')   </th>     
                    <th> @lang('site.user_role') </th>                     
                    <th> @lang('site.vip') </th>
                    <th> @lang('site.stores_added') </th>
                    <th> @lang('site.active') </th>
                    
                    <th style="width:120px;"></th>
                </tr>
                </thead>
            
                <tbody>
                    
                    @foreach($items as $k=>$item)
            
                    <tr class="even pointer">
                      
                        <td>{{ $k+1 }}</td>
            
                        <td>user#{{$item->id}}</td>
                        
                        <td> @if($item->photo) <img src="{{ img_path($item->photo) }}" class="img-user" /> 
                                @else  <img src="{{ dashboard('build/images/user.png') }}" class="img-user" />  @endif
                        </td>
            
                        <td>{{$item->name}}</td>
                         
                        <td>
                            @foreach ($item->supervisor_roles as $sup_role)
                                <label class="btn btn-default">
                                    <a href="{{ route('admin.role',$sup_role->role['id']) }}"> {{ __($sup_role->role['name_'.my_lang()]) }} </a> </label>
                            @endforeach
                        </td>
            
                        <td>
                            @if($item->vip ==1) <button class="btn btn-success btn-xs">
                                     <i class="fa fa-check"></i> @lang('site.yes') </button>
                            @else
                                <button class="btn btn-warning btn-xs">
                                <i class="fa fa-close"></i> @lang('site.no') </button>
                            @endif 
                        </td>
            
                        <td> {{ count($item->my_sellers) }} </td>
            
                        <td>
                            @if($item->id != 1)
                                @if($item->active ==1) <button class="btn btn-success btn-xs" onclick="activate({{ $item->id }})">
                                    <i class="fa fa-check"></i> @lang('site.de_activate') </button>
                                @else
                                    <button class="btn btn-warning btn-xs" onclick="activate({{ $item->id }})">
                                    <i class="fa fa-close"></i> @lang('site.activate') </button>
                                @endif     
                            @endif
                        </td>
                
                        <td>
                            @if($item->id != 1)
                                <a class="whatsapp btn btn-success btn-xs" target="_blank" href="https://wa.me/966{{$item->mobile}}?text=
                                    {{ setting('whatsapp_msg') }}"> <i class="fa fa-whatsapp"></i>
                                </a>
            
                                @if(has_permission('supervisors_edit'))
                                    <a href="{{ url('admin/supervisor',$item->id) }}" class="btn btn-info btn-xs"> <i class="fa fa-edit"></i> </a>
                                @endif
            
                                @if(has_permission('supervisors_delete'))
                                    <a onclick="deleteItem({{ $item->id }})" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> </a>
                                @endif
                            @endif
                        </td>
                    </tr>
                       
                    @endforeach
                    
                </tbody>
            </table>
            


    
            </div>
        </div>

        <div class="text-center">  {{ $items->links('vendor.pagination.bootstrap-4') }}  </div>

    </div>


</div>
 
@endsection

@section('popup')

    @include('dashboard.supervisors.import')

@endsection

@section('scripts')
    
    @include('dashboard.ajax.delete',['target'=>'supervisor']) 
    
    @include('dashboard.ajax.activate',['target'=>'supervisor']) 

    <script src="{{ dashboard('vendors/iCheck/icheck.min.js') }}" type="text/javascript"></script>

    @include('dashboard.ajax.load_regions') 
    @include('dashboard.ajax.load_cities') 
    
@endsection
