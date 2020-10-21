
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

          <div class="col-lg-10 col-md-10  col-12">
           
                  <div class="table-responsive">
                    <table class="table mt-5 tabel-order myTbl">
                      <thead class="thead-light">
                        <tr>
                          <th style="width: 100px;"> @lang('site.order_no')  </th>
                          <th> @lang('site.region')  </th>
                          <th> @lang('site.address')  </th>
                          <th> @lang('site.notes')  </th>
                          <th > @lang('site.total')  </th>
                          <th > @lang('site.status')  </th>
                          <th > @lang('site.created_at')  </th>
                          <th style="width: 100px;"> </th> 
                        </tr>
                      </thead>
                      <tbody>

                        @foreach ($items as $item)
                            <tr>
                                <td> <a href="{{ route('order',$item) }}">
                                <i class="fa fa-eye"></i> AZ-{{ $item->id }} </a> </td>

                                <td>                                     
                                    {{ $item->region ? $item->region['name_'.my_lang()] : '' }} -
                                    {{ $item->city ? $item->city['name_'.my_lang()] : '' }} 
                                </td>

                                <td> {{ $item->street }} - {{ $item->address }} </td>

                                <td> {{ $item->notes ? $item->notes : '-' }} </td>

                                <td> {{ $item->order->total }} @lang('site.rs') </td>

                                <td> {{  __('site.'.$item->status) }} </td>

                                <td> {{ $item->created_at }} </td>

                                <td class="list-icons"> 
                                    @if($item->status == 'pending') 
                                <li> <a class="btn-success btn-xs" href="{{ route('order',$item) }}">
                                        <i class="fa fa-check"></i> @lang('site.accept_reject') </a> </li>                                    
                                    @endif    
                                </td>
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