@extends('dashboard.app')

@section('title') @lang('site.data_site') @endsection

@section('styles')
    
@endsection


@section('content')
  
<div class="btn-group">
     
    @if(has_permission('data_site_add'))
        <a class="btn btn-warning" data-toggle="modal" data-target=".add_item"> 
                <i class="fa fa-plus"></i>  @lang('site.add') </a> 
    @endif

</div>

<br/> <br/>

<table class="table table-striped jambo_table bulk_action" id="myTbl">
    <thead class=" text-primary">
        <tr>
          <th>#  </th>

          <th> @lang('site.keyword') </th>

          <th> @lang('site.value') </th>
          
          <th style="width: 100px;"></th>
      </tr>
      </thead>
      <tbody>
       @foreach($items as $k=>$item)
          <tr>
            <td>{{$item->id}}</td>
            
            <td>{{$item->keyword}}</td>
            
            <td>{{$item['value_'.my_lang()]}}</td>             

            <td>
                @if(has_permission('data_site_edit'))
                    <a href="{{ route('admin.data_site',$item->id) }}" class="btn btn-info btn-xs">
                        <i class="fa fa-edit"></i> </a>
                @endif

                @if(has_permission('data_site_delete'))
                    {{-- <a onclick="deleteItem({{ $item->id }})" class="btn btn-danger btn-xs">
                        <i class="fa fa-trash"></i> </a> --}}
                @endif
            </td>
          </tr>
      @endforeach
         
      </tbody>

    </table>
  
<div class="text-center"> {{ $items->links() }} </div>
 

@endsection

@section('popup')

    @include('dashboard.data_site.create')

@endsection

@section('scripts')
    
    @include('dashboard.ajax.delete',['target'=>'data_site']) 
  
@endsection
