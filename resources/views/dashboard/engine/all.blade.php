@extends('dashboard.app')

@section('title') {{ __('site.electronic_engine') }} @endsection

@section('styles')
    
@endsection


@section('content')
<div class="col-md-12 col-sm-12 col-xs-12">
   
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
     
        <div class="btn-group">
            
            @if(has_permission('users_add'))
                <a href="{{route('admin.user.add')}}" class="btn btn-warning"> 
                    <i class="fa fa-plus"></i>  @lang('site.add') </a> 
            @endif
    
            @if(has_permission('users_show'))
                <a href="{{route('export.excel.users')}}" class="btn btn-success"> 
                    <i class="fa fa-download"></i>  @lang('site.excel') </a> 
            @endif
    
            @if(has_permission('users_show'))
                <a href="{{route('export.pdf.users')}}" class="btn btn-info"> 
                    <i class="fa fa-file"></i>  @lang('site.pdf') </a> 
            @endif 
        </div>
    
    <br/> <br/>


<table class="table table-striped jambo_table bulk_action text-center" id="myTbl">
    <thead class="text-primary text-center">
        <tr>
            <th> # </th>            
            <th> @lang('site.request_no') </th>            
            <th> @lang('site.user') </th>
            <th> @lang('site.user_type') </th>             
            <th> @lang('site.piece_name') </th>            
            <th> @lang('site.qty') </th> 
            <th> @lang('site.status') </th> 
            <th> @lang('site.offers') </th> 
            <th> @lang('site.engine') </th>            
            <th> @lang('site.date') </th>
            <th style="width: 100px;"></th>
      </tr>
      </thead>
      <tbody>
       @foreach($items as $k=>$item)
          <tr>
            <td> {{ $k+1 }} </td>            
            
            <td> ER-{{$item->id}}</td>
           
            
            <td> {{ $item->user ? $item->user->name : '' }} </td>
            
            <td>  {{ __('site.'.$item->user_type) }} </td>

            <td> {{ $item->piece_alt ? $item->piece_alt['name_'.my_lang()] : ''}} </td>

            <td> {{ $item->qty }} </td>
 
            <td> <span class="btn status-{{ $item->status_id }}">
                     {{ $item->order_status['name_'.my_lang()] }} </span> </td>

            <td> {{ offers_count($item->id) }} </td>

            <td> <a href="{{ route('admin.order.engine',$item->id) }}" target="_blank">
                 <i class="fa fa-cogs"></i> @lang('site.view') </a> </td>

            <td> {{date('d-m-Y',strtotime($item->created_at))}} </td>

            <td>
                @if(has_permission('order_show'))
                    <a href="{{ route('admin.elec_order',$item->id) }}" class="btn btn-success btn-xs">
                        <i class="fa fa-eye"></i> </a>
                @endif

                @if(has_permission('order_delete'))
                    <a onclick="deleteItem({{ $item->id }})" class="btn btn-danger btn-xs">
                        <i class="fa fa-trash"></i> </a>
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
 

@endsection

@section('scripts')
    
    @include('dashboard.ajax.delete',['target'=>'electronic']) 
 
@endsection
