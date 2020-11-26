@extends('dashboard.app')

@section('title') @lang('site.db_engine') @endsection

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


<div class="col-md-4 col-sm-6 col-xs-12 widget_tally_box">
    <div class="x_panel">
        <div class="x_title">
            <h2> {{ __("site.go_to_next_round") }}  </h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
            </ul>
            <div class="clearfix"></div>
        </div>

        <div class="x_content">

            <article class="media event">
                <a class="pull-left date date2" onclick="next_round()" href="javascript:void();">
                    <p class="day"> @lang('site.run')  </p>
                </a>
                <div class="media-body">
                    <small> @lang('site.move_engine_to_next_round') </small>
                </div>
            </article>

        </div>
    </div>

    <div class="x_panel">
        <div class="x_title">
            <h2> {{ __("site.add_sellers_cars") }}  </h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
            </ul>
            <div class="clearfix"></div>
        </div>

        <div class="x_content">

            <article class="media event">
                <a class="pull-left date date2" data-toggle="modal" data-target=".add_item">
                    <p class="day"> @lang('site.upload')  </p>
                </a>


                <div class="media-body">
                    <small> @lang('site.add_sellers_cars') </small>
                </div>
            </article>

        </div>
    </div>
    
</div>

<div class="row">
    <div class="col-md-7">
        <div class="x_panel">
            <div class="x_title">
                <h2> @lang('site.empty_tables') </h2>

                <ul class="nav navbar-right panel_toolbox">
                    <li> <a class="collapse-link"><i class="fa fa-chevron-up"></i></a> </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                    <article class="media event">
                        <a class="pull-left date date2" onclick="empty_tables()" href="javascript:void();">
                            <p class="day"> @lang('site.empty_now')  </p>
                        </a>
                        <div class="media-body">
                            <p>
                                <small> @lang('site.empty_this_tables')
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
                    </article>


            </div>
        </div>
    </div>

</div>

 
</div>



@endsection
@include('dashboard.db_engine.upload_sellers')
@section('popup')


@endsection

@section('scripts')

    @include('dashboard.ajax.empty_tables')
    @include('dashboard.ajax.next_round')

@endsection
