@extends('dashboard.layouts.app')

@section('title') @lang('site.supervisors') @endsection

@section('styles')

    <link href="{{ dashboard('vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">
    
@endsection


@section('content')
  
<div class="col-md-12 col-sm-12 col-xs-12">
  
    
    <div class="x_panel">
         
        <div class="x_content">
    
            <div class="table-responsive">
     
                
                    <form action="{{ route('admin.supervisor.search') }}" method="get" class="form-horizontal form-label-left">

                        @csrf
                            <div class="form-group col-md-5">
                                <label class="col-md-4 col-sm-3 col-xs-12"> @lang('site.supervisor_name') </label>

                                <div class="col-md-8 col-sm-6 col-xs-12">
                                <input type="text" name="name" class="form-control" value="{{ request()->name }}" required/>
                                </div>
                            </div>

                            <div class="form-group col-md-5">
                                <label class="col-md-3 col-sm-3 col-xs-12"> @lang('site.role') </label>

                                <div class="col-md-8 col-sm-6 col-xs-12">
                                    <select name="role" class="form-control">
                                        <option value=""> @lang('site.choose_role') </option>
    
                                        @foreach ($roles as $rol)
                                            <option value="{{ $rol->id }}" {{ request()->role == $rol->id ? 'selected' : '' }}> 
                                                {{ $rol['name_'.my_lang()] }} </option>
                                        @endforeach
                                    </select>
                                </div>
                               
                            </div>

                            <div class="form-group col-md-5">
                                <label class="col-md-4 col-sm-3 col-xs-12"> @lang('site.status') </label>

                                <div class="col-md-8 col-sm-6 col-xs-12">
                                    <label> <input type="radio" class="flat" name="status" value="1" checked required/> @lang('site.active') </label>
                                    <label> <input type="radio" class="flat" name="status" value="0" required/> @lang('site.de_active') </label>
                                </div>                               
                            </div>

                            <div class="form-group col-md-5">
                                <label class="col-md-3 col-sm-3 col-xs-12"> @lang('site.country') </label>

                                <div class="col-md-8 col-sm-6 col-xs-12">
                                    <select name="country" id="country_id" class="form-control">
                                        <option value=""> @lang('site.choose_country') </option>
                                        
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}" {{ request()->country == $country->id ? 'selected' : '' }}>
                                                 {{ $country['name_'.my_lang()] }} </option>
                                        @endforeach
                                    </select>
                                </div>                               
                            </div>


                            <div class="form-group col-md-5">
                                <label class="col-md-4 col-sm-3 col-xs-12"> @lang('site.region') </label>

                                <div class="col-md-8 col-sm-6 col-xs-12">
                                    <select name="region" id="region_id" class="form-control">
                                        <option value=""> @lang('site.choose_region') </option>
                                        {{-- @foreach ($regions as $reg)
                                            <option value="{{ $reg->id }}"> {{ $reg['name_'.my_lang()] }} </option>
                                        @endforeach --}}
                                    </select>
                                </div>                               
                            </div>

                            <div class="form-group col-md-5">
                                <label class="col-md-3 col-sm-3 col-xs-12"> @lang('site.city') </label>

                                <div class="col-md-8 col-sm-6 col-xs-12">
                                    <select id="cities" name="city" class="form-control">
                                        <option value=""> @lang('site.choose_city') </option>
                                    </select>
                                </div>                               
                            </div>

                            <div class="form-group col-md-2">
                                <button type="submit" class="btn btn-success"> @lang('site.search') </button>

                                <button type="button" onclick="window.location.href='{{ route('admin.supervisors') }}'" 
                                class="btn btn-primary"> @lang('site.all') </button>
                            </div>
   
                    </form>
 
 
                
    
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
    
                <div class="col-md-12">
                    @include('dashboard.layouts.message')
                </div>
    
                
                
                <div class="btn-group">
        
                    @if(has_permission('supervisors_add'))
                        <a href="{{route('admin.supervisor.add')}}" class="btn btn-warning"> 
                            <i class="fa fa-plus"></i>  @lang('site.add') </a> 
                    @endif
            
                    @if(has_permission('supervisors_show'))
                        <a href="{{route('export.excel.users')}}" class="btn btn-success"> 
                            <i class="fa fa-download"></i>  @lang('site.excel') </a> 
                    @endif
            
                    @if(has_permission('supervisors_show'))
                        <a href="{{route('export.pdf.users')}}" class="btn btn-info"> 
                            <i class="fa fa-file"></i>  @lang('site.pdf') </a> 
                    @endif
                </div>
            
            <br/> <br/>
            
            <table class="table table-striped jambo_table bulk_action">
                <thead>
                <tr class="headings">
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
                        
                        <td> @if($item->photo) <img src="{{ img_path($item->photo) }}" class="img-tbl" /> 
                                @else  <img src="{{ dashboard('build/images/user.png') }}" class="img-tbl" />  @endif
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
            
            <div class="text-center"> {{ $items->links() }} </div>


    
            </div>
        </div>
    </div>


</div>



    
    
 

@endsection



@section('scripts')
    @include('dashboard.layouts.message_growl') 

    @include('dashboard.ajax.delete',['target'=>'supervisor']) 
    
    @include('dashboard.ajax.activate',['target'=>'supervisor']) 

    <script src="{{ dashboard('vendors/iCheck/icheck.min.js') }}" type="text/javascript"></script>

    @include('dashboard.ajax.load_regions') 
    @include('dashboard.ajax.load_cities') 
    
@endsection
