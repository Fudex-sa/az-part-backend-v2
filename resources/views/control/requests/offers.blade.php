
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
                  <th> @lang('site.price') </th>
                  <th> @lang('site.details') </th>                  
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
 
                      <td>
                        @if($seller->price)
                            {{ $seller->price }}  @lang('site.rs') 
                        @else
                            <span class="btn status-{{ $seller->status_id }}"> 
                              {{ $seller->status['name_'.my_lang()] }} </span>
                        @endif
                      </td>
 
                      <td> @if($seller->price) 
                      <button class="btn add-to" data-toggle="modal" data-target="#view_details{{ $seller->id }}" 
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
                          <span class="fa fa-star {{ $seller->seller->rating > 0 ? 'checked' : 'notchecked'}}" onclick="rate(1,{{ $seller->id }})"></span>
                          <span class="fa fa-star {{ $seller->seller->rating > 4 ? 'checked' : 'notchecked'}}" onclick="rate(2,{{ $seller->id }})"></span>
                          <span class="fa fa-star {{ $seller->seller->rating > 10 ? 'checked' : 'notchecked'}}" onclick="rate(3,{{ $seller->id }})"></span>
                          <span class="fa fa-star {{ $seller->seller->rating > 15 ? 'checked' : 'notchecked'}}" onclick="rate(4,{{ $seller->id }})"></span>
                          <span class="fa fa-star {{ $seller->seller->rating > 20 ? 'checked' : 'notchecked'}}" onclick="rate(5,{{ $seller->id }})"></span>
                          ({{ $seller->seller->rating }})
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
    @foreach ($item->assign_sellers_replied as $k=>$offer)
        @include('control.requests.offer_details',['offer'=> $offer ])
    @endforeach
@endif

@endsection

@section('scripts')
{{-- <script>
       
  $('#view_details').on('show.bs.modal', function (event) {
       var button = $(event.relatedTarget);
       var seller = button.data('item');
        
       var modal = $(this);
       modal.find('.offer_id').val(seller);
   });
  
</script> --}}

@include('dashboard.ajax.rate') 

  

@endsection


 