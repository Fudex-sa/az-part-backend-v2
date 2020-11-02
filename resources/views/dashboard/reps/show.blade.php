@extends('dashboard.app')

@section('title')   {{$item->name}} @endsection

@section('styles')
    
    <link href="{{ dashboard('vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">
    <link href="{{asset('templates/maps/style.css')}}" type="text/css" rel="stylesheet">

@endsection


@section('content')
    
<div class="col-md-3 col-sm-3 col-xs-12 profile_left">
    <div class="profile_img">
        <div id="crop-avatar">
            <!-- Current avatar -->
            <img class="img-responsive avatar-view" alt="Avatar" title="{{ $item->name }}"
            src="{{ $item->photo ? asset('uploads/'.$item->photo) : dashboard('build/images/user.png') }}">
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
               data-toggle="tab"
                aria-expanded="false"> @lang('site.personal_info') </a>
            </li>

            <li role="presentation" class=""><a href="#tab_content2"  
                                                      role="tab" data-toggle="tab"
                                                      aria-expanded="true">  @lang('site.my_requests') </a>
            </li>

            <li role="presentation" class=""><a href="#tab_content3"  
                role="tab" data-toggle="tab"
                aria-expanded="true">  @lang('site.my_prices') </a>
            </li>
 
        </ul>
<div id="myTabContent" class="tab-content">

<div role="tabpanel" class="tab-pane fade  active in" id="tab_content1">
        
@include('dashboard.reps.edit')   

</div>


<div role="tabpanel" class="tab-pane fade" id="tab_content2">

    
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

<div role="tabpanel" class="tab-pane fade" id="tab_content3">
    @include('dashboard.reps.my_prices')       
</div>
 

</div>
    </div>
</div>
 

@endsection

@section('popup')
 
@endsection
 
@section('scripts')
     
    <script src="{{ dashboard('vendors/iCheck/icheck.min.js') }}" type="text/javascript"></script>
    <script src="{{site('maps/script.js')}}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDBr8fHyX4CFO0PMq4dxJlhPH8RrjXfyN8&libraries=places&callback=initAutocomplete"
    async defer></script>
    
    @include('dashboard.ajax.load_regions') 
    @include('dashboard.ajax.load_cities')

    <script>
        $("#country").change(function(){

            var country_id = $(this).val();
            var _token = "{{ csrf_token() }}"; 

            $.ajax({
                type: 'POST',
                url: "{{ route('regions.load') }}",
                data: {_token: _token , country_id:country_id},
                success: function (response) {
                    if(response)
                    $("#region").html(response);
                }
            });            
        });

        $("#region").change(function(){             
            var region_id = $(this).val();
            var _token = "{{ csrf_token() }}"; 
 
            $.ajax({
                type: 'POST',
                url: "{{ route('cities.load') }}",
                data: {_token: _token , region_id:region_id},
                success: function (response) {
                    if(response)
                    $("#city").html(response);
                }
            });            
        });
    </script>

@endsection