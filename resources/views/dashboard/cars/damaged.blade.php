@extends('dashboard.app')

@section('title') @lang('site.damaged_cars') @endsection

@section('styles')
    
@endsection


@section('content')
   
<table class="table table-striped jambo_table bulk_action" id="myTbl">
    <thead>
        <tr>
            <th scope="col">#  </th>
            <th scope="col" style="width: 100px;"> {{__('site.image')}}</th>
            <th scope="col"> {{__('site.title')}}</th>            
            <th scope="col"> {{__('site.model')}}</th>
            <th scope="col"> {{__('site.price')}}</th>
            <th scope="col">{{__('site.owner')}}</th>
            <th scope="col"> {{__('site.views')}}</th>
            <th scope="col"> {{__('site.date')}}</th>
            <th scope="col"> {{__('site.comments')}}</th>
            <th scope="col" style="width: 100px;"> </th>
          </tr>
    </thead>

    <tbody>
        
        @foreach($items as $item)
        <tr>
            <td>{{$item->id}}</td>
            
            <td>@if($item->img != '') <img src="{{asset('uploads/'.$item->img)}}" class="img-tbl"/> @endif
            </td>
            
            <td><a href="{{url('car/'.$item->id)}}" target="_blank">{{$item->title}}</a></td>
            
            <td>{{$item->brand['name']}} - {{$item->model['name']}} - {{$item->year}} </td>
            
            <td>{{$item->price}} {{__('site.rs')}}</td>
            
            <td>{{$item->user['name']}}</td>
            
            <td>{{$item->views}}</td>
            
            <td>{{date('d-m-Y',strtotime($item->created_at))}}</td>
            
            <td><a href="{{ route('admin.cars.comments',$item->id) }}">{{ $item->comments->count() }}</a></td>

            <td>
                <a href="{{ route('admin.car.damaged.edit',$item->id) }}" class="btn btn-info btn-xs"> <i class="fa fa-edit"></i> </a>

                <a onclick="deleteItem({{ $item->id }})" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> </a>

            </td>
        </tr>
    @endforeach
        
    </tbody>
</table>

<div class="text-center"> {{ $items->links() }} </div>
 

@endsection



@section('scripts')
    
    @include('dashboard.ajax.delete',['target'=>'car']) 

@endsection
