 
  
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
 
         <button type="submit" class="btn btn-next btn-block btn-lg"> @lang('site.send') </button>
       </form>

     </div>
  
   </div>
 </div>
</div>