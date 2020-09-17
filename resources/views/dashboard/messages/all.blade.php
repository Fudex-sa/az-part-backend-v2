@extends('dashboard.layouts.app')

@section('title') @lang('site.messages')   @endsection

@section('styles')
    
@endsection


@section('content')
  
<div class="btn-group">
     
    <a class="btn btn-warning" data-toggle="modal" data-target=".add_item"> 
            <i class="fa fa-plus"></i>  @lang('site.add') </a> 
     
</div>

<br/> <br/>

<table class="table table-striped jambo_table bulk_action" id="myTbl">
    <thead class=" text-primary">
        <tr>
            <th scope="col">#  </th>
            <th scope="col">{{ __('site.keyword') }}  </th>
            <th scope="col">{{ __('site.value') }}  </th>
            <th scope="col">{{ __('site.msg') }}</th>
            <th scope="col"></th>
      </tr>
      </thead>
      <tbody>
        @foreach($items as $item)
        <tr>
            <td>{{$item->id}}</td>

            <td>{{$item->keyword}}</td>
            
            <td>{{$item->value}}</td>
            
            <td>{{$item->msg}}</td>                         
            
            <td>
                <a href="{{ route('admin.message.edit',$item->id) }}" class="btn btn-info btn-xs">
                    <i class="fa fa-edit"></i> </a>
                        
            </td>
        </tr>
    @endforeach  
         
      </tbody>

    </table>
  
<div class="text-center"> {{ $items->links() }} </div>
 

@endsection

@section('popup')

    @include('dashboard.messages.create')

@endsection

@section('scripts')
    @include('dashboard.layouts.message') 

  
@endsection
