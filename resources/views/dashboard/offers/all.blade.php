@extends('dashboard.app')

@section('title') 
    @lang('site.request_offers')   AZ-{{$item->id}}
@endsection

@section('styles')
    
@endsection


@section('content')
 
<table class="table table-striped jambo_table bulk_action">
    <thead>
    <tr class="headings">
        <th>#</th>
        <th> {{__('site.seller')}} </th>
        <th> {{__('site.user_type')}}  </th>
        <th> {{__('site.price')}} </th>
        <th> {{__('site.details')}} </th>
        <th> {{__('site.show_seller_mobile')}} </th>
        <th> {{__('site.accept')}} </th>
        <th></th>
       
    </tr>
    </thead>

    <tbody>
         
        @if($items)
         @foreach($items as $k=>$row)
            @if($row->user)
            <tr>
                <td>{{$k+1}}</td>
                <td><a href="{{url(app()->getLocale().'/admin/user/'.$row->user['id'])}}" target="_blank">
                    @if($row->user['vip'] == 1) <i class="fa fa-check green"></i> @endif
                    code{{$row->user['id']}}</a>

                    <i class="fa fa-star" style="color:yellow"></i> ({{$row->user['rating']}})
                </td>
                    <td><span class="{{$row->user['user_role']}}">{{__('site.'.$row->user['user_role'])}}</span></td>
                <td>{{$row->price .' '. __('site.rs') }}</td>
                <td><a href="{{url('admin/offer/'.$row->id)}}" target="_blank"><i class="fa fa-eye"></i> {{__('site.view')}} </a> </td>
                <td class="text-center"> {{ $row->show_seller_mobile == 1 ? __('site.yes') : __('site.no') }} </td>
                <td>@if($row->status == 'accepted')<i class="fa fa-check green"></i>@else
                        <i class="fa fa-times red"></i> @endif </td>

                <td> @if(auth()->user()->id == $row->user['id'])
                <a href="javascript:void(0);" itemid="{{$row->id}}" class="removeOffer"><i class="fa fa-trash"></i> </a>  @endif</td>

            </tr>
            @endif
        @endforeach
            @else <tr> <td colspan="6"> {{__('site.no_offers_yet')}} </td></tr> @endif
            
        </tbody>
</table>


 

@endsection


@section('scripts')
 
@endsection