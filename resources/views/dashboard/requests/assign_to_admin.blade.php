@extends('dashboard.layouts.app')

@section('title') @lang('site.admin_requests_assigned') @endsection

@section('styles')
    
@endsection


@section('content')
 
<div class="btn-group">
    <label class="btn btn-default">
        <a href="{{route('export.excel.requests.admin')}}" class="btn btn-success"> 
            <i class="fa fa-download"></i>  @lang('site.excel') </a> 
    </label>

    <label class="btn btn-default">
        <a href="{{route('export.pdf.requests.admin')}}" class="btn btn-info"> 
            <i class="fa     fa-file"></i>  @lang('site.pdf') </a> 
    </label>
     
</div>

<br/> <br/>

<table class="table table-striped jambo_table bulk_action">
    <thead>
    <tr class="headings">
        <th scope="col">#  </th>
        <th>{{__('site.request_owner')}}</th>
        <th scope="col">{{__('site.model')}}</th>          
        <th scope="col"> @lang('site.items') </th>              
        <th scope="col"> @lang('site.request_status') </th>                        
        <th scope="col"> @lang('site.date') </th>
        
    </tr>
    </thead>

    <tbody>
        
        @foreach($items as $item)
        @if($item->request)
    <tr>
        <td><a href="{{ route('admin.request.show',$item->request['id']) }}">
                  <i class="fa fa-eye"></i> AZ-{{$item->request['id']}}</a></td>

        <td> {{$item->request['user'] ? $item->request['user']['name'] : ''}} </td>
        
        <td>{{$item->request['brand'] ? $item->request['brand']['name'] : ''}}
            - {{$item->request['model'] ? $item->request['model']['name'] : ''}}
        - {{$item->request['year']}} </td>
      
        <td> {{ $item->request['pieceAlternaive'] ? $item->request->pieceAlternaive->piece['name'] : '' }}</td>
        
        <td><span class="{{$item->request['status']}}"> {{ __('site.'.$item->request['status']) }}</span></td>
       
        <td>{{date('d-m-Y',strtotime($item->request['created_at']))}}</td>
        
    </tr>

    @endif
    @endforeach
        
    </tbody>
</table>

<div class="text-center"> {{ $items->links() }} </div>
 

@endsection



@section('scripts')
@include('dashboard.layouts.message') 
@endsection
