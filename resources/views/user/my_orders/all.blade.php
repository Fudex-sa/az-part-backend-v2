
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

          <div class="col-lg-9 col-md-9 ">
           <ul class="row  orders-info">
             
            <li class="col-md-12">
              <span class="col-md-4"> <i class="fa fa-info"></i> @lang('site.my_avaiable_manual_orders') : </span>
              <span class="col-md-1 required">  {{ $manual_package }} @lang('site.store') </span>
              ||
              <span class="col-md-4"> <i class="fa fa-info"></i> @lang('site.my_avaiable_elec_orders') : </span>
              <span class="col-md-1 required">  {{ $elec_package }} @lang('site.request') </span>
            </li>
 


              {{-- <li class="col-md-12">
                 <span class="col-md-6 "> <i class="fa fa-info"></i> @lang('site.free_manul_search') : </span>
                 <span class="col-md-2 "> {{ setting('manual_search_result') }} </span>
              </li>

              <li class="col-md-12">
                <span class="col-md-6"> <i class="fa fa-info"></i> @lang('site.free_elec_search') : </span>
                <span class="col-md-2 "> {{ setting('electronic_search_result') }} </span>
              </li>

              <li class="col-md-12">
                <span class="col-md-6"> <i class="fa fa-info"></i> @lang('site.my_free_elec_search') : </span>
                <span class="col-md-2 "> {{ logged_user()->available_orders }}  </span>
              </li> --}}
           </ul>
 <div class="table-responsive">
                    <table class="my-tbl text-center">
                      <thead class="thead-light">
                        <tr>
                          <th style="width: 100px;"> @lang('site.order_no')  </th>
                          <th> @lang('site.order_type') </th>
                          <th> @lang('site.pieces_count') </th>
                          <th> @lang('site.rep') </th>
                          <th> @lang('site.delivery_price') </th>
                          <th> @lang('site.total')  </th> 
                          <th> @lang('site.remaining_cost') </th>                         
                          <th> @lang('site.payment_method') </th>                         
                          <th> @lang('site.status')  </th>
                          <th> @lang('site.created_at')  </th>                           
                        </tr>
                      </thead>
                      <tbody>

                        @foreach ($items as $item)
                            <tr>
                            <td> <a href="{{ route('order',$item) }}">
                                <i class="fa fa-eye"></i> AZ-{{ $item->id }} </a> 
                            </td>
 
                            <td> {{ __('site.'.$item->type) }} </td>

                            <td> {{ count($item->cart) }} @lang('site.piec') </td>

                            <td> {{ $item->shipping->rep ? $item->shipping->rep->name : __('site.waiting_for_assign') }} </td>

                            <td> {{ $item->delivery_price}} @lang('site.rs') </td>

                            <td> {{ $item->total }} @lang('site.rs') </td>

                            <td> {{ $item->remaining_cost }} @lang('site.rs') </td>

                            <td> {{ __('site.'.$item->payment_method) }} </td>

                            <td> <span class="btn status-{{ $item->order_status->id }}"> 
                                {{ $item->order_status ? $item->order_status['name_'.my_lang()] 
                                : '-' }} </td>

                            <td> {{ date('Y-m-d',strtotime($item->created_at)) }} </td>

                            </tr>
                        @endforeach
                       
                      </tbody>
                    </table>
</div>
                    <div class="text-center"> {{ $items->links('vendor.pagination.bootstrap-4') }}   </div>
                  </div>
               

   
        </div>
      </div>
    </div>
  </div>
</section>

@endsection

@section('scripts')
 

@endsection