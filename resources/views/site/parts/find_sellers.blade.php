
@extends('site.app')

@section('title') @lang('site.search_piece') @endsection

@section('styles')
    
    <link href="{{asset('templates/maps/style.css')}}" type="text/css" rel="stylesheet">
    
@endsection

@section('content')

<section class="manual-search">
    <div class="container">
      <div class="row">
        @include('layouts.breadcrumb')

        <div class="col-md-12 my-3">
          <div class="head-section">
            <h2> @lang('site.this_is_your_search_result') </h2>
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
                                </h6>
                                <p> @lang('site.search_keyword') 
                                    <span> {{ $item->brand['name_'.my_lang()] }}
                                        - {{ $item->model['name_'.my_lang()] }}
                                        - {{ request()->year }}  </span></p>
                            </div>
                        </div>

                        <div class="col-md-3">
                        <div class="e-end">
                            <h6><img src="{{ site('assets/images/phone.png') }}" alt="" class="ml-3"> 
                                {{ $item->seller['mobile'] .' - '. $item->seller['phone'] }} 
                            
                            <a href="https://wa.me/{{ $item->seller['mobile'] }}" target="_blank"> 
                                <img src="{{ site('assets/images/whatsapp-green.png') }}" width="25"/> 
                            </a>
                            </h6>

                        </div>
                 
                        <button type="button" class="btn btn-whatsapp  btn-block btnContact" data-toggle="modal" 
                            data-target="#contact_seller" data-item="{{ $item->id }}"> @lang('site.or_contact_seller')
                        </button>

                        </div>
                    </div>
                    </div>
             
            @endforeach
        @else

        <div class="col-md-12">
            <div class="advice text-center">
              <p> @lang('site.search_found_no_result') </p>
              <a href="#" class="btn btn-results"> @lang('site.request_From_another_city') </a>
            </div>
          </div>
        
        @endif


        <div class="col-md-12">
          <div class="advice text-center">
            <p> {{ notification('contact_seller_hint') }} </p>
            <a href="#" class="btn btn-results">الحصول على المزيد من النتائج</a>
          </div>
        </div>

      </div>

    </div>
  </section>


@endsection

@section('popup')
    @include('site.parts.contact_seller')

@endsection

@section('scripts')

@include('dashboard.ajax.load_regions') 
@include('dashboard.ajax.load_cities')

    <script>
       
       $('#contact_seller').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var item_id = button.data('item');
            
            var modal = $(this);
            modal.find('.item_id').val(item_id);
        });

        
    </script>

<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

<script src="{{ site('assets/js/select2.js') }}"></script>


<script src="{{site('maps/script.js')}}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDBr8fHyX4CFO0PMq4dxJlhPH8RrjXfyN8&libraries=places&callback=initAutocomplete"
async defer></script>

<script src="{{ site('assets/js/bootstrap-input-spinner.js') }}"></script>
<script>
  $("input[type='number']").inputSpinner()
</script>
@endsection