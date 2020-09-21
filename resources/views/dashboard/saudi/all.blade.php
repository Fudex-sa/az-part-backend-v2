@extends('dashboard.layouts.app')

@section('title') @lang('site.saudi_section') @endsection

@section('styles')
    
@endsection


@section('content')
   
<div class="">

    <div class="page-title">
        <div class="title_left">
        <h3> 
            <a href="{{ route('admin.dashboard') }}"> @lang('site.dashboard') </a> /
            
            @if(isset($level2)) <a href="{{ route($level2['link']) }}"> 
                    @lang('site.'.$level2['name']) </a> / @endif
    
             @yield('title') </h3>
        </div>
    
        <div class="title_right">
            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                <div class="input-group">
                    <form method="get" action="{{ route('admin.search') }}">
                        @csrf
                        <input type="text" class="form-control" name="search_text" 
                                value="{{ app('request')->input('search_text') }}">
    
                        <span class="input-group-btn">
                            <button class="btn btn-default btn-search" type="submit">@lang('site.search')</button>
                        </span>
                    </form>
                </div>
            </div>
        </div>
    </div>

      

<div class="row">

    <div class="col-md-6">
        <div class="x_panel">
            <div class="x_title">
                <h2> @lang('site.users')                    
                </h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li> <a class="collapse-link"><i class="fa fa-chevron-up"></i></a> </li>                    
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th> @lang('site.name') </th>
                        <th> @lang('site.mobile') </th>
                        <th> @lang('site.active') </th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $k=>$user)
                    <tr>
                        <th scope="row"> {{ $k+1 }} </th>
                        
                        <td> <a href="{{ route('admin.user',$user->id) }}"> {{ $user->name }} </a> </td>
                        
                        <td> {{ $user->mobile }} </td>
                        
                        <td>
                            @if($user->active ==1) <button class="btn btn-success btn-xs">
                                <i class="fa fa-check"></i> @lang('site.yes') </button>
                            @else
                                <button class="btn btn-warning btn-xs">
                                <i class="fa fa-close"></i> @lang('site.no') </button>
                            @endif     
                        </td>
                    </tr>
                        @endforeach
                    </tbody>
                </table>
                
                <div class="text-center"> {{ $users->links() }} </div>
                  
            </div>
        </div>
    </div>


    <div class="col-md-6">
        <div class="x_panel">
            <div class="x_title">
                <h2> @lang('site.companies')                    
                </h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li> <a class="collapse-link"><i class="fa fa-chevron-up"></i></a> </li>                    
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th> @lang('site.name') </th>
                        <th> @lang('site.mobile') </th>
                        <th> @lang('site.active') </th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($companies as $k=>$company)
                    <tr>
                        <th scope="row"> {{ $k+1 }} </th>
                        
                        <td> <a href="{{ route('admin.company',$company->id) }}"> {{ $company->name }} </a> </td>
                        
                        <td> {{ $company->mobile }} </td>
                        
                        <td>
                            @if($company->active ==1) <button class="btn btn-success btn-xs">
                                <i class="fa fa-check"></i> @lang('site.yes') </button>
                            @else
                                <button class="btn btn-warning btn-xs">
                                <i class="fa fa-close"></i> @lang('site.no') </button>
                            @endif     
                        </td>
                    </tr>
                        @endforeach
                    </tbody>
                </table>
                
                <div class="text-center"> {{ $companies->links() }} </div>
                  
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="x_panel">
            <div class="x_title">
                <h2> @lang('site.sellers')                    
                </h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li> <a class="collapse-link"><i class="fa fa-chevron-up"></i></a> </li>                    
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th> @lang('site.name') </th>
                        <th> @lang('site.mobile') </th>
                        <th> @lang('site.active') </th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($sellers as $k=>$seller)
                    <tr>
                        <th scope="row"> {{ $k+1 }} </th>
                        
                        <td> <a href="{{ route('admin.seller',$seller->id) }}"> {{ $seller->name }} </a> </td>
                        
                        <td> {{ $seller->mobile }} </td>
                        
                        <td>
                            @if($seller->active ==1) <button class="btn btn-success btn-xs">
                                <i class="fa fa-check"></i> @lang('site.yes') </button>
                            @else
                                <button class="btn btn-warning btn-xs">
                                <i class="fa fa-close"></i> @lang('site.no') </button>
                            @endif     
                        </td>
                    </tr>
                        @endforeach
                    </tbody>
                </table>
                
                <div class="text-center"> {{ $sellers->links() }} </div>
                  
            </div>
        </div>
    </div>


    <div class="col-md-6">
        <div class="x_panel">
            <div class="x_title">
                <h2> @lang('site.brokers')                    
                </h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li> <a class="collapse-link"><i class="fa fa-chevron-up"></i></a> </li>                    
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th> @lang('site.name') </th>
                        <th> @lang('site.mobile') </th>
                        <th> @lang('site.active') </th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($brokers as $k=>$broker)
                    <tr>
                        <th scope="row"> {{ $k+1 }} </th>
                        
                        <td> <a href="{{ route('admin.broker',$broker->id) }}"> {{ $broker->name }} </a> </td>
                        
                        <td> {{ $broker->mobile }} </td>
                        
                        <td>
                            @if($broker->active ==1) <button class="btn btn-success btn-xs">
                                <i class="fa fa-check"></i> @lang('site.yes') </button>
                            @else
                                <button class="btn btn-warning btn-xs">
                                <i class="fa fa-close"></i> @lang('site.no') </button>
                            @endif     
                        </td>
                    </tr>
                        @endforeach
                    </tbody>
                </table>
                
                <div class="text-center"> {{ $brokers->links() }} </div>
                  
            </div>
        </div>
    </div>

     

     



</div>

</div> 


@endsection



@section('scripts')
  
@endsection
