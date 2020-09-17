@extends('dashboard.layouts.app')

@section('title') @lang('site.sellers_mediators') @endsection

@section('styles')
    
@endsection


@section('content')
  
    <div class="btn-group text-center">
        
        <a href="{{route('admin.user.add')}}" class="btn btn-warning"> 
            <i class="fa fa-plus"></i>  @lang('site.add') </a> 
    
        <a href="{{route('export.excel.sellers')}}" class="btn btn-success"> 
            <i class="fa fa-download"></i>  @lang('site.excel') </a> 
    
        <a href="{{route('export.pdf.sellers')}}" class="btn btn-info"> 
            <i class="fa     fa-file"></i>  @lang('site.pdf') </a> 
         
    </div>

<br/> <br/>

<table class="table table-striped jambo_table bulk_action" id="myTbl">
    <thead>
    <tr class="headings">
        <th>#  </th>
        <th> @lang('site.user_id')</th>
        <th> @lang('site.name')   </th>
        <th> @lang('site.user_role')  </th>
        <th> @lang('site.seller_brands') </th>
        <th> @lang('site.rule') </th>        
        <th> @lang('site.vip') </th>
        <th> @lang('site.active') </th>
        <th> @lang('site.saudi') </th>
        <th> @lang('site.registered_date') </th>
        <th style="width:120px;"></th>
    </tr>
    </thead>

    <tbody>
        
        @foreach($items as $k=>$item)

        <tr class="even pointer">
          
            <td>{{ $k+1 }}</td>

            <td>user#{{$item->id}}</td>
            
            <td>{{$item->name}}</td>
            
            <td><span class="label label-{{$item->user_role}}"> {{ __('site.'.$item->user_role) }}</span></td>
            
            <td> <a href="{{route('export.pdf.sellers_brands',$item->id)}}"> @lang('site.download') </a> </td>

            <td>{{ $item->rule ? $item->rule->name : '-' }}</td>
 

            <td>
                @if($item->vip ==1) <button class="btn btn-success btn-xs">
                         <i class="fa fa-check"></i> @lang('site.yes') </button>
                @else
                    <button class="btn btn-warning btn-xs">
                    <i class="fa fa-close"></i> @lang('site.no') </button>
                @endif 
            </td>

            <td>
                @if($item->active ==1) <button class="btn btn-success btn-xs">
                    <i class="fa fa-check"></i> @lang('site.yes') </button>
                @else
                    <button class="btn btn-warning btn-xs">
                    <i class="fa fa-close"></i> @lang('site.no') </button>
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

            <td> {{ $item->created_at }} </td>
    
            <td>
                <a class="whatsapp btn btn-success btn-xs" target="_blank" href="https://wa.me/966{{$item->mobile}}?text=
                {{ \App\Models\Setting::getvalue('whatsapp_msg') }}">
                <i class="fa fa-whatsapp"></i>
                </a>

                <a href="{{ route('admin.user.edit',$item->id) }}" class="btn btn-info btn-xs"> <i class="fa fa-edit"></i> </a>

                <a onclick="deleteItem({{ $item->id }})" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> </a>
            </td>
        </tr>
           
        @endforeach
        
    </tbody>
</table>

<div class="text-center"> {{ $items->links() }} </div>
 

@endsection



@section('scripts')
    @include('dashboard.layouts.message') 

    @include('dashboard.ajax.delete',['target'=>'user']) 
   
@endsection
