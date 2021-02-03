@extends('dashboard.app')

@section('title') {{ $car->title }} @lang('site.comments') @endsection

@section('styles')
    
@endsection


@section('content')
   
<table class="table table-striped jambo_table bulk_action text-center" id="myTbl">
    <thead>
        <tr>
            <th scope="col">#  </th>            
            <th scope="col"> {{__('site.user')}}</th>            
            <th scope="col"> {{__('site.user_type')}}</th>            
            <th scope="col"> {{__('site.comment')}}</th>  
            <th scope="col"> {{__('site.status')}}</th>            
            <th scope="col"> </th>
          </tr>
    </thead>

    <tbody>
        
        @foreach($items as $item)
        <tr>
            <td>{{$item->id}}</td>
           
            <td>{{ $item->user_type == 'company' ? $item->company->name : $item->user->name}}</td>
            
            <td> {{ __('site.'.$item->user_type) }} </td>

            <td>{{ $item->comment }}</td>
            
            <td>
                @if($item->approved ==1) <button class="btn btn-success btn-xs" onclick="activate({{ $item->id }})">
                    <i class="fa fa-check"></i> @lang('site.de_activate') </button>
                @else
                    <button class="btn btn-warning btn-xs" onclick="activate({{ $item->id }})">
                    <i class="fa fa-close"></i> @lang('site.activate') </button>
                @endif      
            </td>
            
            <td>               
                <a onclick="deleteItem({{ $item->id }})" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> </a>

            </td>
        </tr>
    @endforeach
        
    </tbody>
</table>

<div class="text-center"> {{ $items->links() }} </div>
 

@endsection



@section('scripts')
    
    @include('dashboard.ajax.delete',['target'=>'car_comment']) 
 
    @include('dashboard.ajax.activate',['target'=>'car_comment']) 
@endsection
