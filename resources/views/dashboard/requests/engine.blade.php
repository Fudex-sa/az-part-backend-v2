@extends('dashboard.layouts.app')

@section('title') {{ __('site.request_engine').' AZ-'. $item->id }}  @endsection

@section('styles')
    
@endsection


@section('content')
    
<div class="text-center">
    <p> <b> ( {{ $item->brand['name']. ' - ' . $item->model['name'] . ' - '. $item->year . ' - ' .
        $item->piece['name'] }} ) </b> </p>
</div>

<table class="table table-striped jambo_table bulk_action">
    <thead>
    <tr class="headings">
        <th scope="col">#  </th>
        <th scope="col">{{__('site.seller_name')}}  </th>
        <th scope="col">{{__('site.seller_type')}}</th>
        <th scope="col">{{__('site.seller_vip')}}</th>
        <th scope="col">{{__('site.status')}}</th>
        <th scope="col">{{__('site.send_offer')}}</th>
        <th scope="col">{{__('site.assign_date')}}</th>
        <th scope="col">{{__('site.update_date')}}</th>
        
    </tr>
    </thead>

    <tbody>
        
        @foreach($items as $k=>$row)
        @if($row->user)
        <tr>
            <td>{{$k+1}}</td>
            
            <td><a href="{{route('admin.request.engine_user',['user' =>$row->user['id'],'item' => $row->id])}}"
                 target="_blank">{{$row->user['name']}}</a></td>
            
            <td><span class="label label-{{$row->user['user_role']}}"> {{__('site.'.$row->user['user_role'])}}</span></td>
            
            <td>@if($row->user['vip'] == 1) <span class="vip"> <i class="fa fa-check green"></i>
                    {{__('site.yes')}}</span> @else <span class="not_vip"><i class="fa fa-times"></i>
                        {{__('site.no')}} </span> @endif   </td>
            <td><span class="label label-{{$row->status}}">{{__('site.'.$row->status)}}</span></td>

            <td>
                @if($row->status == "processing")
                <a href="{{ route('admin.offer.send',$row->id) }}" target="_blank"> {{__('site.send')}} </a>
                @else {{__('site.'.$row->status)}} @endif    
            </td>

            <td>{{$row->created_at}}</td>
            
            <td>{{$row->updated_at}}</td>
        </tr>
        @endif
    @endforeach
        
    </tbody>
</table>
 
@endsection



@section('scripts')
@include('dashboard.layouts.message') 
@endsection
