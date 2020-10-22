@extends('dashboard.app')

@section('title') {{ $title ? $title : __('site.all_orders') }} @endsection

@section('styles')
    
@endsection


@section('content')
   

<table class="table table-striped jambo_table bulk_action" id="myTbl">
    <thead class=" text-primary">
        <tr>
          <th> @lang('site.order_no') </th>
          <th> @lang('site.user') </th>
          <th> @lang('site.user_type') </th>
          <th> @lang('site.total') </th>
          <th> @lang('site.status') </th>
          <th> @lang('site.pieces_count') </th>
          <th> @lang('site.date') </th>
          <th style="width: 100px;"></th>
      </tr>
      </thead>
      <tbody>
       @foreach($items as $k=>$item)
          <tr>
            <td> AZ-{{$item->id}}</td>
            
            <td>{{$item->user->name}}</td>
            
            <td>  {{ __('site.'.$item->user_type) }} </td>

            <td> {{ $item->total }} @lang('site.rs') </td>

            <td>  {{ __($item->order_status['name_'.my_lang()]) }} </td>

            <td> {{ count($item->cart) }} </td>
 
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
  
<div class="text-center"> {{ $items->links() }} </div>
 

@endsection

@section('popup')
 

@endsection

@section('scripts')
    
    @include('dashboard.ajax.delete',['target'=>'order']) 
 
@endsection
