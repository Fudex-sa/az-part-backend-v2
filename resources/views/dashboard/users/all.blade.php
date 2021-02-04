@extends('dashboard.app')

@section('title') @lang('site.users') @endsection

@section('styles')

@endsection


@section('content')

<div class="col-md-12 col-sm-12 col-xs-12">


    <div class="x_panel">

        <div class="x_content">

            <div class="table-responsive">
                @include('dashboard.users.filter')
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
                    @if(has_permission('users_show'))
                        <a href="{{route('export.excel.users')}}" class="btn btn-info">
                            <i class="fa fa-download"></i>  @lang('site.excel') </a>
                    @endif

                    @if(has_permission('users_show'))
                        <a href="{{route('export.pdf.users')}}" class="btn btn-info">
                            <i class="fa fa-file"></i>  @lang('site.pdf') </a>
                    @endif
        
                    @if(has_permission('users_show'))
                        <a class="btn btn-success" data-toggle="modal" data-target=".add_item">                     
                            <span class="glyphicon glyphicon-export" aria-hidden="true"></span>                                        
                            @lang('site.import') 
                        </a>
                    @endif
                </div>
        
                <div class="col-md-2 text-left">
                    @if(has_permission('users_add'))
                        <a href="{{route('admin.user.add')}}" class="btn btn-warning">
                            <i class="fa fa-plus"></i>  @lang('site.add') </a>
                    @endif
                </div>
         
            </div>
             

<br/> <br/>

<table class="table table-striped jambo_table bulk_action text-center" id="myTbl">
    <thead>
    <tr class="headings">
        <th>#  </th>
        <th> @lang('site.user_id')</th>
        <th> @lang('site.name')   </th>
        <th> @lang('site.city')  </th>
        <th> @lang('site.vip') </th>
        <th> @lang('site.active') </th>
        <th> @lang('site.saudi') </th>
        <th> @lang('site.orders_count')  </th>
        <th> @lang('site.available_orders') </th>
        <th style="width:120px;"></th>
    </tr>
    </thead>

    <tbody>

        @foreach($items as $k=>$item)

        <tr class="even pointer">

            <td>{{ $k+1 }}</td>

            <td>user#{{$item->id}}</td>

            <td>{{$item->name}}</td>

            <td> {{ $item->city ? $item->city['name_'.my_lang()] : '-' }} </td>

            <td>
                @if($item->vip ==1) <button class="btn btn-success btn-xs">
                         <i class="fa fa-check"></i> @lang('site.yes') </button>
                @else
                    <button class="btn btn-warning btn-xs">
                    <i class="fa fa-close"></i> @lang('site.no') </button>
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
                    <i class="fa fa-check"></i> @lang('site.yes') </button>
                @else
                    <button class="btn btn-warning btn-xs">
                    <i class="fa fa-close"></i> @lang('site.no') </button>
                @endif
            </td>

            <td> {{ count(my_orders($item->id,'user')) }} @lang('site.request') </td>

            <td> {{ $item->available_orders }} @lang('site.request') </td>

            <td>
                <a class="whatsapp btn btn-success btn-xs" target="_blank" href="https://wa.me/966{{$item->mobile}}?text=
                    {{ setting('whatsapp_msg') }}"> <i class="fa fa-whatsapp"></i>
                </a>

                @if(has_permission('users_edit'))
                    <a href="{{ url('admin/user',$item->id) }}" class="btn btn-info btn-xs"> <i class="fa fa-edit"></i> </a>
                @endif

                @if(has_permission('users_delete'))
                    <a onclick="deleteItem({{ $item->id }})" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> </a>
                @endif
            </td>
        </tr>

        @endforeach

    </tbody>
</table>

        </div>

    </div>

    <div class="text-center">  {{ $items->links('vendor.pagination.bootstrap-4') }}  </div>


</div>

</div>

@endsection

@section('popup')

    @include('dashboard.users.upload_users')

@endsection


@section('scripts')

    @include('dashboard.ajax.delete',['target'=>'user'])
    @include('dashboard.ajax.activate',['target'=>'user'])

    @include('dashboard.ajax.load_regions')
    @include('dashboard.ajax.load_cities')


@endsection
