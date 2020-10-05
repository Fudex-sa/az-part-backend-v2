@extends('dashboard.app')

@section('title')   {{$user->name}} @endsection

@section('styles')
    
    <link href="{{ dashboard('vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">

@endsection


@section('content')
    
<div class="col-md-3 col-sm-3 col-xs-12 profile_left">
    <div class="profile_img">
        <div id="crop-avatar">
            <!-- Current avatar -->
        <img class="img-responsive avatar-view" src="{{ dashboard('build/images/user.png') }}" alt="Avatar" 
                title="{{ $user->name }}">
        </div>
    </div>
    <h3> {{ $user->name }} </h3>

    <ul class="list-unstyled user_data">
        <li>
            <i class="fa fa-briefcase user-profile-icon"></i>  {{ __('site.'.$user->user_role) }}
        </li>

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
                      
            <div class="form-horizontal form-label-left">
 
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"> @lang('site.name')                           
                        </label>

                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="name" class="form-control col-md-7 col-xs-12" value="{{$user->name}}"
                             readonly>
                                                       
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"> @lang('site.email')                           
                        </label>

                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="email" name="email" class="form-control col-md-7 col-xs-12" 
                            value="{{$user->email}}" readonly>
                          
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"> @lang('site.mobile')                          
                        </label>

                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="tel" name="mobile" class="form-control col-md-7 col-xs-12" value="{{$user->mobile}}"
                            readonly>

                            @if ($errors->has('mobile'))
                                <span id="mobile_error" class="error text-danger">{{ $errors->first('mobile') }}</span>
                            @endif                            
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"> @lang('site.registeration_date')                          
                        </label>

                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input class="form-control" value="{{$user->created_at}}" readonly>                                               
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"> @lang('site.offers_placed_no')                          
                        </label>

                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input class="form-control" value="{{count($user->requestOffer) .' '. __('site.offers') }}" readonly>                                                                   
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"> @lang('site.cars_no')                          
                        </label>

                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input class="form-control" value="{{count($user->car) .' '. __('site.car') }}" readonly>                      
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"> @lang('site.change_offer_status')                          
                        </label>

                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <form method="post" action="{{ route('offerChange',$item->id) }}">
                                @csrf
                              <input type="hidden" name="user_id" value="{{ $user->id }}" />
                                <select name="status" class="form-control">
                                    <option value="pending" {{ $item->status == 'pending' ? 'selected' : '' }}> @lang('site.pending') </option>
                                    <option value="replied" {{ $item->status == 'replied' ? 'selected' : '' }}> @lang('site.replied') </option>
                                    <option value="not_allowed" {{ $item->status == 'not_allowed' ? 'selected' : '' }}> @lang('site.not_allowed') </option>
                                    <option value="processing" {{ $item->status == 'processing' ? 'selected' : '' }}> @lang('site.processing') </option>
                                    <option value="closed" {{ $item->status == 'closed' ? 'selected' : '' }}> @lang('site.closed') </option>
                                    <option value="rejected" {{ $item->status == 'rejected' ? 'selected' : '' }}> @lang('site.rejected') </option>
                                </select>
                                <br/>

                                <input type="submit" value="@lang('site.change')" class="btn btn-success" />
                              </form>

                        </div>
                    </div>
   
            </div>
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