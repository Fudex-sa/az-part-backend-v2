@extends('dashboard.app')

@section('title') @lang('site.order_details') AZ-{{ $item->id }} @endsection

@section('styles')
    
@endsection


@section('content')
   
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        
        <div class="x_content">
            <div class="col-xs-3">
                <!-- required for floating -->
                <!-- Nav tabs -->
                <ul class="nav nav-tabs tabs-left">
                    <li class="active"><a href="#data" data-toggle="tab"> @lang('site.order_data') </a> </li>
                    
                    <li><a href="#details" data-toggle="tab"> @lang('site.order_details') </a></li>
                    
                    <li><a href="#shipping" data-toggle="tab"> @lang('site.shipping_data') </a></li>                     
                </ul>
            </div>

            <div class="col-xs-9">
                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active" id="data">
                        @include('dashboard.orders.data')
                    </div>

                    <div class="tab-pane" id="details">
                        @include('dashboard.orders.details')
                    </div>
                    
                    <div class="tab-pane" id="shipping">
                        @include('dashboard.orders.shipping')
                    </div>
                </div>
            </div>
            
            <div class="clearfix"></div>

        </div>
    </div>
</div>
 

@endsection

@section('popup')
 

@endsection

@section('scripts')

    @include('dashboard.ajax.confirm_paid',['target'=>'admin']) 

@endsection
