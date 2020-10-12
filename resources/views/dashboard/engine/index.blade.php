@extends('dashboard.app')

@section('title') @lang('site.requests_engine') @endsection

@section('styles')
    
@endsection


@section('content')

<div class="page-title">
    <div class="title_left">
        <h3> @yield('title')  </h3>
    </div>
 
</div>
<div class="clearfix"></div>

<div class="row">
    <div class="col-md-3 col-xs-12">

        <div class="x_panel">
            <div class="x_title">
                <h2> @lang('site.run_and_stop_engine')  </h2>

                <ul class="nav navbar-right panel_toolbox">
                    <li> <a class="collapse-link"><i class="fa fa-chevron-up"></i></a> </li>              
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <p>
                <span class="text-success"><i class="fa fa-long-arrow-up"></i>
                    {{__('site.engine_status_now')}} : </span>
                {{ $engine_status->value == 1 ? __('site.active') : __('site.stop') }}
                </p> <br/>

                <p class="card-category">
                    <span class="text-success">  
                        @if($engine_status->value == 1)
                          <a href="{{route('engine.run')}}" class="btn btn-danger">{{__('site.stop')}}</a>
                        @else
                            <a href="{{route('engine.run')}}" class="btn btn-success">{{__('site.run')}}</a>
                        @endif
                    </span>
                  </p> <br/>

                 
                    <div class="stats">
                        <i class="fa fa-clock-o"></i> {{ $engine_status->updated_at }}
                    </div>
                

            </div>
        </div>

    </div>



    <div class="col-md-3 col-xs-12">

        <div class="x_panel">
            <div class="x_title">
                <h2> @lang('site.special_requests')  </h2>

                <ul class="nav navbar-right panel_toolbox">
                    <li> <a class="collapse-link"><i class="fa fa-chevron-up"></i></a> </li>              
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <p>
                    <span class="text-success"><i class="fa fa-long-arrow-up"></i> {{__('site.special_requests')}} </span>
                    ({{$vip_reqs ? count($vip_reqs) : 0}})
                </p> <br/>

                {{-- <p class="card-category">
                    <span class="text-success">                         
                        <a href="{{url('admin/engine/special/delete_all')}}" class="btn btn-danger">
                            <i class="fa fa-trash"></i> {{__('site.delete_all')}}</a>                        
                    </span>
                  </p>   --}}

            </div>
        </div>

    </div>



    <div class="col-md-3 col-xs-12">

        <div class="x_panel">
            <div class="x_title">
                <h2> @lang('site.normal_requests')  </h2>

                <ul class="nav navbar-right panel_toolbox">
                    <li> <a class="collapse-link"><i class="fa fa-chevron-up"></i></a> </li>              
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <p>
                    <span class="text-success"><i class="fa fa-long-arrow-up"></i> {{__('site.normal_requests')}} </span>
                    ({{$normal_requests ? count($normal_requests) : 0}})
                </p> <br/>

                <p class="card-category">
                    <span class="text-success">                         
                        <a href="{{url('admin/engine/normal/delete_all')}}">{{__('site.delete_all')}}</a>                     
                    </span>
                  </p>    

            </div>
        </div>

    </div>


    <div class="col-md-3 col-xs-12">

        <div class="x_panel">
            <div class="x_title">
                <h2> @lang('site.go_to_next_round')  </h2>

                <ul class="nav navbar-right panel_toolbox">
                    <li> <a class="collapse-link"><i class="fa fa-chevron-up"></i></a> </li>              
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
 
                <p class="card-category">
                    <span class="text-success">                         
                        <a href="{{route('engine.next_round')}}" class="btn btn-success">{{__('site.run')}}</a>                   
                    </span>
                  </p>    

            </div>
        </div>

    </div>




</div>


@endsection

@section('popup')
 

@endsection

@section('scripts')
    
@endsection
