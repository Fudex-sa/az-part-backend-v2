@extends('dashboard.layouts.app')

@section('title') @lang('site.dashboard') @endsection

@section('styles')
     

@endsection


@section('content')
 
<div class="">

    <div class="page-title">
        
    
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
 
<div class="row top_tiles">
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
            <div class="icon"><i class="fa fa-caret-square-o-right"></i></div>
            <div class="count"> {{ isset($open_requests) ? $open_requests : '0' }}  </div>
            <h3> @lang('site.open_requests') </h3>
            
        </div>
    </div>
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
            <div class="icon"><i class="fa fa-check-square-o"></i></div>
            <div class="count">  {{ isset($closed_requests) ? $closed_requests : '0'  }}  </div>
            <h3> @lang('site.closed_requests') </h3>
        </div>
    </div>
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
            <div class="icon"><i class="fa fa-sort-amount-desc"></i></div>
            <div class="count"> {{ isset($damaged_cars) ? $damaged_cars : '0' }}  </div>
            <h3> @lang('site.damaged_cars') </h3>
        </div>
    </div>
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
            <div class="icon"><i class="fa fa-car"></i></div>
            <div class="count">  {{ isset($antique_cars) ? $antique_cars : '0' }}  </div>
            <h3> @lang('site.antique_cars') </h3>

        </div>
    </div>
</div>

<hr/>

<div class="col-md-8 col-sm-6 col-xs-12 widget_tally_box">
    <div class="x_panel">
        <div class="x_title">
            <h2>   </h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                    
            </ul>
            <div class="clearfix"></div>
        </div>

        <div class="x_content">

            <canvas id="myChart"></canvas>
            
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="x_panel">
            <div class="x_title">
                <h2> @lang('site.latest_registeration')                    
                </h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li> <a class="collapse-link"><i class="fa fa-chevron-up"></i></a> </li>                    
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                @foreach ($users as $user)
                    <article class="media event">
                        <a class="pull-left date">
                            <p class="month"> {{ date('M', strtotime($user->created_at)) }} </p>
                            <p class="day">{{ date('d', strtotime($user->created_at)) }}</p>
                        </a>
                        <div class="media-body">
                            <a class="title" href="#"> {{ $user->name }} </a>
                            <p> {{ __('site.'.$user->user_role) }} </p>
                        </div>
                    </article>    
                @endforeach
                  
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="x_panel">
            <div class="x_title">
                <h2> @lang('site.latest_requests')                    
                </h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li> <a class="collapse-link"><i class="fa fa-chevron-up"></i></a> </li>                    
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                @foreach ($requests as $req)
                    <article class="media event">
                        <a class="pull-left date">
                            <p class="month"> {{ date('M', strtotime($req->created_at)) }} </p>
                            <p class="day">{{ date('d', strtotime($req->created_at)) }}</p>
                        </a>
                        <div class="media-body">
                            <a class="title" href="#"> 
                                {{ $req->brand ? $req->brand['name'] : '' }} - 
                                {{ $req->model ? $req->model['name'] : '' }} - 
                                {{ $req->year }}
                            </a>
                            <p> {{ __('site.'.$req->request_type) }} </p>
                        </div>
                    </article>    
                @endforeach
                  
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="x_panel">
            <div class="x_title">
                <h2> @lang('site.latest_cars')                    
                </h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li> <a class="collapse-link"><i class="fa fa-chevron-up"></i></a> </li>                    
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                @foreach ($cars as $car)
                    <article class="media event">
                        <a class="pull-left date">
                            <p class="month"> {{ date('M', strtotime($car->created_at)) }} </p>
                            <p class="day">{{ date('d', strtotime($car->created_at)) }}</p>
                        </a>
                        <div class="media-body">
                            <a class="title" href="#">                                 
                                {{ $car->title }}
                            </a>
                            <p> 
                                {{ $car->brand ? $car->brand['name'] : '' }} 
                                {{ $car->model ? $car->model['name'] : '' }}
                                {{ $car->year }}
                            </p>
                        </div>
                    </article>    
                @endforeach
                  
            </div>
        </div>
    </div>

</div>

</div>
  
 
@endsection



@section('scripts')
    @include('dashboard.layouts.message') 
   
    @include('dashboard.charts.supervisors_by_month')

@endsection




