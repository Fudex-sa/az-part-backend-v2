@extends('dashboard.app')

@section('title') @lang('site.payment_methods') @endsection

@section('styles')
    
@endsection


@section('content')
  
<div class="btn-group">
     
    @if(has_permission('payment_methods_add'))
        <a class="btn btn-warning" data-toggle="modal" data-target=".add_item"> 
                <i class="fa fa-plus"></i>  @lang('site.add') </a> 
    @endif

</div>

<br/> <br/>

<table class="table table-striped jambo_table bulk_action text-center" id="myTbl">
    <thead class=" text-primary">
        <tr>
          <th>#  </th>
            
          <th> <i class="fa fa-camera"></i> </th>

          <th> @lang('site.name_'.my_lang()) </th>

          <th> @lang('site.sort') </th>

          <th> @lang('site.deposit') </th>

          <th> @lang('site.active') </th>
          
          <th style="width: 100px;"></th>
      </tr>
      </thead>
      <tbody>
       @foreach($items as $k=>$item)
          <tr>
            <td>{{$item->id}}</td>
            
            <td> <img src="{{ img_path($item->logo) }}" class="img-user"/> </td>

            <td>{{$item['name_'.my_lang()]}}</td>
            
            <td> {{ $item->sort }} </td>

            <td> {{ $item->deposit ? $item->deposit . ' % ' : '' }}  </td>

            <td>
                @if($item->active ==1) <button class="btn btn-success btn-xs" onclick="activate({{ $item->id }})">
                    <i class="fa fa-check"></i> @lang('site.de_activate') </button>
                @else
                    <button class="btn btn-warning btn-xs" onclick="activate({{ $item->id }})">
                    <i class="fa fa-close"></i> @lang('site.activate') </button>
                @endif      
            </td>

            <td>
                @if(has_permission('payment_methods_edit'))
                    <a href="{{ route('admin.payment_method',$item->id) }}" class="btn btn-info btn-xs">
                        <i class="fa fa-edit"></i> </a>
                @endif

                @if(has_permission('payment_methods_delete'))
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

    @include('dashboard.payment_methods.create')

@endsection

@section('scripts')
    
    @include('dashboard.ajax.delete',['target'=>'payment_method']) 

    @include('dashboard.ajax.activate',['target'=>'payment_method']) 
  
@endsection
