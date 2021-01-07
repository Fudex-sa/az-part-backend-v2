<div class="modal fade add_item" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
      <div class="modal-content">

          <div class="modal-header">
            <div class="col-md-11">
              <h4 class="modal-title" id="myModalLabel2"> @lang('site.add_category') </h4>
            </div>

            <div class="col-md-1">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                aria-hidden="true">×</span>
              </button>
            </div>
          </div>

          <div class="modal-body">
          <form class="row" method="post" action="{{ route('seller.my_category.store') }}">
              @csrf 
              
              <div class="form-group col-6">         
                <label class="blue">  @lang('site.category') </label>

                <select name="category_id" id="category_id" class="form-control">
                  <option value=""> @lang('site.choose_category') </option>
                  <option value="0"> @lang('site.all') </option>
                  @foreach ($categories as $category)
                      <option value="{{ $category->id }}">
                         {{ $category['name_'.my_lang()] }} </option>
                  @endforeach
                </select>
              </div>

               
              
                  <button type="submit" class="btn btn-dropform btn-block btn-lg mt-2"> @lang('site.save') </button>
              </form>


          </div>
      </div>
  </div>
</div>
