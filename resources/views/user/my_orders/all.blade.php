
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

          <div class="col-lg-9 col-md-9  col-9">
           <ul>
              <li> @lang('site.free_manul_search') : {{ setting('manual_search_result') }} </li>
              <li> @lang('site.free_elec_search') : {{ setting('electronic_search_result') }} </li>
              <li> @lang('site.my_free_elec_search') : {{ logged_user()->available_orders }}  </li>
           </ul>

                  <div class="table-responsive">
                    <table class="table mt-5 tabel-order myTbl">
                      <thead class="thead-light">
                        <tr>
                          <th style="width: 100px;"> @lang('site.order_no')  </th>
                          <th> @lang('site.pieces_count') </th>
                          <th> @lang('site.rep') </th>
                          <th> @lang('site.delivery_price') </th>
                          <th> @lang('site.total')  </th>                          
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
 
                            <td> {{ count($item->cart) }} @lang('site.piec') </td>

                            <td> {{ $item->shipping->rep->name }} </td>

                            <td> {{ $item->delivery_price}} @lang('site.rs') </td>

                            <td> {{ $item->total }} @lang('site.rs') </td>

                            <td> <span class="btn status-{{ $item->order_status->id }}"> 
                                {{ $item->order_status ? $item->order_status['name_'.my_lang()] 
                                : '-' }} </td>

                            <td> {{ date('Y-m-d',strtotime($item->created_at)) }} </td>

                            </tr>
                        @endforeach
                       
                      </tbody>
                    </table>

                    <div class="text-center"> {{ $items->links() }} </div>
                  </div>
                
              </div>

   
        </div>
      </div>
    </div>
  </div>
</section>

@endsection

@section('scripts')
 

@endsection