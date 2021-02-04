@extends('dashboard.app')

@section('title') @lang('site.slider') @endsection

@section('styles')
    
@endsection


@section('content')
  
<div class="btn-group">
     
    @if(has_permission('sliders_add'))
        <a class="btn btn-warning" data-toggle="modal" data-target=".add_item"> 
                <i class="fa fa-plus"></i>  @lang('site.add') </a> 
    @endif

</div>

<br/> <br/>

<table class="table table-striped jambo_table bulk_action" id="myTbl">
    <thead class=" text-primary">
        <tr>
            <th scope="col">#  </th>
            <th scope="col">  @lang('site.image') </th>
            <th scope="col"> @lang('site.title') </th>
            <th scope="col"> @lang('site.active') </th>
            <th scope="col"> @lang('site.sort') </th>
            <th scope="col"></th>
      </tr>
      </thead>
      <tbody>
        @foreach($items as $k=>$item)
            <tr>
                <td>{{$k+1}}</td>

                <td><img src="{{asset('uploads/'.$item->img)}}" class="img-tbl"></td>
                
                <td>{{$item['title_'.my_lang()]}}</td>    
                
                <td>                
                    @if($item->active ==1) <button class="btn btn-success btn-xs" onclick="activate({{ $item->id }})">
                        <i class="fa fa-check"></i> @lang('site.de_activate') </button>
                    @else
                        <button class="btn btn-warning btn-xs" onclick="activate({{ $item->id }})">
                        <i class="fa fa-close"></i> @lang('site.activate') </button>
                    @endif                     
                </td>

                <td> {{ $item->sort }} </td>
                
                <td>
                    @if(has_permission('sliders_edit'))
                        <a href="{{ route('admin.slider',$item->id) }}" class="btn btn-info btn-xs">
                            <i class="fa fa-edit"></i> </a>
                    @endif

                    @if(has_permission('sliders_delete'))
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

    @include('dashboard.sliders.create')

@endsection

@section('scripts')
    
    @include('dashboard.ajax.delete',['target'=>'slider'])

    @include('dashboard.ajax.activate',['target'=>'slider'])  
  
@endsection
