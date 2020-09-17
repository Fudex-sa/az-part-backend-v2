@extends('dashboard.layouts.app')

@section('title') @lang('site.add_user') @endsection

@section('styles')
    
    <link href="{{ dashboard('vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">

@endsection


@section('content')
    
<div class="col-md-3 col-sm-3 col-xs-12 profile_left">
    <div class="profile_img">
        <div id="crop-avatar">
            <!-- Current avatar -->
        <img class="img-responsive avatar-view" src="{{ dashboard('build/images/user.png') }}" alt="Avatar">
        </div>
    </div>
    

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
                      
            <form action="{{ route('admin.user.store') }}" method="post" 
                data-parsley-validate class="form-horizontal form-label-left">

                @csrf
                <input type="hidden" value="{{ LaravelLocalization::getCurrentLocale() }}" name="lang" />

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"> @lang('site.name')
                            <span class="required">*</span>
                        </label>

                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="name" class="form-control col-md-7 col-xs-12" value="{{ old('name') }}"
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
                            <input type="email" name="email" class="form-control col-md-7 col-xs-12" value="{{ old('email') }}">
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
                            <input type="tel" name="mobile" class="form-control col-md-7 col-xs-12" value="{{ old('mobile') }}"
                            required>
                            @if ($errors->has('mobile'))
                                <span id="mobile_error" class="error text-danger">{{ $errors->first('mobile') }}</span>
                            @endif                            
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"> @lang('site.password') </label>

                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="password" name="password" class="form-control col-md-7 col-xs-12" >
                            @if ($errors->has('password'))
                                <span id="password_error" class="error text-danger">{{ $errors->first('password') }}</span>
                            @endif                            
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"> @lang('site.user_role') </label>

                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control" name="user_role">
                                <option value="user" {{ old('user_role') == 'user' ? 'selected' : '' }}>{{__('site.user')}}</option>
                                <option value="company" {{ old('user_role') == 'company' ? 'selected' : '' }}>{{__('site.company')}}</option>
                                <option value="supervisor" {{ old('user_role') == 'supervisor' ? 'selected' : '' }}>{{__('site.supervisor')}}</option>
                                <option value="mediator" {{ old('user_role') == 'mediator' ? 'selected' : '' }}>{{__('site.mediator')}}</option>
                                <option value="seller_tashalih" {{ old('user_role') == 'seller_tashalih' ? 'selected' : '' }}>{{__('site.seller_tashalih')}}</option>
                                <option value="seller_manufacturing" {{ old('user_role') == 'seller_manufacturing' ? 'selected' : '' }}>{{__('site.seller_manufacturing')}}</option>
                                <option value="admin" {{ old('user_role') == 'admin' ? 'selected' : '' }}>{{__('site.admin')}}</option>
                            </select>
                          @if ($errors->has('user_role'))
                            <span id="user_role_error" class="error text-danger" for="user_role">{{ $errors->first('user_role') }}</span>
                          @endif                       
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"> @lang('site.vip') </label>

                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label> 
                                <input type="radio" class="flat" name="vip" value="1"  
                                {{ old('vip') == 1 ? 'checked' : '' }} required/> @lang('site.yes')
                            </label>

                            <label>
                                <input type="radio" class="flat" name="vip" value="0"  
                                {{ old('vip') == 0 ? 'checked' : '' }} required/> @lang('site.no')
                            </label>

                            @if ($errors->has('active'))
                                <span id="active_error" class="error text-danger">{{ $errors->first('active') }}</span>
                            @endif      

                            @if ($errors->has('vip'))
                                <span id="vip_error" class="error text-danger">{{ $errors->first('vip') }}</span>
                            @endif                            
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"> @lang('site.active') </label>

                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label> 
                                <input type="radio" class="flat" name="active" value="1"  
                                {{ old('active') == 1 ? 'checked' : '' }} required/> @lang('site.yes')
                            </label>

                            <label>
                                <input type="radio" class="flat" name="active" value="0"  
                                {{ old('active') == 0 ? 'checked' : '' }} required/> @lang('site.no')
                            </label>

                            @if ($errors->has('active'))
                                <span id="active_error" class="error text-danger">{{ $errors->first('active') }}</span>
                            @endif                            
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"> @lang('site.rule') </label>

                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control" name="rule_id">
                                <option value="0">@lang('site.choose_rule')</option>

                                  @foreach($rules as $rule)
                                      <option value="{{$rule->id}}"
                                      {{ old('rule_id') == $rule->id ? 'selected' : '' }}>{{ $rule->name }}</option>
                                  @endforeach

                          </select>
                          @if ($errors->has('rule_id'))
                            <span id="rule_id_error" class="error text-danger" for="user_role">{{ $errors->first('rule_id') }}</span>
                          @endif                       
                        </div>
                    </div>

                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button type="button" onclick="window.location.href='{{ route('admin.users') }}'" 
                            class="btn btn-primary"> @lang('site.cancel') </button>

                            <button type="submit" class="btn btn-success"> @lang('site.send') </button>
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

    @include('dashboard.layouts.message')

@section('scripts')
     
    <script src="{{ dashboard('vendors/iCheck/icheck.min.js') }}" type="text/javascript"></script>

@endsection