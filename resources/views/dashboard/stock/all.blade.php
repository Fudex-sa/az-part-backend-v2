@extends('dashboard.layouts.app')

@section('title') @lang('site.stock') @endsection

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
            <th> @lang('site.stock_id') </th>
            <th scope="col"> {{ __('site.model') }}  </th>
            <th scope="col">{{ __('site.piece_name') }}</th>
            <th scope="col">{{ __('site.prices') }}</th>
            <th scope="col"></th>
      </tr>
      </thead>
      <tbody>
        @foreach($items as $k=>$item)
            <tr>
                <td>{{$k+1}}</td>

                <td> S#{{ $item->id }} </td>
                
                <td> {{$item->brand ? $item->brand['name'] : '' }} -
                    {{ $item->model ? $item->model['name'] : '' }} -
                    {{ $item->year}}
                </td>
                
                <td>{{$item->piece['name']}}</td>
                
                <td>@if(count($item->movements) > 0)
                    @foreach($item->movements as $movement)
                        {{ $movement->price . __('site.rs') }} -
                    @endforeach
                    @else - @endif
                </td>                      
                
                <td>
                    <a href="{{ route('admin.stock.add_price',$item->id) }}"  class="btn btn-info btn-xs">
                        <i class="fa fa-money"></i> @lang('site.add_price') </a>                         
    
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

    @include('dashboard.stock.create')

@endsection

@section('scripts')
    @include('dashboard.layouts.message') 

    @include('dashboard.ajax.delete',['target'=>'stock']) 
  
    <script>
         $("#brand_id").change(function () {
            var _token = "{{ csrf_token() }}";
            var brand_id = $(this).val();
            var lang = "{{app()->getLocale()}}";

            $.ajax({
                type: 'POST',
                url: "{{ route('getModels') }}",
                data: {  _token:_token ,brand_id:brand_id,lang:lang},
                success: function(response) {
                    $("#model_id").html(response);
                }
            });
        });

    </script>
@endsection
