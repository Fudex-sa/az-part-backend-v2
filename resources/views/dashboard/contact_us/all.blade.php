@extends('dashboard.app')

@section('title') @lang('site.contact_us') @endsection

@section('styles')
    
@endsection


@section('content')
   
<table class="table table-striped jambo_table bulk_action" id="myTbl">
    <thead class=" text-primary">
        <tr>
            <th scope="col">#  </th>
            <th scope="col">{{__('site.name')}} </th>
            <th scope="col">{{__('site.email')}}  </th>
            <th scope="col">{{__('site.mobile')}}  </th>
            <th scope="col">{{__('site.msg')}}  </th>
            <th> @lang('site.message_date') </th>
            <th scope="col"></th>
      </tr>
      </thead>
      <tbody>
        @foreach($items as $item)
        <tr>
            <td>{{$item->id}}</td>
            
            <td>{{$item->name}}</td>
            
            <td>{{$item->email}}</td>
            
            <td>{{$item->mobile}}</td>
            
            <td>{{ str_limit($item->msg, $limit = 12, $end = '...') }}</td>
            
            <td> {{ $item->created_at }} </td>
            
            <td>
                @if(has_permission('contact_us_edit'))
                    <a href="{{route('admin.contact_us.show',$item->id)}}" class="btn btn-info btn-xs"> <i class="fa fa-eye"></i> </a>
                @endif

                @if(has_permission('contact_us_delete'))
                    <a onclick="deleteItem({{ $item->id }})" class="btn btn-danger btn-xs">
                        <i class="fa fa-trash"></i> </a>
                @endif

                @if(has_permission('contact_us_add'))
                    <a href='mailto:{{$item->email}}?subject=Replay Message' target="_blank" class="btn btn-warning btn-xs">
                        <i class="fa fa-reply"></i> </a>
                @endif
            </td>
            
        </tr>
    @endforeach

      </tbody>

    </table>
  
<div class="text-center"> {{ $items->links() }} </div>
 

@endsection
 

@section('scripts')
    @include('dashboard.ajax.delete',['target'=>'contact_us']) 
  
@endsection
