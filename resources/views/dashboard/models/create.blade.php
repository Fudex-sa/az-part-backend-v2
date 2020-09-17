<div class="modal fade add_item" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel2"> @lang('site.add_model') </h4>
            </div>
            <div class="modal-body">
               
                <form class="form-horizontal form-label-left" action="{{ route('admin.model.store') }}" 
                method="post" enctype="multipart/form-data" novalidate>
                    @csrf
                
                    <input type="hidden" value="{{ LaravelLocalization::getCurrentLocale() }}" name="lang" />
                    
                    <input type="hidden" name="brand_id" value="{{$brand->id}}"/>
 

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="brand_name"> @lang('site.name') <span
                                class="required">*</span>
                        </label>
            
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="name" class="form-control col-md-7 col-xs-12" required 
                            value="{{ old('name') }}" />
                        </div>
                    </div>                    
                
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                            <button type="button" class="btn btn-default" data-dismiss="modal"> @lang('site.close') </button>
                            <button type="submit" class="btn btn-primary"> @lang('site.send')  </button>
                        </div>
                    </div>
            
                </form>


            </div>
           

        </div>
    </div>
</div>
 