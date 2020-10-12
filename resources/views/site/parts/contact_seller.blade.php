 
 
 <!-- Modal -->
 <div class="modal fade" id="contact_seller" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
 aria-hidden="true">
 <div class="modal-dialog modal-xl" role="document">
   <div class="modal-content">

     <div class="modal-body modal-padding">
       <div class="head-section mb-5">
         <h2> @lang('site.enter_required_pieces') </h2>
       </div>

      <form class="col-md-12 pop-margin" method="POST" action="{{ route('contact_seller') }}">
       @csrf
       
       <input type="hidden" name="item_id" class="item_id" />

         <div class="form-group row">

           <div class="col-md-4">
             <select name="piece_alt" class="form-control select2">
                <option value=""> @lang('site.choose_piece') </option>
                  @foreach ($piece_alts as $piece_alt)
                    <option value="{{ $piece_alt->id }}"> {{ $piece_alt['name_'.my_lang()] }} </option>     
                  @endforeach
             </select>
           </div>

         <div class="form-group col-md-3">
           <input type="text" class="form-control" name="price"  placeholder="@lang('site.price')"> @lang('site.rs')
         </div>

         <div class="form-group col-md-5">
           <input type="text" class="form-control" name="guarantee"  placeholder="@lang('site.guarantee')">
         </div>

          
         <div class="head-section col-md-12">
           <h2> @lang('site.shipping_address')  </h2>
         </div>

         <div class="form-group col-md-4">

            <select class="form-control" name="country_id" id="country_id">
              <option value=""> @lang('site.choose_country') </option>
              @foreach (countries() as $country)
                  <option value="{{ $country->id }}"> {{ $country['name_'.my_lang()] }} </option>    
              @endforeach
          </select>

         </div>
         
         <div class="form-group col-md-4">
            <select class="form-control" name="region_id" id="region_id">
              <option value=""> @lang('site.choose_region') </option>                 
            </select>
         </div>

         <div class="form-group col-md-4">
          <select class="form-control" name="city_id" id="cities">
            <option value=""> @lang('site.choose_city') </option>                 
          </select>
        </div>

         <div class="form-group col-md-12">
           <input type="text" class="form-control add-bg" name="street" placeholder="@lang('site.building_number')">
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
         <div class="custom-file custom-2">
           <input type="file" class="custom-file-input" id="customFile">
           <label class="custom-file-label" for="customFile"> اضف قطعة اخرى</label>
         </div>
       
         <button type="submit" class="btn btn-next btn-block btn-lg"> @lang('site.send') </button>
       </form>

     </div>
  
   </div>
 </div>
</div>