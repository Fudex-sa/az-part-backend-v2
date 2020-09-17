@extends('dashboard.layouts.app')

@section('title') 
    {{ __('site.send_offer_on') . 'AZ-'.  $item->request_id }}
@endsection

@section('styles')
    
    <link href="{{ dashboard('vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">
    
@endsection


@section('content')
   
@php
    if($item->request['request_type'] == 'vip')  
        $route = route('admin.sendVipOffer',$item->request_id);

    else $route = route('admin.sendNormalOffer',$item->request_id);

@endphp

<form action="{{ $route }}" method="post" 
    data-parsley-validate class="form-horizontal form-label-left">

    @csrf

    <input type="hidden" value="{{ LaravelLocalization::getCurrentLocale() }}" name="lang" />
    <input type="hidden" value="{{ $item->user_id }}" name="user_id" />
    <input type="hidden" value="{{ $item->request_id }}" name="request_id" />


        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12"> @lang('site.offer_price')
                <span class="required">*</span>
            </label>

            <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="number" value="{{ old('price') }}"  name="price" class="form-control col-md-7 col-xs-12" min="0" required>
                 
                @if ($errors->has('name'))
                    <span id="price_error" class="error text-danger">{{ $errors->first('price') }}</span>
                @endif                            
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12"> @lang('site.guarantee')
                <span class="required">*</span>
            </label>

            <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" value="{{ old('guarantee') }}"  name="guarantee" class="form-control col-md-7 col-xs-12" min="0" required>
                 
                @if ($errors->has('name'))
                    <span id="guarantee_error" class="error text-danger">{{ $errors->first('guarantee') }}</span>
                @endif                            
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12"> @lang('site.composition')
                <span class="required">*</span>
            </label>

            <div class="col-md-6 col-sm-6 col-xs-12">
            
                <label> 
                    <input type="radio" class="flat" name="composition" value="1" checked required/> @lang('site.yes')
                </label>

                <label> 
                    <input type="radio" class="flat" name="composition" value="0" required/> @lang('site.no')
                </label>

                @if ($errors->has('composition'))
                    <span id="composition_error" class="error text-danger">{{ $errors->first('composition') }}</span>
                @endif                            
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12"> @lang('site.rewind')
                <span class="required">*</span>
            </label>

            <div class="col-md-6 col-sm-6 col-xs-12">
            
                <label> 
                    <input type="radio" class="flat" name="rewind" value="1" checked required/> @lang('site.yes')
                </label>

                <label> 
                    <input type="radio" class="flat" name="rewind" value="0" required/> @lang('site.no')
                </label>

                @if ($errors->has('composition'))
                    <span id="rewind_error" class="error text-danger">{{ $errors->first('rewind') }}</span>
                @endif                            
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12"> @lang('site.delivery')
                <span class="required">*</span>
            </label>

            <div class="col-md-6 col-sm-6 col-xs-12">
            
                <label> 
                    <input type="radio" class="flat" name="delivery" value="1" checked required/> @lang('site.yes')
                </label>

                <label> 
                    <input type="radio" class="flat" name="delivery" value="0" required/> @lang('site.no')
                </label>

                @if ($errors->has('composition'))
                    <span id="delivery_error" class="error text-danger">{{ $errors->first('delivery') }}</span>
                @endif                            
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12"> @lang('site.notes')                
            </label>

            <div class="col-md-6 col-sm-6 col-xs-12">
                <textarea name="notes" id="notes" class="form-control"></textarea>                          
            </div>
        </div>
        
         

        <div class="ln_solid"></div>
        <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <button type="button" onclick="window.location.href='{{ route('admin.requests.normal') }}'" 
                class="btn btn-primary"> @lang('site.cancel') </button>

                <button type="submit" class="btn btn-success"> @lang('site.send') </button>
            </div>
        </div>

    </form>
 

@endsection

@include('dashboard.layouts.message')

@section('scripts')
     
    <script src="{{ dashboard('vendors/iCheck/icheck.min.js') }}" type="text/javascript"></script>

@endsection