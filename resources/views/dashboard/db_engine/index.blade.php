@extends('dashboard.app')

@section('title') @lang('site.db_engine') @endsection

@section('styles')
    
@endsection


@section('content')
     

<div class="col-md-4 col-sm-12 col-xs-12">
    <div>
         
        <ul class="list-unstyled top_profiles scroll-view">
            <li class="media event">
                <a class="pull-left border-aero profile_thumb btn btn-success" href="{{ route('admin.empty_tables') }}">
                    <i class="fa fa-info "></i>  
                </a>
                

                <div class="media-body">
                    <a class="title" href="#"> @lang('site.empty_tables') </a>
                    <br/><br/>
                    <p>
                        <small> تفريغ الجداول التالية:
                            <ul> 
                                <li> @lang('site.assign_sellers') </li>    
                                <li> @lang('site.cars') </li>    
                                <li> @lang('site.car_comments') </li>    
                                <li> @lang('site.car_images') </li>    
                                <li> @lang('site.cart') </li>                                    
                                <li> @lang('site.contact_us') </li>    
                                <li> @lang('site.electronic_requests') </li>    
                                <li> @lang('site.orders') </li>    
                                <li> @lang('site.order_shipping') </li>    
                                <li> @lang('site.order_shipping_rejected') </li>
                                <li> @lang('site.package_subscribe') </li>
                                <li> @lang('site.reports') </li>
                            </ul>                                
                        </small>                        
                    </p>
                    
                </div>
            </li>
           
        </ul>
    </div>
</div>

 

@endsection

@section('popup')
 

@endsection

@section('scripts')
   
@endsection
