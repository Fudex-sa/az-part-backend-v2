<div class="modal fade add_item" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel2"> @lang('site.add') @lang('site.coupon') </h4>
            </div>
            <div class="modal-body">
               
                <form class="form-horizontal form-label-left" action="{{ route('admin.coupon.store') }}" method="post">
                    @csrf
                 
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="code"> @lang('site.code') <span
                                class="required">*</span>
                        </label>
            
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="code" class="form-control col-md-7 col-xs-12" required 
                        value="{{ old('code') }}" />
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="value"> @lang('site.value') <span
                                class="required">*</span>
                        </label>
            
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="number" min="1" name="value" class="form-control col-md-7 col-xs-12" required 
                        value="{{ old('value') }}" />
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="uses_number"> @lang('site.uses_number') <span
                                class="required">*</span>
                        </label>
            
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="number" min="1" name="uses_number" class="form-control col-md-7 col-xs-12" required 
                        value="{{ old('uses_number') }}" />
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="expiration_date"> @lang('site.expiration_date') 
                        </label>
            
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="date" name="expiration_date" class="form-control col-md-7 col-xs-12"  
                        value="{{ old('expiration_date') }}" />
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="active"> @lang('site.active') <span
                                class="required">*</span>
                        </label>
            
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label>
                                <input type="radio" class="flat" name="active" value="1"  
                                {{ old('active') == 1 ? 'checked' : '' }} required/> @lang('site.yes')
                            </label>

                            <label>
                                <input type="radio" class="flat" name="active" value="0"  
                                {{ old('active') == 0 ? 'checked' : '' }} required/> @lang('site.no')
                            </label>

                        </div>
                    </div>

                     
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                            <button type="button" class="btn btn-default" data-dismiss="modal"> @lang('site.close') </button>
                            <button type="submit" class="btn btn-primary"> @lang('site.save')  </button>
                        </div>
                    </div>
            
                </form>


            </div>
           

        </div>
    </div>
</div>
 