
@extends('site.app')

@section('title') @lang('site.search_piece') @endsection

@section('styles')
    
    
@endsection

@section('content')

<section class="manual-search">
    <div class="container">
      <div class="row">
        @include('layouts.breadcrumb')

        <div class="col-md-12 my-3">
          <div class="head-section">
            <h2>
              @if($found_result == 1) @lang('site.this_is_your_search_result')
              
              @elseif($found_result == 2) @lang('site.search_found_in_other_cities') 

              @elseif($found_result == 3) @lang('site.please_subscribe_package_first') 

              @else @lang('site.not_found') @endif
            </h2>

            <div class="results">
              <h6>  @lang('site.result_no_in_this_city') :   
                    <span class="text-dark"> {{ count($city_items) }}  @lang('site.result')  </span> 
              </h6>

              <h6>  @lang('site.result_no_in_this_region') :   
                <span class="text-dark"> {{ count($region_items) }}  @lang('site.result')  </span> 
              </h6>

              <div class="advice">
                  <p>  {{ data('for_viewing_all_subscribe_first') }}   </p>
              </div>

            </div>

          </div>
        </div>

        @if($items)
            @foreach ($items as $item)
                 
                    <div class="col-md-12  mt-5">
                    <div class="row shadow e-back">
                        <div class="col-md-2 pr-0">
                            @if($item->seller['photo'])
                                <img src="{{ img_path($item->seller['photo']) }}" alt="" class="img-fluid e-m-image">
                            @else
                                <img src="{{ site('assets/images/logo.png') }}" alt="" class="img-fluid e-m-image">
                            @endif
                        </div>
                        <div class="col-md-7">
                            <div class="e-box">
                                <h4> {{ $item->seller['name'] }} </h4>
                                <h6>                                  
                                    <a href="https://maps.google.com/?q={{$item->seller['lat']}},{{$item->seller['lng']}}" target="_blank"> 
                                        <img src="{{ site('assets/images/location.png') }}" alt="">  {{ $item->seller['address'] }}
                                    </a>

                                    {{ $item->seller->region['name_'.my_lang()] }} - 
                                    {{ $item->seller->city['name_'.my_lang()] }}
                                </h6>
                                <p> @lang('site.search_keyword') 
                                    <span> {{ $item->brand['name_'.my_lang()] }}
                                        - {{ $item->model['name_'.my_lang()] }}
                                        - {{ request()->year }}  </span></p>
                            </div>
                        </div>

                        <div class="col-md-3">
                        <div class="e-end">
                            <h6>
                              <a href="tel:{{ $item->seller['mobile'] }}" class="btn btn-whatsapp" >
                                  <img src="{{ site('assets/images/phone.png') }}" alt="" class="ml-3"> 
                                  @lang('site.call_seller')
                              </a>

                              <a href="https://wa.me/{{ $item->seller['mobile'] }}" target="_blank"> 
                                  <img src="{{ site('assets/images/whatsapp-green.png') }}" width="25"/> 
                              </a>
                            </h6>

                        </div>
                  
                      <button class="btnContact btn btn-block btn-whatsapp" data-toggle="modal" data-target="#contact_seller" 
                      data-item="{{ $item->seller['id'] }}"> @lang('site.complete_order') </button>

                      <a class="btn btn-block"  href="{{ route('report',$item->seller['id']) }}" target="_blank"> @lang('site.report') </a>

                        </div>
                    </div>
                    </div>
             
            @endforeach
        @else

        <div class="col-md-12">
            <div class="advice text-center">
              {{-- <p> @lang('site.search_found_no_result') </p> --}}
              {{-- <a href="#" class="btn btn-results"> @lang('site.request_From_another_city') </a> --}}
            </div>
          </div>
        
        @endif


        <div class="col-md-12">
          <div class="advice text-center">
            <p> {{ notification('contact_seller_hint') }} </p>
 
            <a href="{{ route('package.show',request()->search_type) }}" class="btn btn-results"> @lang('site.get_more_results') </a>
  
          </div>
        </div>

      </div>

    </div>
  </section>


@endsection

@section('popup')
    
    @include('site.parts.add_to_cart')
    
@endsection


@section('scripts')
 
@include('dashboard.ajax.load_regions') 
@include('dashboard.ajax.load_cities')

    <script>
       
       $('#contact_seller').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var seller_id = button.data('item');
            
            var modal = $(this);
            modal.find('.seller_id').val(seller_id);
        });

        
    </script>

<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

<script src="{{ site('assets/js/select2.js') }}"></script>


<script src="{{ site('assets/js/bootstrap-input-spinner.js') }}"></script>
<script>
  $("input[type='number']").inputSpinner();
  
  function addNewPiece(){
        $.get("{{ route('more_pieces') }}", function(data){
            $("#more_pieces").append(data);
        });
    };
</script>
@endsection