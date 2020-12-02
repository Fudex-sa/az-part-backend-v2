
@extends('site.app')

@section('title') @lang('site.manaul_search') @endsection

@section('styles')
    
    
@endsection

@section('content')

<section class="manual-search">
    <div class="container">
      <div class="row">
        @include('layouts.breadcrumb')

        <div class="col-md-12 my-3">
          <div class="head-section">
            <h2> @lang('site.this_is_your_search_result') </h2>

            <div class="results">
              <h6>  @lang('site.result_no_in_this_city') : 
                    <span class="text-dark"> {{ $all_items ? count($all_items) : 0 }}  @lang('site.result')  </span> 
              </h6>
  
             
              <div class="text-center advice">
                           
                  <p>  {{ data('for_more_stores') }} 
                    <a href="javascript:void(0);" data-toggle="modal" data-target="#other_cities">
                       @lang('site.in_other_cities') </a>
                  </p>
              </div>
             

            </div>

          </div>
        </div>

        @if(count($items) > 0)
            @foreach ($items as $item)
                 
                    <div class="col-md-12">
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
                                <h6 class="orang">                                  
                                    <a href="https://maps.google.com/?q={{$item->seller['lat']}},{{$item->seller['lng']}}" target="_blank"> 
                                        <img src="{{ site('assets/images/location.png') }}" alt="">  {{ $item->seller['address'] }}
                                    </a>

                                    {{ $item->seller->region ? $item->seller->region['name_'.my_lang()] : '' }} - 
                                    {{ $item->seller->city ? $item->seller->city['name_'.my_lang()] : '' }}
                                </h6>

                                <h6> 
                                    <img class="ml-3" src="{{ site('assets/images/phone.png') }}" />
                                    {{ $item->seller->mobile }}  {{ $item->seller->phone ? ' - ' .$item->seller->phone : '' }}
                                </h6>
                                
                                <p> @lang('site.search_keyword') 
                                    <span> {{ $item->brand['name_'.my_lang()] }}
                                        - {{ $item->model['name_'.my_lang()] }}
                                        - {{ request()->year }}  </span></p>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="e-end row">
                                <div class="col-md-8">
                                    <a href="tel:{{ $item->seller['mobile'] }}" class="btn btn-whatsapp  btn-block">
                                        <img src="{{ site('assets/images/phone.png') }}" alt="" class="ml-3"> 
                                        @lang('site.call_seller')
                                    </a>
                                </div>

                               <div class="col-md-4">
                                    <a href="https://wa.me/{{ $item->seller['mobile'] }}" target="_blank" class="btn btn-whatsapp  btn-block"> 
                                        <img src="{{ site('assets/images/w-2.png') }}" /> 
                                    </a>
                                </div>
 
                                <div class="col-md-12">
                                  <button class="btn btn-whatsapp btn-block btn-lory" data-toggle="modal" data-target="#contact_seller" 
                                  data-item="{{ $item->seller['id'] }}"> @lang('site.complete_order') </button>

                                  <a class="btn btn-block"  href="{{ route('report',$item->seller['id']) }}" target="_blank">
                                     @lang('site.report') </a>

                                </div>
                            </div>

                        </div>
                    </div>
                    </div>
             
            @endforeach
        @else
 
        
        @endif

        <div class="col-md-12">
          <div class="advice text-center">
            @if($items && count($items) > 0)
            <p> {{ notification('contact_seller_hint') }} </p> @endif
 
            @if(if_subscribe(request()->search_type) == 0)
                <a href="{{ route('package.show',request()->search_type) }}" class="btn btn-results"> @lang('site.get_more_results') </a>
            @endif

          </div>
        </div>

      </div>

    </div>
  </section>

   
    @include('site.parts.other_cities')
 
@endsection

@section('popup')
    
    @include('site.parts.add_to_cart')
    
@endsection


@section('scripts')
 
@include('dashboard.ajax.load_regions') 
@include('dashboard.ajax.load_cities')

@if($found_result == 0)
<script>
GrowlNotification.notify({
    title: "{{__('site.failed')}}",
    description: " {{ __('site.not_found_result_in_your_city') }} ",
    zIndex: 1056,
    'type' : 'error'
  });
</script>
@endif


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