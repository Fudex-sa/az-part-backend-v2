
@extends('site.app')

@section('title') @lang('site.my_packages') @endsection

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
                        <th scope="col"> @lang('site.package_name') </th>
                        <th scope="col"> @lang('site.package_type') </th>
                        <th scope="col"> @lang('site.stores_no_or_requests_no') </th>
                        <th scope="col"> @lang('site.discount') </th>
                        <th scope="col"> @lang('site.price') </th>
                        <th scope="col"> @lang('site.expired') </th>
                        <th scope="col"> @lang('site.order_no') </th>
                        <th scope="col"> @lang('site.subscribe_date') </th>
                      </tr>
                    </thead>
                    <tbody>
                        
                        @foreach ($items as $item)
                        <tr>
                            <td> {{ $item->package['title_'.my_lang()] }} </td>
                            
                            <td> {{ __('site.'.$item->package['type']) }} </td>

                            <td> {{ $item->stores_no }} 
                                {{ $item->package['type'] == 'manual' ? __('site.store') : __('site.request') }} 
                            </td>

                            <td> {{ $item->package['discount'] }} % </td>

                            <td> {{ $item->price }} @lang('site.rs') </td>

                            <td> {{ $item->expired == 1 ? __('site.yes') : __('site.no') }} </td>

                            <td> {{ $item->order_id ? $item->order_id : '-' }} </td>

                            <td> {{ $item->created_at }} </td>
                          </tr>     
                        @endforeach
                       
                    </tbody>
                  </table>
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