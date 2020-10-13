 
  
 <div class="modal fade" id="contact_seller" tabindex="-1" role="dialog">

 <div class="modal-dialog modal-xl" role="document">
   <div class="modal-content">

     <div class="modal-body modal-padding">
       <div class="head-section mb-5">
         <h2> @lang('site.enter_required_pieces') </h2>
       </div>
       

      <form class="col-md-12 pop-margin" method="POST" action="{{ route('contact_seller') }}">
       @csrf
       
        <input type="hidden" name="seller_id" class="item_id" />

        <input type="hidden" name="brand_id" value="{{ request()->brand }}" />
        <input type="hidden" name="model_id" value="{{ request()->model }}" />
        <input type="hidden" name="year" value="{{ request()->year }}" />
        <input type="hidden" name="country_id" value="{{ request()->country }}" />
        <input type="hidden" name="region_id" value="{{ request()->region }}" />
        <input type="hidden" name="city_id" value="{{ request()->city }}" />
        <input type="hidden" name="type" value="{{ request()->search_type }}" />
        

         <div class="form-group row">

           <div class="col-md-4">
             <select name="piece_alt_id" class="form-control select2">
                <option value=""> @lang('site.choose_piece') </option>
                  @foreach ($piece_alts as $piece_alt)
                    <option value="{{ $piece_alt->id }}"> {{ $piece_alt['name_'.my_lang()] }} </option>     
                  @endforeach
             </select>
           </div>

         <div class="form-group col-md-3">
           <input type="number" min="1" class="form-control" name="price"  placeholder="@lang('site.price')"> @lang('site.rs')
         </div>

         <div class="form-group col-md-5">
           <input type="text" class="form-control" name="guarantee"  placeholder="@lang('site.guarantee')">
         </div>

          
         <div class="head-section col-md-12">
           <h2> @lang('site.shipping_address')  </h2>
         </div>

         <div class="form-group col-md-4">

            <select class="form-control" name="shipping_country_id" id="country_id">
              <option value=""> @lang('site.choose_country') </option>
              @foreach (countries() as $country)
                  <option value="{{ $country->id }}"> {{ $country['name_'.my_lang()] }} </option>    
              @endforeach
          </select>

         </div>
         
         <div class="form-group col-md-4">
            <select class="form-control" name="shipping_region_id" id="region_id">
              <option value=""> @lang('site.choose_region') </option>                 
            </select>
         </div>

         <div class="form-group col-md-4">
          <select class="form-control" name="shipping_city_id" id="cities">
            <option value=""> @lang('site.choose_city') </option>                 
          </select>
        </div>

         <div class="form-group col-md-12">
           <input type="text" class="form-control" name="street" placeholder="@lang('site.building_number')">
         </div>

         <div class="form-group col-md-12">
            <input id="pac-input" class="form-control add-bg" name="address" type="text"
            placeholder="{{ __('site.find_address') }}" value="{{ old('address') }}">

            <div id="map" style="width:100%;height: 400px;"></div>
            <input type="hidden" name="latitude"  id="latitude" value="26.420031"/>
            <input type="hidden" name="longitude" id="longitude" value="50.089986"/>
         </div>

         <div class="form-group col-md-12">
           <textarea class="form-control" name="notes" rows="1" placeholder="@lang('site.another_notes')"></textarea>
         </div>

         {{-- <div class="custom-file custom-2">
           <input type="file" class="custom-file-input" id="customFile">
           <label class="custom-file-label" for="customFile"> اضف قطعة اخرى</label>
         </div> --}}
       
         <button type="submit" class="btn btn-next btn-block btn-lg"> @lang('site.send') </button>
       </form>

     </div>
  
   </div>
 </div>
</div>