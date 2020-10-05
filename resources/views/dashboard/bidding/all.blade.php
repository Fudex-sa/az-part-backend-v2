@extends('dashboard.app')

@section('title') @lang('site.car_bidding') @endsection

@section('styles')
    
@endsection


@section('content')
   
<table class="table table-striped jambo_table bulk_action" id="myTbl">
    <thead>
    <tr class="headings">        
        <th scope="col">#  </th>
        <th scope="col"> {{__('site.user')}}</th>
        <th scope="col">{{__('site.car')}}</th>
        <th scope="col">{{__('site.car_owner')}}</th>
        <th scope="col"> {{__('site.comment')}}</th>
        <th scope="col"> {{__('site.price')}}</th>
        <th scope="col"> {{__('site.status')}}</th>
        <th scope="col"> {{__('site.date')}}</th>
        <th scope="col"> </th>
        <th></th>
    </tr>
    </thead>

    <tbody>
        
        @foreach($items as $item)
        @if(\App\Models\BadWord::strposa($item->comment,$result))
            <tr style="color: #ff0000">
                <td>{{$item->id}}</td>
                <td><a href="javascript:void(0);" data-toggle="modal" data-target="#bidderDetails{{$item->id}}">
                {{$item->user ? $item->user['name'] : '' }} </a> </td>
                <td>@if($item->car)<a href="{{url('car/'.$item->car['id'])}}" target="_blank">
                        {{$item->car['title']}}</a> @endif</td>
                <td>{{$item->car ? $item->car->user['name'] : ''}}</td>
                <td>{{$item->comment}}</td>
                <td>{{$item->price}}</td>
                <td>
                    @if($item->status == '0')
                        <span class="label label-danger">@lang('site.reject')</span>
                    @elseif($item->status == '1')
                        <span class="label label-success">@lang('site.approved')</span>
                    @else
                        <span class="label label-info">@lang('site.pending')</span>
                    @endif
                </td>

         <td>{{date('d-m-Y',strtotime($item->created_at))}}</td>
         <td>
             <a href="{{url('admin/car-binding/edit-approve/'.$item->id.'/'.'1')}}"> <i class="fa fa-thumbs-up"></i> </a>
             <a href="{{url('admin/car-binding/edit-reject/'.$item->id.'/'.'0')}}"> <i class="fa fa-thumbs-down"></i> </a>

             <a href="javascript:void(0);" data-toggle="modal" data-target="#editItem{{$item->id}}"><i class="fa fa-edit"></i> </a>
             <a href="javascript:void(0);" itemid="{{$item->id}}" class="remove"><i class="fa fa-trash"></i> </a>
         </td>
     </tr>
        @else
           <tr>
               <td>{{$item->id}}</td>
               <td><a href="javascript:void(0);" data-toggle="modal" data-target="#bidderDetails{{$item->id}}">
                   {{$item->user ? $item->user['name'] : ''}} </a></td>
               <td>@if($item->car) <a href="{{url('car/'.$item->car['id'])}}" target="_blank">
                       {{$item->car['title']}} </a> @endif </td>
                <td><a href="javascript:void(0);" data-toggle="modal" data-target="#carOwnerDetails{{$item->id}}">
                   {{$item->car ? $item->car->user['name'] : ''}} </a></td>
               <td>{{$item->comment}}</td>
               <td>{{$item->price}}</td>
               <td>
                   @if($item->status == '0')
                       <span class="label label-danger">@lang('site.reject')</span>
                   @elseif($item->status == '1')
                       <span class="label label-success">@lang('site.approved')</span>
                   @else
                       <span class="label label-info">@lang('site.pending')</span>
                   @endif
               </td>
               <td>{{date('d-m-Y',strtotime($item->created_at))}}</td>
               <td>
                   <a href="{{url('admin/car-binding/edit-approve/'.$item->id.'/'.'1')}}"> <i class="fa fa-thumbs-up"></i> </a>
                   <a href="{{url('admin/car-binding/edit-reject/'.$item->id.'/'.'0')}}"> <i class="fa fa-thumbs-down"></i> </a>

                   <a href="javascript:void(0);" data-toggle="modal" data-target="#editItem{{$item->id}}"><i class="fa fa-edit"></i> </a>
                   <a href="javascript:void(0);" itemid="{{$item->id}}" class="remove"><i class="fa fa-trash"></i> </a>
               </td>
           </tr>
     @endif
   @endforeach
        
    </tbody>
</table>

<div class="text-center"> {{ $items->links() }} </div>
 

@endsection



@section('scripts')
 
    @include('dashboard.ajax.delete',['target'=>'bidding']) 
 
   
@endsection
