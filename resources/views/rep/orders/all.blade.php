
@extends('site.app')

@section('title') @lang('site.my_orders') @endsection

@section('styles')
    
@endsection

@section('content')

<section class="profile">
  <div class="container">
    <div class="row">

      @include('layouts.breadcrumb')
 
      <div class="col-md-12">
        <div class="row">

          @include('layouts.nav_side_menu')          

          <div class="col-lg-9 col-md-9  col-12">
            
                <table class="my-tbl text-center">
                  <thead>
                    <tr>
                      <th style="width: 100px;"> @lang('site.order_no')  </th>
                      <th> @lang('site.order_user')  </th>
                      <th> @lang('site.region')  </th>                    
                      <th> @lang('site.delivery_price')  </th>
                      <th > @lang('site.total')  </th>
                      <th> @lang('site.remaining_cost') </th>                         
                      <th> @lang('site.payment_method') </th>
                      <th > @lang('site.status')  </th>
                      <th > @lang('site.created_at')  </th>                        
                    </tr>
                  </thead>
                  <tbody>

                    @foreach ($items as $item)
                        <tr>
                            <td> <a href="{{ route('order',$item) }}">
                            <i class="fa fa-eye"></i> AZ-{{ $item->id }} </a> </td>

                            <td> 
                              @if($item->user_type == 'seller') {{ $item->seller ? $item->seller->name : '' }}
                              @elseif($item->user_type == 'broker') {{ $item->broker ? $item->broker->name : '' }}
                              @elseif($item->user_type == 'company') {{ $item->company ? $item->company->name : '' }}
                              @else {{ $item->user ? $item->user->name : '' }} @endif
                            </td>

                            <td>                                     
                                {{ $item->shipping->region ? $item->shipping->region['name_'.my_lang()] : '' }} -
                                {{ $item->shipping->city ? $item->shipping->city['name_'.my_lang()] : '' }} 
                            </td>
  
                            <td> {{ $item->delivery_price }} @lang('site.rs') </td>

                            <td> {{ $item->total }} @lang('site.rs') </td>


                            <td> {{ $item->remaining_cost }} @lang('site.rs') </td>

                            <td> {{ __('site.'.$item->payment_method) }} </td>

                            <td> <span class="btn status-{{ $item->order_status->id }}"> 
                              {{ $item->order_status ? $item->order_status['name_'.my_lang()] : '-' }} </span> </td>

                            <td> {{ date('Y-m-d',strtotime($item->created_at)) }} </td>

                            
                        </tr>
                    @endforeach
                    
                  </tbody>
                </table>

                <div class="text-center">  {{ $items->links('vendor.pagination.bootstrap-4') }}  </div>
              </div>
                
        </div>
      </div>
    </div>
  </div>
</section>

@endsection

@section('scripts')
 

@endsection