@extends('dashboard.layouts.app')

@section('title')   {{$item->name}} @endsection

@section('styles')
    
    <link href="{{ dashboard('vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">
 
@endsection


@section('content')
    
<div class="col-md-3 col-sm-3 col-xs-12 profile_left">
    <div class="profile_img">
        <div id="crop-avatar">
            <!-- Current avatar -->
        <img class="img-responsive avatar-view" src="{{ dashboard('build/images/user.png') }}" alt="Avatar" 
                title="{{ $item->name }}">
        </div>
    </div>
    <h3> {{ $item->name }} </h3>

    <ul class="list-unstyled user_data">
        <li>
            <i class="fa fa-briefcase user-profile-icon"></i>  {{ __('site.user') }}
        </li>

        <li class="m-top-xs">
            <i class="fa fa-phone"></i> <a href="tel:{{ $item->mobile }}"> {{ $item->mobile }} </a>
        </li>

        <li>
            <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                <span> @lang('site.registered_date') : 
                    {{ date('d/m/Y ', strtotime($item->created_at)) }}
                 </span>
        </li>
    </ul>

    @if($item->vip == 1)
        <a class="btn btn-success"><i class="fa fa-edit m-right-xs"></i>&nbsp; @lang('site.vip') </a>
    @else
        <a class="btn btn-danger"><i class="fa fa-edit m-right-xs"></i>&nbsp; @lang('site.not_vip') </a>
    @endif

    <br/>
 

</div>


<div class="col-md-9 col-sm-9 col-xs-12">
 
    
    <div class="" role="tabpanel" data-example-id="togglable-tabs">
        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">

            <li role="presentation" class="active">
                <a href="#tab_content1" role="tab" id="profile-tab2" data-toggle="tab" 
                    aria-expanded="false"> @lang('site.personal_info') </a>
            </li>

            <li role="presentation" class="">
                <a href="#tab_content2" id="home-tab" role="tab" data-toggle="tab" 
                     aria-expanded="true">  @lang('site.supervisor_requests') </a>
            </li>
             
            <li role="presentation" class="">
                <a href="#tab_content3" id="permissions-tab" role="tab" data-toggle="tab" 
                     aria-expanded="true">  @lang('site.permissions') </a>
            </li>

        </ul>
<div id="myTabContent" class="tab-content">

<div role="tabpanel" class="tab-pane fade  active in" id="tab_content1" aria-labelledby="profile-tab">
        
<form action="{{ route('admin.supervisor.store',$item->id) }}" method="post" data-parsley-validate 
    class="form-horizontal form-label-left" enctype="multipart/form-data">

    @csrf
    
        @foreach ($cols as $col)
            @if($col != 'id' & $col != 'created_at' & $col != 'updated_at' & $col != 'verification_code' 
                
                & $col != 'verified' & $col != 'lang' & $col != 'last_login' & $col != 'total_requests'
                
                & $col != 'rating' & $col != 'api_token' & $col != 'email_verified_at' & $col != 'remember_token')
    
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12"> @lang('site.'.$col)
                    @if($col == 'name' || $col == 'email' || $col == 'mobile' || $col == 'password')
                        <span class="required">*</span>
                    @endif
                    </label>
            
                    @if($col == 'available_requests')
                        <div class="col-md-2 col-sm-6 col-xs-12">
                    @else <div class="col-md-6 col-sm-6 col-xs-12"> @endif

                        @if($col == 'email')
                            <input type="email" name="{{ $col }}" class="form-control" value="{{ $item->$col }}"
                            required>  
    
                        @elseif($col == 'mobile')
                            <input type="tel" name="{{ $col }}" class="form-control" value="{{ $item->$col }}"
                            required>  
    
                        @elseif($col == 'password')
                            <input type="password" name="{{ $col }}" class="form-control">  
    
                        @elseif($col == 'available_requests')
                            <input type="number" min="1" name="{{ $col }}" class="form-control" value="{{ $item->$col }}"
                                required>  

                        @elseif($col == 'photo')
                            <input type="file" name="{{ $col }}" >  
    
                        @elseif($col == 'saudi' || $col == 'active' || $col == 'vip')
                            <label>
                                <input type="radio" class="flat" name="{{ $col }}" value="1"  
                                    {{ $item->$col == 1 ? 'checked' : '' }} required/> @lang('site.yes')
                            </label>
    
                            <label>
                                <input type="radio" class="flat" name="{{ $col }}" value="0"  
                                    {{ $item->$col == 0 ? 'checked' : '' }} required/> @lang('site.no')
                            </label>
                            
                        @elseif($col == 'user_type')
                            <label>
                                <input type="radio" class="flat" name="{{ $col }}" value="supervisor"  
                                    {{ $item->$col  == 'supervisor' ? 'checked' : '' }} required/> @lang('site.supervisor')
                            </label>

                            <label>
                                <input type="radio" class="flat" name="{{ $col }}" value="admin"  
                                    {{ $item->$col == 'admin' ? 'checked' : '' }} required/> @lang('site.admin')
                            </label>
                         
                        @else
                        <input type="text" name="{{ $col }}" class="form-control" value="{{ $item->$col }}">                                
    
                        @endif
                    </div>
                </div>
    
            @endif
        @endforeach
        
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12"> @lang('site.user_role') </label>

            <div class="col-md-9 col-sm-6 col-xs-12">
                 
                    @foreach ($roles as $role)
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label>
                            @if(in_array($role->id,$supervisor_rols))
                                <input type="checkbox" class="flat" name="role_id[]" value="{{ $role->id }}" 
                                checked /> {{ $role['name_'.my_lang()] }}
                            @else
                                <input type="checkbox" class="flat" name="role_id[]" value="{{ $role->id }}" />
                                {{ $role['name_'.my_lang()] }}
                            @endif
                        </label>                       
                    </div>                
                    @endforeach
                 
            </div>
        </div>


         
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12"> @lang('site.cities_in_charges') </label>

            <div class="col-md-9 col-sm-6 col-xs-12">
                 
                <select class="selectpicker form-control" multiple>
                    <option>Mekka</option>
                    
                  </select>
                 
            </div>
        </div>

       

        <div class="ln_solid"></div>
        <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <button type="submit" class="btn btn-success"> @lang('site.save') </button>
    
                <button type="button" onclick="window.location.href='{{ route('admin.sellers') }}'" 
                class="btn btn-primary"> @lang('site.cancel') </button>
            </div>
        </div>
    
    </form>

</div>


<div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">

    
<table class="data table table-striped no-margin">
    <thead>
    <tr>
        <th>#</th>
        <th> @lang('site.request_no') </th>
        <th> @lang('site.request_type') </th>
        <th> @lang('site.model') </th>
        <th> @lang('site.piece') </th>
        <th> @lang('site.city') </th>
        <th> @lang('site.accept_offer') </th>
    </tr>
    </thead>
    <tbody>
        

        
    </tbody>
</table>


</div>


<div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="permissions-tab">

    <form method="post" action="{{ route('admin.supervisor.permissions',$item->id) }}">
        @csrf
        <table class="table table-striped">
            <thead>                        
                <tr>
                    <th> @lang('site.permission') </th>
                    <th> @lang('site.show') </th>
                    <th> @lang('site.addtion') </th>
                    <th> @lang('site.edit') </th>
                    <th> @lang('site.delete') </th>
                </tr>
            </thead>
            <tbody>

                @foreach ($permissions as $item)
                    <tr>
                        <th> {{ __('site.'.$item->section) }} </th>
                        
                        <th> <input type="checkbox" class="show_all" name="permissions[]" value="{{ $item->section }}_show"
                            @if(in_array($item->section.'_show',$user_permissions)) checked @endif /> </th>

                        <th> <input type="checkbox" class="add_all" name="permissions[]" value="{{ $item->section }}_add" 
                            @if(in_array($item->section.'_add',$user_permissions)) checked @endif /> </th>

                        <th> <input type="checkbox" class="edit_all" name="permissions[]" value="{{ $item->section }}_edit" 
                            @if(in_array($item->section.'_edit',$user_permissions)) checked @endif /> </th>

                        <th> <input type="checkbox" class="delete_all" name="permissions[]" value="{{ $item->section }}_delete" 
                            @if(in_array($item->section.'_delete',$user_permissions)) checked @endif /> </th>
                    </tr>
                @endforeach
                    
                <tr>
                    <th> </th>
                    <th> <input type="checkbox" id="show_all"/> @lang('site.all') </th>
                    <th> <input type="checkbox" id="add_all"/> @lang('site.all') </th>
                    <th> <input type="checkbox" id="edit_all"/> @lang('site.all') </th>
                    <th> <input type="checkbox" id="delete_all"/> @lang('site.all') </th>
                </tr>
            
            </tbody>
        </table>

        <div class="ln_solid"></div>
        <div class="form-group">
            <div class="col-md-6 col-md-offset-3">
            <button type="button" onclick="location.href='{{ route('admin.supervisors') }}'" class="btn btn-primary"> 
                @lang('site.cancel') </button>

                <button type="submit" class="btn btn-success"> @lang('site.save') </button>
            </div>
        </div>

    </form>

</div>


</div>
    </div>
</div>
 

@endsection

@section('popup')
 
@endsection
 
@section('scripts')
     
    <script src="{{ dashboard('vendors/iCheck/icheck.min.js') }}" type="text/javascript"></script>

    <script>
        $("#show_all").click(function(){
            $(':checkbox.show_all').prop('checked', this.checked);    
        });

        $("#add_all").click(function(){
            $(':checkbox.add_all').prop('checked', this.checked);    
        });

        $("#edit_all").click(function(){
            $(':checkbox.edit_all').prop('checked', this.checked);    
        });

        $("#delete_all").click(function(){
            $(':checkbox.delete_all').prop('checked', this.checked);    
        });
 

    </script>
@endsection