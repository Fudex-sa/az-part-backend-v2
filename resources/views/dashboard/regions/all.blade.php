@extends('dashboard.app')

@section('title') @lang('site.regions') | {{ $item['name_'.my_lang()] }} @endsection

@section('styles')
    
@endsection


@section('content')
  
<div class="btn-group">
     
    @if(has_permission('regions_add'))
        <a class="btn btn-warning" data-toggle="modal" data-target=".add_item"> 
                <i class="fa fa-plus"></i>  @lang('site.add') </a> 
    @endif

</div>

<br/> <br/>

<table class="table table-striped jambo_table bulk_action" id="myTbl">
    <thead class=" text-primary">
        <tr>
          <th>#  </th>

          <th> @lang('site.name_'.my_lang()) </th>

          <th> @lang('site.cities') </th>

          <th> @lang('site.active') </th>
          
          <th style="width: 100px;"></th>
      </tr>
      </thead>
      <tbody>
       @foreach($items as $k=>$row)
          <tr>
            <td>{{$row->id}}</td>
            
            <td>{{$row['name_'.my_lang()]}}</td>
            
            <td> <a href="{{ route('admin.cities',$row->id) }}">
                     @lang('site.view') ({{ count($row->cities) }}) </a> </td>

            <td>
                @if($row->active ==1) <button class="btn btn-success btn-xs" onclick="activate({{ $row->id }})">
                    <i class="fa fa-check"></i> @lang('site.de_activate') </button>
                @else
                    <button class="btn btn-warning btn-xs" onclick="activate({{ $row->id }})">
                    <i class="fa fa-close"></i> @lang('site.activate') </button>
                @endif      
            </td>

            <td>
                @if(has_permission('regions_edit'))
                    <a href="{{ route('admin.region',$row->id) }}" class="btn btn-info btn-xs">
                        <i class="fa fa-edit"></i> </a>
                @endif

                @if(has_permission('regions_delete'))
                    <a onclick="deleteItem({{ $row->id }})" class="btn btn-danger btn-xs">
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

    @include('dashboard.regions.create')

@endsection

@section('scripts')
    
    @include('dashboard.ajax.delete',['target'=>'region']) 

    @include('dashboard.ajax.activate',['target'=>'region']) 
  
@endsection
