@extends('dashboard.layouts.app')

@section('title') @lang('site.ads_management') @endsection

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
            <th scope="col">{{__('site.image')}} </th>
            <th scope="col">{{__('site.location')}} </th>
            <th scope="col">{{__('site.with')}}  </th>
            <th scope="col"></th>
      </tr>
      </thead>
      <tbody>
       @foreach($items as $k=>$item)
          <tr>
            <td>{{$item->id}}</td>
            
            <td>@if($item->image != '') <img src="{{asset('uploads/'.$item->image)}}" class="img-tbl"/>
                @else <img src="{{asset('templates/images/logo.png')}}"/> @endif

            </td>
            
            <td> @lang('site.'.$item->location) </td>
            
            <td> {{ $item->width == 1 ?  '728*90' : '300*250' }} </td>

            <td>
                <a href="{{ route('admin.ad.edit',$item->id) }}" class="btn btn-info btn-xs">
                    <i class="fa fa-edit"></i> </a>

                <a onclick="deleteItem({{ $item->id }})" class="btn btn-danger btn-xs">
                    <i class="fa fa-trash"></i> </a>
            </td>
          </tr>
      @endforeach
         
      </tbody>

    </table>
  
<div class="text-center"> {{ $items->links() }} </div>
 

@endsection

@section('popup')

    @include('dashboard.ads.create')

@endsection

@section('scripts')
    @include('dashboard.layouts.message') 

    @include('dashboard.ajax.delete',['target'=>'ad']) 
  
@endsection
