@extends('dashboard.app')

@section('title') @lang('site.coupons') @endsection

@section('styles')
    
@endsection


@section('content')
  
<div class="btn-group">
     
    @if(has_permission('coupons_add'))
        <a class="btn btn-warning" data-toggle="modal" data-target=".add_item"> 
                <i class="fa fa-plus"></i>  @lang('site.add') </a> 
    @endif

</div>

<br/> <br/>

<table class="table table-striped jambo_table bulk_action text-center" id="myTbl">
    <thead class=" text-primary">
        <tr>
          <th>#  </th>

          <th> @lang('site.code') </th>
          <th> @lang('site.value') </th>
          <th> @lang('site.uses_number') </th>
          <th> @lang('site.expiration_date') </th>
          <th> @lang('site.active') </th>
          <th> @lang('site.users_used_time') </th>
          <th style="width: 100px;"></th>
      </tr>
      </thead>
      <tbody>
       @foreach($items as $k=>$item)
          <tr>
            <td>{{$item->id}}</td>
            
            <td>{{$item->code}}</td>
            
            <td>{{$item['value']}} % </td>             

            <td>{{$item->uses_number}}</td>

            <td>{{$item->expiration_date ? $item->expiration_date : '-' }}</td>

            <td>{{$item->active == 1 ? __('site.yes') : __('site.no') }}</td>

            <td> {{ coupon_used_times($item->id) }} </td>

            <td>
                @if(has_permission('coupons_edit'))
                    <a href="{{ route('admin.coupon',$item->id) }}" class="btn btn-info btn-xs">
                        <i class="fa fa-edit"></i> </a>
                @endif

                @if(has_permission('coupons_delete'))
                    <a onclick="deleteItem({{ $item->id }})" class="btn btn-danger btn-xs">
                        <i class="fa fa-trash"></i> </a>
                @endif
            </td>
          </tr>
      @endforeach
         
      </tbody>

    </table>
  
    <div class="text-center">  {{ $items->links('vendor.pagination.bootstrap-4') }}  </div>
 

@endsection

@section('popup')

    @include('dashboard.coupons.create')

@endsection

@section('scripts')
    
    @include('dashboard.ajax.delete',['target'=>'coupon']) 
  
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script>
        $( function() {
            $( ".datepicker" ).datepicker();
        } );
    </script>
@endsection
