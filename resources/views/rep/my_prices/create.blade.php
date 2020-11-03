<div class="modal fade add_item" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
              <div class="col-md-11">
                <h4 class="modal-title" id="myModalLabel2"> @lang('site.add_city_price') </h4>
              </div>

              <div class="col-md-1">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                  aria-hidden="true">×</span>
                </button>
              </div>
            </div>

            <div class="modal-body">
            <form class="row" method="post" action="{{ route('rep.my_price.store') }}">
                @csrf 
                
                <div class="form-group col-6">         
                  <label>  @lang('site.tashlih_region') </label>

                  <select name="_from" id="_from" class="form-control">
                    <option value=""> @lang('site.choose_tashlih_region') </option>
                    
                    @foreach ($delivery_regions as $delivery_region)
                        <option value="{{ $delivery_region->id }}">
                           {{ $delivery_region['name_'.my_lang()] }} </option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group col-6">   </div>

                <div class="form-group col-6">    
                  <label>  @lang('site.country') </label>

                  <select name="country_id" id="country_id" class="form-control">
                    <option value=""> @lang('site.choose_country') </option>
                    
                    @foreach (countries() as $country)
                        <option value="{{ $country->id }}"> {{ $country['name_'.my_lang()] }} </option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group col-6">
                  <label>  @lang('site.region') </label>

                  <select name="region_id" id="region_id" class="form-control">
                    <option value=""> @lang('site.choose_region') </option>
                     
                </select>
                </div>
                
                <div class="form-group col-6">
                  <label>  @lang('site.city') </label>

                  <select id="cities" name="city_id" class="form-control">
               
                  </select>
                </div>

                <div class="form-group col-6">
                  <label>  @lang('site.price') </label>
                  <input type="number" name="price" min="0" class="form-control" placeholder="@lang('site.price')"/>
                </div>

                <div class="form-group col-12">
                  <label> @lang('site.car_size') </label>

                  <div class="col-md-6">
                    <label> <input type="checkbox" value="light" name="car_size[]" /> @lang('site.light') </label>
                    <label> <input type="checkbox" value="medium" name="car_size[]" /> @lang('site.medium') </label>
                    <label> <input type="checkbox" value="heavy" name="car_size[]" /> @lang('site.heavy') </label>
                  </div>
                </div>
                
                    <button type="submit" class="btn btn-dropform btn-block btn-lg mt-2"> @lang('site.save') </button>
                </form>


            </div>
        </div>
    </div>
</div>
