@extends('dashboard.layouts.app')

@section('title') @lang('site.brokers') @endsection

@section('styles')
    
@endsection


@section('content')
  
    <div class="btn-group">
        
        @if(has_permission('brokers_add'))
            <a href="{{route('admin.broker.add')}}" class="btn btn-warning"> 
                <i class="fa fa-plus"></i>  @lang('site.add') </a> 
        @endif

        @if(has_permission('brokers_show'))
            <a href="{{route('export.excel.users')}}" class="btn btn-success"> 
                <i class="fa fa-download"></i>  @lang('site.excel') </a> 
        @endif

        @if(has_permission('brokers_show'))
            <a href="{{route('export.pdf.users')}}" class="btn btn-info"> 
                <i class="fa fa-file"></i>  @lang('site.pdf') </a> 
        @endif
    </div>

<br/> <br/>

<table class="table table-striped jambo_table bulk_action">
    <thead>
    <tr class="headings">
        <th>#  </th>
        <th> @lang('site.user_id')</th>
        <th> <i class="fa fa-camera"> </i> </th>
        <th> @lang('site.name')   </th>        
        <th> @lang('site.total_requests')  </th>                
        <th> @lang('site.vip') </th>
        <th> @lang('site.active') </th>
        <th> @lang('site.saudi') </th>
        <th> @lang('site.available_requests') </th>
        <th style="width:120px;"></th>
    </tr>
    </thead>

    <tbody>
        
        @foreach($items as $k=>$item)

        <tr class="even pointer">
          
            <td>{{ $k+1 }}</td>

            <td>user#{{$item->id}}</td>
            
            <td> @if($item->photo) <img src="{{ img_path($item->photo) }}" class="img-tbl" /> 
                    @else  <img src="{{ dashboard('build/images/user.png') }}" class="img-tbl" />  @endif
            </td>

            <td>{{$item->name}}</td>
             
            <td> {{ $item->total_requests }} @lang('site.request') </td>
 
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
          
            <td> {{ $item->available_requests }} </td>
    
            <td>
                <a class="whatsapp btn btn-success btn-xs" target="_blank" href="https://wa.me/966{{$item->mobile}}?text=
                    {{ setting('whatsapp_msg') }}"> <i class="fa fa-whatsapp"></i>
                </a>

                @if(has_permission('brokers_edit'))
                    <a href="{{ url('admin/broker',$item->id) }}" class="btn btn-info btn-xs"> <i class="fa fa-edit"></i> </a>
                @endif

                @if(has_permission('brokers_delete'))
                    <a onclick="deleteItem({{ $item->id }})" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> </a>
                @endif
            </td>
        </tr>
           
        @endforeach
        
    </tbody>
</table>

<div class="text-center"> {{ $items->links() }} </div>
 

@endsection



@section('scripts')
    @include('dashboard.layouts.message_growl') 

    @include('dashboard.ajax.delete',['target'=>'broker']) 
 
@endsection
