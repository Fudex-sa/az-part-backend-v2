@extends('dashboard.layouts.app')

@section('title') @lang('site.site_settings') @endsection

@section('styles')
    
@endsection


@section('content')
  
<div class="btn-group">
     
    <a class="btn btn-warning" data-toggle="modal" data-target=".add_item"> 
            <i class="fa fa-plus"></i>  @lang('site.add') </a> 
     
</div>

<br/> <br/>

<table class="table table-striped jambo_table bulk_action" id="myTbl">
    <thead class=" text-primary">
        <tr>
          <th>#  </th>
          <th>{{ __('site.name') }}  </th>
          <th>{{ __('site.setting') }}  </th>
          <th>{{ __('site.value') }}</th>
          <th style="width: 100px;"></th>
      </tr>
      </thead>
      <tbody>
       @foreach($items as $k=>$item)
          <tr>
            <td>{{$item->id}}</td>
            
            <td>{{$item->name}}</td>
            
            <td>{{$item->keyword}}</td>
            
            <td>{{$item->value}}</td>

            <td>
                <a href="{{ route('admin.setting.edit',$item->id) }}" class="btn btn-info btn-xs">
                    <i class="fa fa-edit"></i> </a>

                <a onclick="deleteItem({{ $item->id }})" class="btn btn-danger btn-xs">
                    <i class="fa fa-trash"></i> </a>
            </td>
          </tr>
      @endforeach
         
      </tbody>

    </table>
  
<div class="text-center"> {{ $items->links() }} </div>
 

@endsection

@section('popup')

    @include('dashboard.settings.create')

@endsection

@section('scripts')
    @include('dashboard.layouts.message') 

    @include('dashboard.ajax.delete',['target'=>'setting']) 
  
@endsection
