@extends('dashboard.app')

@section('title') {{ __('site.all_orders') }} @endsection

@section('styles')
    
@endsection


@section('content')
<div class="col-md-12 col-sm-12 col-xs-12">
  
    
    <div class="x_panel">
         
        <div class="x_content">
    
            <div class="table-responsive">
                @include('dashboard.orders.filter')
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
     
        <div class="btn-group">
            
            @if(has_permission('users_add'))
                <a href="{{route('admin.user.add')}}" class="btn btn-warning"> 
                    <i class="fa fa-plus"></i>  @lang('site.add') </a> 
            @endif
    
            @if(has_permission('users_show'))
                <a href="{{route('export.excel.orders')}}" class="btn btn-success"> 
                    <i class="fa fa-download"></i>  @lang('site.excel') </a> 
            @endif
    
            @if(has_permission('users_show'))
                <a href="{{route('export.pdf.orders')}}" class="btn btn-info"> 
                    <i class="fa fa-file"></i>  @lang('site.pdf') </a> 
            @endif 
        </div>
    
    <br/> <br/>


<table class="table table-striped jambo_table bulk_action text-center" id="myTbl">
    <thead class="text-primary text-center">
        <tr>
            <th> # </th>
            <th> @lang('site.order_no') </th>
            <th> @lang('site.order_type') </th>
            <th> @lang('site.user') </th>
            <th> @lang('site.pieces_count') </th>
            <th> @lang('site.user_type') </th>
            <th> @lang('site.total') </th>
            <th> @lang('site.remaining_cost') </th>                         
            <th> @lang('site.payment_method') </th>
            <th> @lang('site.status') </th>            
            <th> @lang('site.date') </th>
            <th style="width: 100px;"></th>
      </tr>
      </thead>
      <tbody>
       @foreach($items as $k=>$item)
          <tr>
            <td> {{ $k+1 }} </td>

            <td> AZ-{{$item->id}}</td>
            
            <td> @if($item->type == 'manual') <i class="fa fa-pointer"></i>
                @else <i class="fa fa-cogs"></i> @endif  {{ __('site.'.$item->type) }} </td>

            <td>
                @if($item->user_type == 'seller') {{ $item->seller ? $item->seller->name : ''}}
                @elseif($item->user_type == 'broker') {{ $item->broker ? $item->broker->name : ''}}
                @elseif($item->user_type == 'company') {{ $item->company ? $item->company->name : ''}}
                @else {{ $item->user ? $item->user->name : ''}}
                @endif
            </td>
            
            <td> {{ count($item->cart) }} </td>
            
            <td>  {{ __('site.'.$item->user_type) }} </td>

            <td> {{ $item->total }} @lang('site.rs') </td>

            <td> {{ $item->remaining_cost }} @lang('site.rs') </td>

            <td> {{ __('site.'.$item->payment_method) }} </td>

            <td> <span class="btn status-{{ $item->order_status->id }}"> 
                {{ __($item->order_status['name_'.my_lang()]) }} </span> </td>
 
            <td> {{date('d-m-Y',strtotime($item->created_at))}} </td>

            <td>
                @if(has_permission('order_show'))
                    <a href="{{ route('admin.order',$item->id) }}" class="btn btn-success btn-xs">
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
  
    <div class="text-center">  {{ $items->links('vendor.pagination.bootstrap-4') }}  </div>
 
            </div>
        </div>
    </div>
</div>


@endsection

@section('popup')
 

@endsection

@section('scripts')
    
    @include('dashboard.ajax.delete',['target'=>'order']) 
     
@endsection
