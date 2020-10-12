@extends('dashboard.app')

@section('title')   {{$user->name}} @endsection

@section('styles')
    
    <link href="{{ dashboard('vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">

@endsection


@section('content')
    
<div class="col-md-3 col-sm-3 col-xs-12 profile_left">
    <div class="profile_img">
        <div id="crop-avatar">
            
        @if(auth('admin')->user()->photo )
            <img class="img-responsive avatar-view" src="{{ asset('uploads/'.auth('admin')->user()->photo) }}" alt="Avatar" 
                title="{{ $user->name }}">
        @else
            <img class="img-responsive avatar-view" src="{{ dashboard('build/images/user.png') }}" alt="Avatar" 
            title="{{ $user->name }}">
        @endif
        </div>
    </div>
    <h3> {{ $user->name }} </h3>

    <ul class="list-unstyled user_data">
        {{-- <li> <i class="fa fa-briefcase user-profile-icon"></i>  {{ __('site.'.$user->user_role) }} </li> --}}

        <li class="m-top-xs">
            <i class="fa fa-phone"></i> <a href="tel:{{ $user->mobile }}"> {{ $user->mobile }} </a>
        </li>

        <li>
            <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                <span> @lang('site.registered_date') : 
                    {{ date('d/m/Y ', strtotime($user->created_at)) }}
                 </span>
        </li>
    </ul>

    @if($user->vip == 1)
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
 
        </ul>
        <div id="myTabContent" class="tab-content">

            <div role="tabpanel" class="tab-pane fade  active in" id="tab_content1" aria-labelledby="profile-tab">
                      
            <form action="{{ route('admin.profile.update') }}" method="post" enctype="multipart/form-data"
                data-parsley-validate class="form-horizontal form-label-left">

                @csrf
 
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"> @lang('site.photo') </label>

                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="file" name="photo" />             
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"> @lang('site.name')
                            <span class="required">*</span>
                        </label>

                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="name" class="form-control col-md-7 col-xs-12" value="{{$user->name}}"
                            required>
                            @if ($errors->has('name'))
                                <span id="name_error" class="error text-danger">{{ $errors->first('name') }}</span>
                            @endif                            
                        </div>
                    </div>
                    

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"> @lang('site.email')
                            <span class="required">*</span>
                        </label>

                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="email" name="email" class="form-control col-md-7 col-xs-12" value="{{$user->email}}">
                            @if ($errors->has('email'))
                                <span id="email_error" class="error text-danger">{{ $errors->first('email') }}</span>
                            @endif                            
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"> @lang('site.mobile')
                            <span class="required">*</span>
                        </label>

                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="tel" name="mobile" class="form-control col-md-7 col-xs-12" value="{{$user->mobile}}"
                            required>
                            @if ($errors->has('mobile'))
                                <span id="mobile_error" class="error text-danger">{{ $errors->first('mobile') }}</span>
                            @endif                            
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"> @lang('site.password') </label>

                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="password" name="password" autocomplete="new-password"
                            class="form-control col-md-7 col-xs-12" >
                            
                            @if ($errors->has('password'))
                                <span id="password_error" class="error text-danger">{{ $errors->first('password') }}</span>
                            @endif                            
                        </div>
                    </div>
 

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"> @lang('site.vip') </label>

                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label> 
                                <input type="radio" class="flat" name="vip" value="1"  
                                {{ $user->vip == 1 ? 'checked' : '' }} required/> @lang('site.yes')
                            </label>

                            <label>
                                <input type="radio" class="flat" name="vip" value="0"  
                                {{ $user->vip == 0 ? 'checked' : '' }} required/> @lang('site.no')
                            </label>
                            
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"> @lang('site.active') </label>

                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label> 
                                <input type="radio" class="flat" name="active" value="1"  
                                {{ $user->active == 1 ? 'checked' : '' }} required/> @lang('site.yes')
                            </label>

                            <label>
                                <input type="radio" class="flat" name="active" value="0"  
                                {{ $user->active == 0 ? 'checked' : '' }} required/> @lang('site.no')
                            </label>
                           
                        </div>
                    </div>



                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"> @lang('site.saudi') </label>

                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label> 
                                <input type="radio" class="flat" name="saudi" value="1"  
                                {{ $user->saudi == 1 ? 'checked' : '' }} required/> @lang('site.yes')
                            </label>

                            <label>
                                <input type="radio" class="flat" name="saudi" value="0"  
                                {{ $user->saudi == 0 ? 'checked' : '' }} required/> @lang('site.no')
                            </label>
                           
                        </div>
                    </div>
 

                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button type="button" onclick="window.location.href='{{ route('admin.users') }}'" 
                            class="btn btn-primary"> @lang('site.cancel') </button>

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

@endsection