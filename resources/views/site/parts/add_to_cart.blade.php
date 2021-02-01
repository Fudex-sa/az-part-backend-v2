 
  
 <div class="modal fade" id="contact_seller" tabindex="-1" role="dialog">

 <div class="modal-dialog modal-xl" role="document">
   <div class="modal-content">

     <div class="modal-body modal-padding">
       <div class="head-section mb-5">
         <h2> @lang('site.enter_required_pieces') </h2>

         <p class="required"> {{ data('agreed_prices_with_seller') }} </p>

         <div class="text-left">
          <a onclick="addNewPiece()" href="javascript:void(0);">
               @lang('site.add_piece') <i class="fa fa-plus"></i> </a>
          </div>
       </div>
       

      <form class="col-md-12 pop-margin" method="POST" action="{{ route('addToCart') }}" enctype="multipart/form-data">
       @csrf
       
        <input type="hidden" name="seller_id" class="seller_id" />

        <input type="hidden" name="brand_id" value="{{ request()->brand }}" />
        <input type="hidden" name="model_id" value="{{ request()->model }}" />
        <input type="hidden" name="year" value="{{ request()->year }}" />
        <input type="hidden" name="country_id" value="{{ request()->country }}" />
        <input type="hidden" name="region_id" value="{{ request()->region }}" />
        <input type="hidden" name="city_id" value="{{ request()->city }}" />
        <input type="hidden" name="type" value="{{ request()->search_type }}" />
        

         <div class="form-group row">

           <div class="col-md-4">
            <label> @lang('site.piece_name') </label>

             <select name="piece_alt_id[]" class="form-control select2" required>
                <option value=""> @lang('site.choose_piece') </option>
                  @foreach ($piece_alts as $piece_alt)
                    <option value="{{ $piece_alt->id }}"> {{ $piece_alt['name_'.my_lang()] }} </option>     
                  @endforeach
             </select>
           </div>

           <div class="form-group col-md-4">
            <label> @lang('site.qty') </label>
        
            <input type="number" class="form-control" name="qty[]" min="1" value="1" placeholder="@lang('site.qty')">
          </div>

         <div class="form-group col-md-4">
          <label> @lang('site.price') <span class="required"> (@lang('site.single_piece_price')) </span> </label>

           <input type="number" min="1" class="form-control" name="price[]"  required
              placeholder="@lang('site.price')"> @lang('site.rs')
         </div>

         <div class="form-group col-md-4">
          <label> @lang('site.guarantee') </label>

           <input type="text" class="form-control" name="guarantee[]"  placeholder="@lang('site.guarantee')"
           maxlength="20">
         </div>
        
         <div class="form-group col-md-4">
          <label> @lang('site.color') </label>

          <input type="text" class="form-control" name="color[]"  placeholder="@lang('site.color')"
              maxlength="20">
        </div>

        <div class="form-group col-md-4">
          <label> @lang('site.piece_image') </label>

          <input type="file" class="form-control" name="photo[]">
        </div>
        
        <div class="form-group col-md-12">
          <label> @lang('site.notes') </label>

          <input type="text" class="form-control" name="notes[]"  placeholder="@lang('site.notes')"
            maxlength="400">
        </div>
 
        <div id="more_pieces" class="row"> </div>

         <button type="submit" class="btn btn-next btn-block btn-lg"> @lang('site.add_to_cart') </button>
       </form>

     </div>
  
   </div>
 </div>
</div>


 