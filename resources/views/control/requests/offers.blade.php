
@extends('site.app')

@section('title') 
  @lang('site.request_offers') {{ $item->id }} : 
  {{ $item->piece_alt ? $item->piece_alt['name_'.my_lang()] : '' }}

@endsection

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
           

            <div class="row">
              <table class="table my-tbl text-center">
                <thead>
                  <th> # </th>
                  <th> <i class="fa fa-camera"></i> </th>
                  <th> @lang('site.seller') </th>
                  <th> @lang('site.seller_type') </th>
                  <th> @lang('site.vip') </th>
                  <th> @lang('site.price') </th>
                  <th> @lang('site.details') </th>
                  {{-- <th> @lang('site.add_to_cart') </th> --}}
                  <th> @lang('site.rate') </th>
                </thead>

                <tbody>
                  
                  @foreach ($item->assign_sellers_replied as $k=>$seller)
                    <tr>
                      <td> {{ $k+1 }} </td>
                      
                      <td> 
                        @if($seller->seller->photo)
                        <img src="{{ img_path($seller->seller->photo) }}" alt="" class="img-user">
                      @else <img src="{{ site('assets/images/logo.png') }}" alt="" class="img-user"> @endif
                      </td>

                      <td>
                         {{ $seller->price ? $seller->seller->name : 'S'.$seller->seller->id }} </a>
                      </td>

                      <td> <label class="label label-{{ $seller->seller->user_type }}"> 
                            {{ __('site.'.$seller->seller->user_type) }} </label> </td>

                      <td> @if($seller->seller->vip == 1) 
                              <span class="success"> <i class="fa fa-check"></i> @lang('site.yes') </span>
                          @else<span class="false"> <i class="fa fa-times"></i> @lang('site.no') </span>  @endif
                      </td>

                      <td>
                        @if($seller->price)
                            {{ $seller->price }}  @lang('site.rs') 
                        @else
                            <span class="btn status-{{ $seller->status_id }}"> 
                              {{ $seller->status['name_'.my_lang()] }} </span>
                        @endif
                      </td>
 
                      <td> @if($seller->price) 
                        <button class="btn add-to" data-toggle="modal" data-target="#view_details" 
                                  data-item="{{ $seller->id }}">
                                   <i class="fa fa-eye"></i> @lang('site.view') </button>
  
                        @else - @endif </td>

                      {{-- <td> 
                        @if($seller->price)
                          <a href="{{ route('offer.add_to_cart',$seller->id) }}" 
                            class="btn btn-client float-left"> @lang('site.add_to_cart') </a>                          
                        @else -  @endif
                      </td> --}}

                      <td>
                        <div class="rating-33">
                          <span class="fa fa-star checked"></span>
                          <span class="fa fa-star checked"></span>
                          <span class="fa fa-star checked"></span>
                          <span class="fa fa-star notchecked"></span>
                          <span class="fa fa-star notchecked"></span>
                        </div>  
                      </td>
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
  </div>
</section>


@endsection

@section('popup')
   
@if(count($item->assign_sellers_replied) > 0)
    @include('control.requests.offer_details')
@endif

@endsection

@section('scripts')
<script>
       
  $('#view_details').on('show.bs.modal', function (event) {
       var button = $(event.relatedTarget);
       var seller = button.data('item');
       
       var modal = $(this);
       modal.find('.seller').val(seller);
   });
    
</script>
  

@endsection


 