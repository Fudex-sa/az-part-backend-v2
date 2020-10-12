@extends('dashboard.app')

@section('title') @lang('site.notifications')   @endsection

@section('styles')
    
@endsection


@section('content')
  
<div class="btn-group">

    @if(has_permission('notifications_add'))
        <a class="btn btn-warning" data-toggle="modal" data-target=".add_item"> 
                <i class="fa fa-plus"></i>  @lang('site.add') </a> 
    @endif

</div>

<br/> <br/>

<table class="table table-striped jambo_table bulk_action" id="myTbl">
    <thead class=" text-primary">
        <tr>
            <th scope="col">#  </th>
            <th scope="col">{{ __('site.keyword') }}  </th>
            <th scope="col">{{ __('site.value_'.my_lang()) }}  </th>            
            <th scope="col"></th>
      </tr>
      </thead>
      <tbody>
        @foreach($items as $item)
        <tr>
            <td>{{$item->id}}</td>

            <td>{{$item->keyword}}</td>
            
            <td>{{$item['value_'.my_lang()]}}</td>                                
            
            <td>
                @if(has_permission('notifications_edit'))
                    <a href="{{ route('admin.notification',$item->id) }}" class="btn btn-info btn-xs">
                        <i class="fa fa-edit"></i> </a>
                @endif

                @if(has_permission('notifications_delete'))
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

    @include('dashboard.notifications.create')

@endsection

@section('scripts')
    
    @include('dashboard.ajax.delete',['target'=>'notification']) 
    
@endsection
