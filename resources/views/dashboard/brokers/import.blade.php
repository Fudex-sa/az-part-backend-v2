<div class="modal fade add_item" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel2"> @lang('site.import_brokers') </h4>
            </div>
            <div class="modal-body">

                <form class="form-horizontal form-label-left" action="{{ route('admin.brokers.import') }}" method="post" enctype="multipart/form-data">
                    @csrf
 
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name_ar">@lang('site.choose_file')<span
                                class="required">*</span>
                        </label>

                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="file" name="file" required />
                        </div>
                    </div>
 
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                            <button type="button" class="btn btn-default" data-dismiss="modal"> @lang('site.close') </button>
                            <button type="submit" class="btn btn-primary"> @lang('site.import')  </button>
                        </div>
                    </div>

                </form>


            </div>


        </div>
    </div>
</div>
