<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ cur_dir() }}">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<!-- Meta, title, CSS, favicons, etc. -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="fontiran.com:license" content="Y68A9">
<link rel="icon" href="{{ site('images/logo.png') }}" type="image/ico"/>
<title>{{ config('app.name', 'AZParts') }} | @yield('title') </title>

<!-- Bootstrap -->
<link href="{{ dashboard('vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">

{{-- @if(cur_dir() == 'rtl') --}}
    <link href="{{ dashboard('vendors/bootstrap-rtl/dist/css/bootstrap-rtl.min.css') }}" rel="stylesheet">
{{-- @endif --}}

<!-- Font Awesome -->
<link href="{{ dashboard('vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
<!-- NProgress -->
<link href="{{ dashboard('vendors/nprogress/nprogress.css') }}" rel="stylesheet">

<!-- Custom Theme Style -->
<link href="{{ dashboard('build/css/custom.min.css') }}" rel="stylesheet">
<link href="{{ dashboard('dev.css') }}" rel="stylesheet">

@yield('styles')
</head>
<!-- /header content -->
<body class="nav-md">
<div class="container body">
<div class="main_container">
<div class="col-md-3 left_col hidden-print">
<div class="left_col scroll-view">
    <div class="navbar nav_title" style="border: 0;">
            <a href="{{ route('admin.dashboard') }}" class="site_title">
            <img src="{{ site('images/logo.png') }}" class="img-logo"/>
            <span> {{ config('app.name', 'AZParts') }}  </span></a>
    </div>

    <div class="clearfix"></div>

    <!-- menu profile quick info -->
    <div class="profile clearfix">
        <div class="profile_pic">
            <img src="{{ dashboard('build/images/img.jpg') }}" alt="..." class="img-circle profile_img">
        </div>
        <div class="profile_info">
            <span> @lang('site.welcome')  ,</span>
            <h2> {{ auth('admin')->user()->name }}  </h2>
        </div>
    </div>
    <!-- /menu profile quick info -->

    <br/>

    <!-- sidebar menu -->
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
        <div class="menu_section">     
            
            @if( has_permission('users') || has_permission('companies') || has_permission('sellers')
            ||  has_permission('brokers') ||  has_permission('reps') || has_permission('supervisors')
            || has_permission('saudis') || has_permission('vip_requests') || has_permission('roles')
            )
            <ul class="nav side-menu">
                <li><a><i class="fa fa-users"></i> {{ __('site.users_management') }}
                        <span class="fa fa-chevron-down"></span></a>

                    <ul class="nav child_menu">                       
                        @if(has_permission('users'))
                            <li> <a href="{{route('admin.users')}}"> {{ __('site.users') }} </a> </li>
                        @endif

                        @if(has_permission('companies'))
                            <li> <a href="{{route('admin.companies')}}"> {{ __('site.companies') }} </a> </li>
                        @endif

                        @if(has_permission('sellers'))
                            <li><a  href="{{route('admin.sellers')}}"> {{ __('site.sellers') }} </a> </li>
                        @endif

                        @if(has_permission('brokers'))
                            <li><a  href="{{route('admin.brokers')}}"> {{ __('site.brokers') }} </a> </li>
                        @endif

                        @if(has_permission('reps'))
                            <li> <a href="{{route('admin.reps')}}"> {{ __('site.reps') }} </a> </li>
                        @endif

                        @if(has_permission('supervisors'))
                            <li> <a href="{{route('admin.supervisors')}}"> {{ __('site.supervisors') }} </a> </li>                    
                        @endif

                        @if(has_permission('saudis'))
                            <li> <a href="{{route('admin.saudis')}}"> {{ __('site.saudi_section') }} </a> </li>
                        @endif

                        @if(has_permission('vip_requests'))
                            <li> <a href="{{route('admin.vip_requests')}}"> {{ __('site.requests_vip') }} </a> </li>                        
                        @endif

                        @if(has_permission('roles'))
                            <li> <a href="{{route('admin.roles')}}"> {{ __('site.roles') }} </a> </li>
                        @endif
                    </ul>
                </li>                             
            </ul>
            @endif

            
            <ul class="nav side-menu">
                <li><a><i class="fa fa-cog"></i> {{ __('site.general_settings') }}
                        <span class="fa fa-chevron-down"></span></a>

                    <ul class="nav child_menu">

                        @if(has_permission('socials'))
                            <li> <a  href="{{ route('admin.socials') }}">  {{ __('site.social_links') }} </a> </li>
                        @endif

                        @if(has_permission('settings'))
                            <li> <a href="{{ route('admin.settings') }}"> {{ __('site.site_settings') }} </a> </li>
                        @endif
        
                        @if(has_permission('countries'))
                            <li> <a href="{{route('admin.countries')}}"> {{ __('site.countries') }} </a> </li>
                        @endif
                                            
                    </ul>
                </li>                             
            </ul>
             

            
            <ul class="nav side-menu">
                <li><a><i class="fa fa-car"></i> {{ __('site.cars_management') }}
                        <span class="fa fa-chevron-down"></span></a>

                    <ul class="nav child_menu">
                        <li> <a href="{{ route('admin.cars.bidding') }}">                                         
                                {{ __('site.car_bidding') }}
                            </a>
                        </li>
        
                        <li> <a href="{{ route('admin.cars.antiques') }}">                                          
                                {{ __('site.antique_cars') }}
                            </a>
                        </li>
        
                        <li> <a href="{{ route('admin.cars.damaged') }}">                                           
                                {{ __('site.damaged_cars') }}
                            </a>
                        </li>
                                            
                    </ul>
                </li>                             
            </ul>
             


            {{-- @if(adminHasPermissions('requests')) --}}
            <ul class="nav side-menu">
                <li><a><i class="fa fa-shopping-cart"></i> {{ __('site.requests_and_offers') }}
                        <span class="fa fa-chevron-down"></span></a>

                    <ul class="nav child_menu">
                        <li> <a href="{{route('admin.requests.vip')}}">                                           
                                {{ __('site.special_requests') }}
                            </a>
                        </li>
        
                        <li> <a href="{{url('admin/requests/normal')}}">                                          
                                {{ __('site.normal_requests') }}
                            </a>
                        </li>
        
                        <li> <a href="{{url('admin/requests/assign_to_admin')}}">                                         
                                {{ __('site.admin_requests_assigned') }}
                            </a>
                        </li>
        
                        <li> <a href="{{url('admin/requests/express')}}">                                           
                                {{ __('site.let_admin_deal_requests') }}
                            </a>
                        </li>
        
                        <li> <a href="{{url('admin/requests/deleted')}}">                                           
                                {{ __('site.deleted_requests') }}
                            </a>
                        </li>
                                            
                    </ul>
                </li>                             
            </ul>
            {{-- @endif --}}


            
            <ul class="nav side-menu">
                
                @if(has_permission('packages'))
                    <li><a href="{{ route('admin.packages') }}"><i class="fa fa-tag"></i> 
                        {{ __('site.packages_management') }} </a></li>
                @endif

                {{-- @if(adminHasPermissions('brands')) --}}
                    <li><a href="{{ route('admin.brands') }}"><i class="fa fa-globe"></i> 
                        {{ __('site.brands_management') }}   <span
                    class="label label-success pull-left"> {{ Cache::get('brands') ? count(Cache::get('brands')) : '' }}  </span></a></li>
                {{-- @endif --}}

                {{-- @if(adminHasPermissions('pieces')) --}}
                    <li><a href="{{ route('admin.pieces') }}"><i class="fa fa-cogs"></i> 
                        {{ __('site.pieces_management') }}   <span
                    class="label label-success pull-left"> {{ Cache::get('pieces') ? count(Cache::get('pieces')) : '' }}   </span></a></li>
                {{-- @endif --}}

                {{-- @if(adminHasPermissions('BadWords')) --}}
                    <li><a href="{{ route('admin.badwords') }}"><i class="fa fa-close"></i> 
                        {{ __('site.Bad_Words') }} </a></li>
                {{-- @endif --}}

                {{-- @if(adminHasPermissions('contact')) --}}
                    <li><a href="{{ route('admin.contact_us')}}"><i class="fa fa-phone"></i> 
                        {{ __('site.contact_us') }}   </a></li>
                {{-- @endif --}}
            </ul>
                
            {{-- @if(adminHasPermissions('content')) --}}
            <ul class="nav side-menu">
                <li><a><i class="fa fa-database"></i> {{ __('site.content') }}
                        <span class="fa fa-chevron-down"></span></a>

                    <ul class="nav child_menu">
                        <li> <a href="{{ route('admin.page',1) }}">                                            
                                {{ __('site.about_us_management') }}
                            </a>
                        </li>
        
                        <li> <a href="{{ route('admin.page',2) }}">                                           
                                {{ __('site.privacy_policy') }}
                            </a>
                        </li>
        
                        <li> <a href="{{ route('admin.page',3) }}">                                         
                                {{ __('site.terms_and_condition') }}
                            </a>
                        </li>
        
                        <li> <a  href="{{ route('admin.sliders')}}">                                           
                                {{ __('site.slider') }}
                            </a>
                        </li>
        
                        <li> <a href="{{ route('admin.ticker',1) }}">                                         
                                {{ __('site.ticker') }}
                            </a>
                        </li>
                                            
                    </ul>
                </li>                             
            </ul>
            {{-- @endif --}}


            <ul class="nav side-menu">
                {{-- @if(adminHasPermissions('stock')) --}}
                    <li><a href="{{ route('admin.stock') }}"><i class="fa fa-money"></i> 
                        {{ __('site.stock') }} </a></li>
                {{-- @endif --}}

                {{-- @if(adminHasPermissions('ads')) --}}
                    <li><a href="{{ route('admin.ads')}}"><i class="fa fa-bullhorn"></i> 
                        {{ __('site.ads') }} </a></li>
                {{-- @endif --}}

                {{-- @if(adminHasPermissions('engine')) --}}
                    <li><a href="{{ route('admin.engine') }}"><i class="fa fa-forward"></i> 
                        {{ __('site.requests_engine') }} </a></li>
                {{-- @endif --}}

                {{-- @if(adminHasPermissions('messages')) --}}
                    <li><a href="{{ route('admin.messages') }}"><i class="fa fa-comment"></i> 
                        {{ __('site.messages') }} </a></li>
                {{-- @endif --}}
            </ul>


        </div>
            

    </div>
    <!-- /sidebar menu -->

    <!-- /menu footer buttons -->
    <div class="sidebar-footer hidden-small">
        <a href="{{route('admin.profile')}}" data-placement="top" title="@lang('site.profile')">
            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
        </a>

        <a data-toggle="tooltip" data-placement="top" title="تمام صفحه" onclick="toggleFullScreen();">
            <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
        </a>
        <a data-toggle="tooltip" data-placement="top" title="قفل" class="lock_btn">
            <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
        </a>
        <a data-toggle="tooltip" data-placement="top" title="@lang('site.logout')" 
        href="{{ route('admin.logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
        </a>
    </div>
    <!-- /menu footer buttons -->
</div>
</div>

<!-- top navigation -->
<div class="top_nav hidden-print">
<div class="nav_menu">
    <nav>
        <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
        </div>

        <ul class="nav navbar-nav navbar-right">
            <li class="">
                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown"
                    aria-expanded="false">
                    <img src="{{ dashboard('build/images/img.jpg') }}" alt=""> {{ auth('admin')->user()->name }}
                    <span class=" fa fa-angle-down"></span>
                </a>
                <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="{{route('admin.profile')}}"> @lang('site.profile') </a></li>
                        
                    <li><a href="{{ route('admin.logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out pull-right"></i> @lang('site.logout') </a></li>

                        @auth('admin')
                            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @endauth
                </ul>
            </li>

            <li role="presentation" class="dropdown">
                <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-globe"></i>
                </a>
                <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                    
                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <li>
                        <a href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">                             
                            <span>  {{ $properties['native'] }}  </span>                             
                        </a>
                    </li>
                    @endforeach
 
                   
                </ul>
            </li>
        </ul>
    </nav>
</div>
</div>
<!-- /top navigation -->
<!-- /header content -->
    
<!-- page content -->
<div class="right_col" role="main">

@if(cur_root() != 'admin.dashboard' && cur_root() != 'admin.piece.edit' && cur_root() != 'admin.engine'
        
        && cur_root() != 'admin.packages' && cur_root() != 'admin.saudis')

<div class="col-md-12 col-sm-12 col-xs-12">

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

<div class="clearfix"></div>


<div class="x_panel">
    <div class="x_title">
        <h2> @yield('title') </h2>
        <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                  
        </ul>
        <div class="clearfix"></div>
    </div>

    <div class="x_content">

        <div class="table-responsive">

            <div class="col-md-12">
                @include('dashboard.layouts.message')
            </div>

            @yield('content')

        </div>
    </div>
</div>
</div>

@else
    @yield('content')
@endif

</div>
<!-- /page content -->

<!-- footer content -->
<footer class="hidden-print">
<div class="pull-left">
    &copy;  @lang('site.all_copy_right_reserved') {{ config('app.name', 'AZParts') .' '. date('Y') }}  
</div>
<div class="clearfix"></div>
</footer>
<!-- /footer content -->
</div>
</div>
<div id="lock_screen">
<table>
<tr>
<td>
    <div class="clock"></div>
    <span class="unlock">
        <span class="fa-stack fa-5x">
            <i class="fa fa-square-o fa-stack-2x fa-inverse"></i>
            <i id="icon_lock" class="fa fa-lock fa-stack-1x fa-inverse"></i>
        </span>
    </span>
</td>
</tr>
</table>
</div>
<!-- jQuery -->
<script src="{{ dashboard('vendors/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ dashboard('vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- NProgress -->
<script src="{{ dashboard('vendors/nprogress/nprogress.js') }}"></script>

<!-- Custom Theme Scripts -->
<script src="{{ dashboard('build/js/custom.min.js') }}"></script>


@yield('popup')
@yield('scripts')

</body>
</html>
