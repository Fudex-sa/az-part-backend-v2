@extends('dashboard.app')

@section('title') @lang('site.sellers') @endsection

@section('styles')

@endsection


@section('content')

<div class="col-md-12 col-sm-12 col-xs-12">


    <div class="x_panel">

        <div class="x_content">

            <div class="table-responsive">

                @include('dashboard.sellers.filter')

            </div>
        </div>
    </div>



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

    <div class="row">
        <div class="col-md-10 btn-group">
            @if(has_permission('sellers_show'))
                <a href="{{route('export.excel.users')}}" class="btn btn-info">
                    <i class="fa fa-download"></i>  @lang('site.excel') 
                </a>
            @endif

            @if(has_permission('sellers_show'))
                <a href="{{route('export.pdf.users')}}" class="btn btn-info">
                    <i class="fa fa-file"></i>  @lang('site.pdf') 
                </a>
            @endif

            @if(has_permission('sellers_show'))
                <a class="btn btn-success" data-toggle="modal" data-target=".add_item">                     
                    <span class="glyphicon glyphicon-export" aria-hidden="true"></span>                                        
                    @lang('site.import') 
                </a>
            @endif
        </div>

        <div class="col-md-2 text-left">
            @if(has_permission('sellers_add'))
                <a href="{{route('admin.seller.add')}}" class="btn btn-warning">
                    <i class="fa fa-plus"></i>  @lang('site.add') 
                </a>
            @endif
        </div>
 
    </div>

<br/> <br/>

<table class="table table-striped jambo_table bulk_action text-center">
    <thead class="th-center">
    <tr>
        <th>#  </th>
        {{-- <th> @lang('site.user_id')</th> --}}
        <th> <i class="fa fa-camera"> </i> </th>
        <th> @lang('site.name')   </th>
        <th> @lang('site.city') </th>
        <th> @lang('site.user_type') </th>

        <th> @lang('site.vip') </th>
        <th> @lang('site.active') </th>
        <th> @lang('site.saudi') </th>
        <th> @lang('site.orders_count')  </th>
        <th> @lang('site.available_orders') </th>
        <th> @lang('site.tashlih_region') </th>
        <th style="width:120px;"></th>
    </tr>
    </thead>

    <tbody>

        @foreach($items as $k=>$item)

        <tr class="even pointer">

            <td>{{ $k+1 }}</td>

            {{-- <td>user#{{$item->id}}</td> --}}

            <td> @if($item->photo) <img src="{{ img_path($item->photo) }}" class="img-user" />
                    @else  <img src="{{ dashboard('build/images/user.png') }}" class="img-user" />  @endif
            </td>

            <td>{{$item->name}}</td>

            <td> {{ $item->city ? $item->city['name_'.my_lang()] : '-' }} </td>

            <td> <span class="label label-{{ $item->user_type }}"> @lang('site.'.$item->user_type) </span> </td>

            <td>
                @if($item->vip ==1) <button class="btn btn-success btn-xs">
                         <i class="fa fa-check"></i>  </button>
                @else
                    <button class="btn btn-warning btn-xs">
                    <i class="fa fa-close"></i>   </button>
                @endif
            </td>

            <td>
                @if($item->active ==1) <button class="btn btn-success btn-xs" onclick="activate({{ $item->id }})">
                    <i class="fa fa-check"></i> @lang('site.de_activate') </button>
                @else
                    <button class="btn btn-warning btn-xs" onclick="activate({{ $item->id }})">
                    <i class="fa fa-close"></i> @lang('site.activate') </button>
                @endif
            </td>


            <td>
                @if($item->saudi ==1) <button class="btn btn-success btn-xs">
                    <i class="fa fa-check"></i>  </button>
                @else
                    <button class="btn btn-warning btn-xs">
                    <i class="fa fa-close"></i>   </button>
                @endif
            </td>

            <td> {{ count(my_orders($item->id,'user')) }} @lang('site.request') </td>

            <td> {{ $item->available_orders }} @lang('site.request') </td>

            <td> {{ $item->tashlih_region ? $item->tashlih['name_'.my_lang()] : '' }} </td>

            <td>
                <a class="whatsapp btn btn-success btn-xs" target="_blank" href="https://wa.me/966{{$item->mobile}}?text=
                    {{ setting('whatsapp_msg') }}"> <i class="fa fa-whatsapp"></i>
                </a>

                @if(has_permission('sellers_edit'))
                    <a href="{{ url('admin/seller',$item->id) }}" class="btn btn-info btn-xs"> <i class="fa fa-edit"></i> </a>
                @endif

                @if(has_permission('sellers_delete'))
                    <a onclick="deleteItem({{ $item->id }})" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> </a>
                @endif
            </td>
        </tr>

        @endforeach

    </tbody>
</table>

<div class="text-center"> {{ $items->links() }} </div>


        </div>
    </div>
</div>
</div>

@endsection


@section('popup')

    @include('dashboard.sellers.upload_sellers')

@endsection


@section('scripts')

    @include('dashboard.ajax.delete',['target'=>'seller'])

    @include('dashboard.ajax.activate',['target'=>'seller'])

    @include('dashboard.ajax.load_regions')
    @include('dashboard.ajax.load_cities')

@endsection
