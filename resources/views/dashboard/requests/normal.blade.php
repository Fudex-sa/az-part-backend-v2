@extends('dashboard.app')

@section('title') @lang('site.normal_requests') @endsection

@section('styles')
    
@endsection


@section('content')
 
<div class="btn-group">
    
    <a href="{{route('export.excel.requests.normal')}}" class="btn btn-success"> 
        <i class="fa fa-download"></i>  @lang('site.excel') </a> 

    <a href="{{route('export.pdf.requests.normal')}}" class="btn btn-info"> 
        <i class="fa     fa-file"></i>  @lang('site.pdf') </a> 
      
</div>

<br/> <br/>

<table class="table table-striped jambo_table bulk_action">
    <thead>
    <tr class="headings">
        <th class="column-title">#  </th>
        <th class="column-title" style="width: 100px;">{{__('site.request_no')}}</th>
        <th class="column-title">{{__('site.model')}}</th>
        <th class="column-title">{{__('site.piece_name')}}</th>
        <th class="column-title">{{__('site.the_offers')}}</th>
        <th class="column-title">{{__('site.the_request_engine')}}</th>
        <th class="column-title">{{__('site.request_status')}}</th>
        <th class="column-title">{{__('site.let_az_parts_deal_with_request')}}</th>
        <th class="column-title">{{ __('site.extra_fees') }} </th>
        <th class="column-title"> {{ __('site.commission') }} </th>
        <th class="column-title">{{__('site.date')}}</th>
       
    </tr>
    </thead>

    <tbody>
        
        @foreach($items as $k=>$item)

        <tr class="even pointer">
            <td>{{$k+1}}</td>

            <td><a href="{{ route('admin.request.show',$item->id) }}">                              
                    <i class="fa fa-eye"></i> AZ-{{$item->id}}</a></td>
            
            <td>{{$item->brand['name']}} - {{$item->model['name']}} {{$item->year}}</td>
            
            <td> {{ $item->pieceAlternaive->piece['name']  }} </td>
            
            <td> <i class="fa fa-tag"></i> {{count($item->offers)}} </td>
            
            <td><a href="{{url('admin/request/engine/'.$item->id)}}" target="_blank">
            <i class="fa fa-search"></i> {{__('site.view')}}</a></td>
    
            <td><span class="label label-{{$item->status}}"> {{ __('site.'.$item->status) }}</span></td>
            
                    <td class="right_wrong">
                @if( $item->let_admin_deal == 1) <i class="fa fa-check"></i> @else <i class="fa fa-times"></i> @endif
            </td>
            
            <td> {{ $item->extra_fees == 1 ? $item->extra_fees_amount : 0  }}  {{ __('site.rs') }} </td>
            
            <td>
                @if(count($item->commission) > 0)
                    @foreach($item->commission as $com)
                        {{ $com->amount . __('site.rs') }}
                    @endforeach
                @else {{ __('site.not_paid') }}
                @endif
            </td>
            
            <td>{{date('d-m-Y',strtotime($item->created_at))}}</td>
 
        </tr>

        @endforeach
        
    </tbody>
</table>

<div class="text-center"> {{ $items->links() }} </div>
 

@endsection



@section('scripts')

@endsection
