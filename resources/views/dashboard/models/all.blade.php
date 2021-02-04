@extends('dashboard.app')

@section('title') @lang('site.models') |  {{ $brand['name_'.my_lang()] }} @endsection

@section('styles')
    
@endsection


@section('content')
  
<div class="btn-group">
     
    @if(has_permission('models_add'))
        <a class="btn btn-warning" data-toggle="modal" data-target=".add_item"> 
                <i class="fa fa-plus"></i>  @lang('site.add') </a> 
    @endif 
</div>

<br/> <br/>

<table class="table table-striped jambo_table bulk_action" id="myTbl">
    <thead class=" text-primary">
        <tr>
            <th scope="col">#  </th>                    
            <th scope="col">{{__('site.name')}}</th>
            <th scope="col"></th>
      </tr>
      </thead>
      <tbody>
        @foreach($items as $item)
        <tr>
            <td>{{$item->id}}</td>  

            <td>{{$item['name_'.my_lang()]}}</td>                            
            
            <td>
                @if(has_permission('models_edit'))
                    <a href="{{ route('admin.model',$item->id) }}" class="btn btn-info btn-xs">
                        <i class="fa fa-edit"></i> </a>
                @endif

                @if(has_permission('models_delete'))
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

    @include('dashboard.models.create')

@endsection

@section('scripts')
    
    @include('dashboard.ajax.delete',['target'=>'model']) 
  
@endsection
