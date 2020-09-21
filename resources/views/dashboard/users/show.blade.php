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

            <li role="presentation" class="active"><a href="#tab_content1" role="tab"
                id="profile-tab2" data-toggle="tab"
                aria-expanded="false"> @lang('site.personal_info') </a>
            </li>

            <li role="presentation" class=""><a href="#tab_content2" id="home-tab"
                                                      role="tab" data-toggle="tab"
                                                      aria-expanded="true">  @lang('site.user_requests') </a>
            </li>
             
           
        </ul>
<div id="myTabContent" class="tab-content">

<div role="tabpanel" class="tab-pane fade  active in" id="tab_content1" aria-labelledby="profile-tab">
        
<form action="{{ route('admin.user.store',$item->id) }}" method="post" data-parsley-validate class="form-horizontal form-label-left">

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
    
                            <input type="radio" class="flat" name="{{ $col }}" value="0"  
                                {{ $item->$col == 0 ? 'checked' : '' }} required/> @lang('site.no')
                            </label>
    
                        @else
                        <input type="text" name="{{ $col }}" class="form-control" value="{{ $item->$col }}">                                
    
                        @endif
                    </div>
                </div>
    
            @endif
        @endforeach
        
    
        <div class="ln_solid"></div>
        <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <button type="submit" class="btn btn-success"> @lang('site.save') </button>
    
                <button type="button" onclick="window.location.href='{{ route('admin.users') }}'" 
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

</div>
    </div>
</div>
 

@endsection

@section('popup')
 
@endsection
 
@section('scripts')
     
    <script src="{{ dashboard('vendors/iCheck/icheck.min.js') }}" type="text/javascript"></script>

@endsection