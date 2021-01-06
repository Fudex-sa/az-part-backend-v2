
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

          <div class="col-lg-9 col-md-9  col-12" style="margin-top: -65px;">
         
            <div class="btn-add-container">
            <a href="{{ route('package.show','electronic') }}" class="btn btn-save"> @lang('site.subscribe_package') </a>
              <br/><br/>
            </div>
            
            <div class="table-responsive">
 
                  <table class="my-tbl text-center">
                    <thead>
                      <tr>
                        <th scope="col"> @lang('site.package_name') </th>
                        <th scope="col"> @lang('site.package_type') </th>
                        <th scope="col"> @lang('site.stores_no_or_requests_no') </th>
                        <th scope="col"> @lang('site.discount') </th>
                        <th scope="col"> @lang('site.price') </th>
                        {{-- <th scope="col"> @lang('site.expired') </th> --}}
                        <th scope="col"> @lang('site.my_rest_orders') </th>
                        <th scope="col"> @lang('site.subscribe_date') </th>
                      </tr>
                    </thead>
                    <tbody>
                        
                        @foreach ($items as $item)
                        <tr>
                            <td> {{ $item->package['title_'.my_lang()] }} </td>
                            
                            <td> 
                              @if($item->package['type'] == 'manual') <i class="fa fa-user"></i>
                              @else  <i class="fa fa-cogs"></i> @endif

                              {{ __('site.'.$item->package['type']) }} </td>

                            <td> {{ $item->stores_no }} 
                                {{ $item->package['type'] == 'manual' ? __('site.store') : __('site.request') }} 
                            </td>

                            <td> {{ $item->package['discount'] }} % </td>

                            <td> {{ $item->price }} @lang('site.rs') </td>

                            {{-- <td> {{ $item->expired == 1 ? __('site.yes') : __('site.no') }} </td> --}}

                            <td> @if($item->package['type'] == 'electronic')
                                   {{ $item->stores_no - count($item->my_orders)  }} @lang('site.order')
                                 @else {{ logged_user()->remaining_stores }} @endif      
                            </td>

                            <td> {{ date('Y-m-d',strtotime($item->created_at)) }} </td>
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