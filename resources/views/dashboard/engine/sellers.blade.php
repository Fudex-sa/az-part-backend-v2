@extends('dashboard.app')

@section('title') {{ __('site.order_engine')  }} ER{{ $item->id }}  @endsection

@section('styles')
    
@endsection


@section('content')
  
<table class="table table-striped jambo_table bulk_action text-center" id="myTbl">
    <thead class="text-primary text-center">
        <tr>
            <th> # </th>            
            <th> <i class="fa fa-camera"></i> </th>
            <th> @lang('site.seller') </th>        
            <th> @lang('site.seller_type') </th>
            <th> @lang('site.vip') </th>            
            <th> @lang('site.saudi') </th> 

            <th> @lang('site.price') </th>
            <th> @lang('site.composition') </th>            
            <th> @lang('site.return_possibility') </th>            
            <th> @lang('site.delivery_possibility') </th> 
            
            <th> @lang('site.status') </th>                        
            <th> @lang('site.updated_at') </th>
            <th> @lang('site.edit') </th>
            
      </tr>
      </thead>
      <tbody>
       @foreach($item->assign_sellers as $k=>$row)
          <tr>
            <td> {{ $k+1 }} </td>            

            <td> 
                @if($row->seller->photo) <img src="{{ img_path($row->seller->photo) }}" class="img-user" /> 
                @else <img src="{{ site('assets/images/logo.png') }}" class="img-user" /> @endif
            </td>

            <td> 
                @if($row->seller_type == 'broker')  {{ $row->broker ? $row->broker->name : '' }}
                @else {{ $row->seller ? $row->seller->name : '' }} @endif </td>

            <td>
                 @if($row->seller_type == 'broker') <label class="label label-broker"> @lang('site.broker')  </label>

                @else <label class="label label-{{ $row->seller->user_type }}"> 
                    {{ __('site.'.$row->seller->user_type) }} </label>  @endif
            </td>

            <td> @if($row->seller->vip == 1) 
                    <span class="success"> <i class="fa fa-check"></i> @lang('site.yes') </span>
                @else<span class="false"> <i class="fa fa-times"></i> @lang('site.no') </span>  @endif
            </td>

            <td> {{ $row->seller->saudi == 1 ? __('site.yes') : __('site.no') }} </td>

            <td> {{ $row->price ? $row->price . ' ' . __('site.rs') : '-'}} </td>

            <td> @if($row->price) {{ $row->composition == 1 ? __('site.yes') : __('site.no') }} @else - @endif </td>
            <td> @if($row->price) {{ $row->return_possibility == 1 ? __('site.yes') : __('site.no') }} @else - @endif </td>
            <td> @if($row->price) {{ $row->delivery_possibility == 1 ? __('site.yes') : __('site.no') }} @else - @endif </td>

            <td>
                <span class="btn status-{{ $row->status_id }}"> {{ $row->status['name_'.my_lang()] }} </span>
            </td>
            
            <td> {{ $row->updated_at }} </td>

            <td> <a href="{{ route('admin.engine.edit',$row->id) }}" class="btn btn-info btn-xs"> 
                <i class="fa fa-edit"></i> </a> </td>
          </tr>
      @endforeach
         
      </tbody>

    </table>
    

@endsection

@section('popup')
 

@endsection

@section('scripts')
    
    @include('dashboard.ajax.delete',['target'=>'electronic']) 
 
@endsection
