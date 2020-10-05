@extends('dashboard.app')

@section('title')   {{$item->name}} @endsection

@section('styles')
    
    <link href="{{ dashboard('vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">
 
@endsection


@section('content')
    
<div class="col-md-3 col-sm-3 col-xs-12 profile_left">
    <div class="profile_img">
        <div id="crop-avatar">
            
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

            <li role="presentation" class="">
                <a href="#tab_content4" id="cities-tab" role="tab" data-toggle="tab" 
                     aria-expanded="true">  @lang('site.cities_in_charges') </a>
            </li>
 
        </ul>
        
        <div id="myTabContent" class="tab-content">

            <div role="tabpanel" class="tab-pane fade  active in" id="tab_content1" aria-labelledby="profile-tab">
                    
                @include('dashboard.supervisors.edit')

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

                @include('dashboard.supervisors.permissions')

            </div>

            <div role="tabpanel" class="tab-pane fade" id="tab_content4" aria-labelledby="profile-tab">       

                @include('dashboard.supervisors.cities_in_charge')
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

    @include('dashboard.ajax.load_regions') 
    @include('dashboard.ajax.load_cities') 

@endsection