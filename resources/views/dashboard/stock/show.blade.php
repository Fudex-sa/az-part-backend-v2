@extends('dashboard.app')

@section('title') @lang('site.stock')  @endsection

@section('styles')
    
@endsection


@section('content')
 

<table class="table table-striped jambo_table bulk_action" id="myTbl">
    <thead class=" text-primary">
        <tr>
            <th scope="col">#  </th>
            <th scope="col"> {{ __('site.brand') }}  </th>
            <th scope="col"> {{ __('site.model') }}  </th>
            <th scope="col"> {{ __('site.year') }}  </th>
            <th scope="col">{{ __('site.piece_name') }}</th>            
            <th scope="col">{{ __('site.price') }}</th>
            <th scope="col"></th>
      </tr>
      </thead>
      <tbody>
        @foreach($items as $k=>$item)
            <tr>
                <td>{{$k+1}}</td>

                <td> {{ $item->brand['name_'.my_lang()] }} </td>

                <td> {{ $item->model['name_'.my_lang()] }} </td>
                
                <td> {{ $item->year}} </td>
                
                <td>{{$item->piece['name_'.my_lang()]}}</td>
                
                <td> {{ $item->price }} @lang('site.rs') </td>

                <td>                  
                        <a onclick="deleteItem({{ $item->id }})" class="btn btn-danger btn-xs">
                            <i class="fa fa-trash"></i> </a>
                </td>
            </tr>
        @endforeach 
         
      </tbody>

    </table>
  
 

@endsection

@section('popup')

    @include('dashboard.stock.create')

@endsection

@section('scripts')
    
    @include('dashboard.ajax.delete',['target'=>'stock']) 
   
@endsection
