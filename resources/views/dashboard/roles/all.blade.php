@extends('dashboard.layouts.app')

@section('title') @lang('site.roles') @endsection

@section('styles')
    
@endsection


@section('content')
  
<div class="btn-group">

    @if(has_permission('roles_add'))
        <a class="btn btn-warning" href="{{ route('admin.role.add') }}"> 
                <i class="fa fa-plus"></i>  @lang('site.add') </a> 
    @endif

</div>

<br/> <br/>

<table class="table table-striped jambo_table bulk_action" id="myTbl">
    <thead class=" text-primary">
        <tr>
            <th scope="col">#  </th>
            <th scope="col"> @lang('site.name') </th>
            <th scope="col"> @lang('site.permissions') </th>
            <th scope="col"> @lang('site.active') </th>
            <th scope="col" style="width: 80px;"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($items as $item)
            <tr>
                <td>{{$item->id}}</td>

                <td>{{$item['name_'.my_lang()]}}</td>

                <td>
                    @foreach ($item->role_permissions as $per)
                        <label class="btn btn-default"> {{ __('site.'. $per->permission) }} </label>
                    @endforeach
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
                    @if(has_permission('roles_edit'))
                        <a href="{{ route('admin.role',$item->id) }}" class="btn btn-info btn-xs">
                            <i class="fa fa-edit"></i> </a>
                    @endif

                    @if(has_permission('roles_delete'))
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
 
@endsection

@section('scripts')
    @include('dashboard.layouts.message_growl') 

    @include('dashboard.ajax.delete',['target'=>'role']) 
  
@endsection
