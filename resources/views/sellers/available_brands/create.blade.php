<div class="modal fade add_item" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel2"> @lang('site.add_brand') </h4>
            </div>
            <div class="modal-body">


            <form class="row" method="post" action="{{ route('seller.avaliable_model.store') }}">
                @csrf 
                  
                <div class="form-group col-6">
                  <label> @lang('site.brand') </label>

                  <select class="form-control select2 input-A" name="brand_id" id="brand_id">
                    <option value=""> @lang('site.choose_brand') </option>
                    @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}"
                          data-image="{{ brand_img($brand->logo) }}"  class="left"> {{ $brand['name_'.my_lang()] }} </option>    
                    @endforeach
                  </select>

                </div>

                <div class="form-group col-6">
                  <label> @lang('site.model') </label>

                  <select class="form-control select2 input-B" name="model_id" id="model_id">
                    <option value=""> @lang('site.choose_model') </option>
                
                </select>
                </div>
                
                <div class="form-group col-12">
                  <label> @lang('site.manufacturing_year') </label>
                  <br/>
                  
                  @for($i = date('Y')+1  ; $i >= 1970 ; $i--)                    
                    <label> 
                    <input type="checkbox" name="years[]" value="{{ $i }}"> {{ $i }}
                    </label>
                  @endfor
                </div>
                
                    <button type="submit" class="btn btn-dropform btn-block btn-lg mt-2"> @lang('site.next') </button>
                </form>


            </div>
        </div>
    </div>
</div>
