@extends('dashboard.layouts.app')

@section('title') @lang('site.special_requests') @endsection

@section('styles')
    
@endsection


@section('content')
 
<div class="btn-group">
    
    <a href="{{route('export.excel.requests.vip')}}" class="btn btn-success"> 
        <i class="fa fa-download"></i>  @lang('site.excel') </a> 

    <a href="{{route('export.pdf.requests.vip')}}" class="btn btn-info"> 
        <i class="fa fa-file"></i>  @lang('site.pdf') </a> 
      
</div>

<br/> <br/>

<table class="table table-striped jambo_table bulk_action">
    <thead>
    <tr class="headings">
        <th scope="col">#  </th>
        <th scope="col">{{__('site.request_no')}}  </th>
        <th scope="col">{{__('site.model')}}</th>
        <th scope="col">{{__('site.piece_name')}}</th>
        <th scope="col" style="width:100px;">{{__('site.the_offers')}}</th>
        <th scope="col">{{__('site.the_request_engine')}}</th>
        <th scope="col">{{__('site.request_status')}}</th>
        <th class="text-center" style="width: 100px;">{{__('site.paid')}}</th>
        <th> {{ __('site.commission') }} </th>
        <th scope="col">{{__('site.date')}}</th>
        <th></th>
    </tr>
    </thead>

    <tbody>
        
        @foreach($items as $k=>$item)
        <tr>
            <td>{{$k+1}}</td>
            <td><a href="javascript:void(0);"  data-toggle="modal" data-target="#viewItem{{$item->id}}">
                    <i class="fa fa-eye"></i> AZ-{{$item->id}}</a></td>
            <td>{{$item->brand['name']}} - {{$item->model['name']}} {{$item->year}}</td>
            <td>
                {{ $item->pieceAlternaive->piece['name']  }}
            </td>
            <td><a href="javascript:void(0);"  data-toggle="modal" data-target="#offers{{$item->id}}">
                    <i class="fa fa-tag"></i> {{count($item->offers)}}</a></td>

            <td><a href="{{url('admin/request/engine/vip/'.$item->id)}}" target="_blank">
                    <i class="fa fa-search"></i> {{__('site.view')}}</a></td>

            <td><span class="{{$item->status}}"> {{ __('site.'.$item->status) }}</span></td>
            <td class="text-center">{{$item->paid == 1 ? __('site.yes') : __('site.no') }}
                <br/>
                @if($item->paid == 1)
                    ({{ $item->total }} @lang('site.rs') )
                @endif
            </td>
            <td>
                    @if(count($item->commission) > 0)
                        @foreach($item->commission as $com)
                            {{ $com->amount . __('site.rs') }}
                        @endforeach
                    @else {{ __('site.not_paid') }}
                    @endif
                </td>
            <td>{{date('d-m-Y',strtotime($item->created_at))}}</td>
            <td><button data-toggle="modal" data-target="#delete_popup{{$item->id}}" class="removeRequest btn btn-danger" itemid="{{ $item->id }}">
                <i class="fa fa-trash"></i></button></td>
        </tr>

        @endforeach
        
    </tbody>
</table>

<div class="text-center"> {{ $items->links() }} </div>
 

@endsection



@section('scripts')
@include('dashboard.layouts.message') 
@endsection
