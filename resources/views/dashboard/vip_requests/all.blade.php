@extends('dashboard.app')

@section('title') @lang('site.requests_vip') @endsection

@section('styles')

@endsection


@section('content')

<table class="table table-striped jambo_table bulk_action text-center" id="myTbl">
    <thead>
    <tr class="headings">
        <th>#  </th>
        <th> @lang('site.user')</th>
        <th> @lang('site.user_type')</th>
        <th> @lang('site.status')   </th>
         
        <th style="width:180px;"></th>
    </tr>
    </thead>

    <tbody>

        @foreach($items as $k=>$item)

        <tr class="even pointer">

            <td>{{ $k+1 }}</td>

            <td> @if($item->user_type == 'broker') {{ $item->broker->name}}
                @elseif($item->user_type == 'seller') {{ $item->seller->name }}
                @else {{ $item->user->name }} 
            </td>

            <td> {{ __('site.'.$item->user_type) }} </td>

            <td> {{ __('site.'.$item->status) }}</td>

            <td>
                 <button class="btn btn-success btn-xs" onclick="activate({{ $item->id }})">
                    <i class="fa fa-check"></i> @lang('site.activate') </button>
                
                <button class="btn btn-warning btn-xs" onclick="deActivate({{ $item->id }})">
                    <i class="fa fa-close"></i> @lang('site.de_activate') </button>
                
             
                @if(has_permission('users_delete'))
                    <a onclick="deleteItem({{ $item->id }})" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> </a>
                @endif
            </td>
        </tr>

        @endforeach

    </tbody>
</table>

<div class="text-center">  {{ $items->links('vendor.pagination.bootstrap-4') }}  </div>


@endsection
 

@section('scripts')

    @include('dashboard.ajax.delete',['target'=>'vip_request'])
    @include('dashboard.ajax.activate',['target'=>'vip_request'])
    @include('dashboard.ajax.deActivate',['target'=>'vip_request'])
  
@endsection
