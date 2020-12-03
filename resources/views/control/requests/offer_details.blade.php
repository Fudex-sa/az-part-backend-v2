
<div class="modal fade" id="view_details{{ $offer->id }}" tabindex="-1" role="dialog"
aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">

    <div class="modal-body p-5">
      <div class="row">
        <div class="col-md-12 ">
          <h3 class="mb-5"> @lang('site.offer_details_no') {{ $offer->id }} </h3>
        </div>
 
        <div class="col-md-12">
          <div class="row">
            <div class="col-md-2">
              <img src="{{ cart_img($seller->request->photo) }}" alt="" class="img-fluid">
            </div>

            <div class="col-md-8">
              <div class="model-xx mt-2">
                <h6>  {{ $item->brand ? $item->brand['name_'.my_lang()] : '' }}-
                    {{ $item->model ? $item->model['name_'.my_lang()] : '' }}-
                    {{ $item->year }}
                </h6>
                <h6>  {{ $item->piece_alt['name_'.my_lang()] }}  </h6>
              </div>
            </div>

            <div class="col-md-2">
              <div class="pri-pop mt-2">
                <h6> @lang('site.price') </h6>
                <h6> {{ $offer->price }} @lang('site.rs') </h6>
              </div>
            </div>
          </div>
        </div>


        <div class="col-md-12">
          <div class="cli-nots mt-3 border rounded p-3">
            <h6><span class="noti">  @lang('site.notes') </span></h6>
            <h6> {{ $item->notes ? $item->notes : '-' }} </h6>
          </div>

        </div>
        <div class="col-md-12 ">
          <div class="border rounded mt-3 pt-3 pr-3 pb-1">
            <div class="row ">
              <div class="col-md-4">
                <div class="back-back">
                  <h4> @lang('site.composition') : 
                    <span> {{ $offer->composition == 1 ? __('site.yes') : __('site.no') }}  </span></h4>
                </div>
              </div>

              <div class="col-md-4">
                <div class="back-back">
                  <h4> @lang('site.return_possibility') :
                    <span> {{ $offer->return_possibility == 1 ? __('site.yes') : __('site.no') }} </span></h4>
                </div>
              </div>

              <div class="col-md-4">
                <div class="back-back">
                  <h4> @lang('site.delivery_possibility') :
                    <span> {{ $offer->delivery_possibility == 1 ? __('site.yes') : __('site.no') }} </span></h4>
                </div>
              </div>

            </div>
          </div>
     
          <div class="border rounded mt-3 pt-3 pr-3 pb-1">
            <div class="row ">
              
              <div class="col-md-12">
                <div class="back-back">
                  <h4> @lang('site.guarantee') :
                    <span> {{ $offer->guarantee }} </span></h4>
                </div>
              </div>

            </div>
          </div>

          <div class="border rounded mt-3 pt-3 pr-3 pb-1">
            <div class="row ">
              
              <div class="col-md-12">
                <div class="back-back">
                  <h4> @lang('site.seller_notes') :
                    <span> {{ $offer->notes }} </span></h4>
                </div>
              </div>

            </div>
          </div>


        </div>
        <div class="col-md-12">
          <div class="row mt-5">
            <div class="col-md-8">
              <div class="map-info-xz">
                <h3 class="mt-3 cli-name"> {{ $offer->seller->name }} </h3>
                <h5 class="mt-3"> 
                  <a href="https://maps.google.com/?q={{$offer->seller->lat}},{{$offer->seller->lng}}" 
                    class="padiaa" target="_blank">
                <img src="{{ site('assets/images/location.png') }}" alt=""> 
                {{ $item->country ? $item->country['name_'.my_lang()] : '' }} -
                {{ $item->region ? $item->region['name_'.my_lang()] : '' }} -
                {{ $item->city ? $item->city['name_'.my_lang()] : '' }} </a>
                    <br/>
                    &nbsp; &nbsp;@if($offer->seller->address) ({{ $offer->seller->address }}) @endif
              </h5>

                <h5 class="mt-3">
                   <img src="{{ site('assets/images/phone.png') }}" alt="">
                     {{ $offer->seller->mobile }} {{ $offer->seller->phone ? ' - '. $offer->seller->phone : '' }}
                     - 
                     {{-- <img src="{{ site('assets/images/whatsapp.png') }}" alt=""> --}}
                     
                     <a href="https://wa.me/{{ $offer->seller ? $offer->seller->mobile : '' }}" target="_blank" 
                      class="btn-success btn-whats"> <img src="{{ site('assets/images/whatsapp.png') }}" /> 
                     </a>
                </h5>
              </div>
            </div>
            <div class="col-md-4">  
              @if($offer->seller->photo)           
                  <img src="{{ img_path($offer->seller->photo) }}" alt="" class="img-fluid">                            
              @endif
            </div>
          </div>
        </div>
        <div class="col-md-12">
            <a href="{{ route('offer.add_to_cart',$offer->id) }}" class="btn  btn-save btn-block mt-5"> @lang('site.add_to_cart') </a>
        </div>
      </div>
    </div>

  </div>
</div>
</div>