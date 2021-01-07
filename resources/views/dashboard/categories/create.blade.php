<div class="modal fade add_item" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel2"> @lang('site.add_category') </h4>
            </div>
            <div class="modal-body">
               
                <form class="form-horizontal form-label-left" action="{{ route('admin.category.store') }}" method="post" 
                    enctype="multipart/form-data">
                    @csrf
                  
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name_ar"> @lang('site.name_ar') </label>
            
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" class="form-control" name="name_ar" />
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name_en"> @lang('site.name_en') </label>
            
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" class="form-control" name="name_en" />
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name_hi"> @lang('site.name_hi') </label>
            
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" class="form-control" name="name_hi" />
                        </div>
                    </div>
            
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="active"> @lang('site.active') </label>
            
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
 