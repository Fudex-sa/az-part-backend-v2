@extends('dashboard.app')

@section('title') @lang('site.categories') @endsection

@section('styles')
    
@endsection


@section('content')
  
<div class="btn-group">
     
    @if(has_permission('category_add'))
        <a class="btn btn-warning" data-toggle="modal" data-target=".add_item"> 
                <i class="fa fa-plus"></i>  @lang('site.add') </a> 
    @endif 
</div>

<br/> <br/>

<table class="table table-striped jambo_table bulk_action text-center" id="myTbl">
    <thead class=" text-primary">
        <tr>
            <th>#  </th>
            <th> @lang('site.name') </th>
            <th> @lang('site.active') </th>            
            <th></th>
      </tr>
      </thead>
      <tbody>
       @foreach($items as $k=>$item)
          <tr>
            <td>{{$item->id}}</td>
            <td> {{ $item['name_'.my_lang()] }} </td> 
            <td>                
                @if($item->active ==1) <button class="btn btn-success btn-xs" onclick="activate({{ $item->id }})">
                    <i class="fa fa-check"></i> @lang('site.de_activate') </button>
                @else
                    <button class="btn btn-warning btn-xs" onclick="activate({{ $item->id }})">
                    <i class="fa fa-close"></i> @lang('site.activate') </button>
                @endif                     
            </td>
 
            <td>
                @if(has_permission('category_edit'))
                    <a href="{{ route('admin.category',$item->id) }}" class="btn btn-info btn-xs">
                        <i class="fa fa-edit"></i> </a>
                @endif

                @if(has_permission('category_delete'))
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

    @include('dashboard.categories.create')

@endsection

@section('scripts')
   
    @include('dashboard.ajax.delete',['target'=>'category']) 
    @include('dashboard.ajax.activate',['target'=>'category']) 
  
@endsection
