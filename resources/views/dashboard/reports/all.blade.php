@extends('dashboard.app')

@section('title') @lang('site.orders_reports') @endsection

@section('styles')
    
@endsection


@section('content')
   

<table class="table table-striped jambo_table bulk_action text-center" id="myTbl">
    <thead class="text-primary">
        <tr>
          <th> #  </th>
          <th> @lang('site.user') </th>
          <th> @lang('site.seller') </th>
          <th> @lang('site.user_type') </th>
          <th> @lang('site.complain') </th>
          <th> @lang('site.created_at') </th>
          
          <th style="width: 100px;"></th>
      </tr>
      </thead>
      <tbody>
       @foreach($items as $k=>$item)
          <tr>
            <td>{{$item->id}}</td>
            
            <td>{{$item->user->name}}</td>
            
            <td>{{$item->seller->name }}</td>             

            <td> {{ __('site.'.$item->user_type) }} </td>

            <td>{{$item->complain ? $item->complain['name_'.my_lang()] : $item->comment }}</td>   

            <td> {{ date('Y-m-d',strtotime($item->created_at)) }} </td>

            <td>
               
                @if(has_permission('reports_delete'))
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
 
@endsection

@section('scripts')
    
    @include('dashboard.ajax.delete',['target'=>'report']) 
  
@endsection
