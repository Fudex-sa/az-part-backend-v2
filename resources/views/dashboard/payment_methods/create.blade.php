<div class="modal fade add_item" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel2"> @lang('site.add_payment_method') </h4>
            </div>
            <div class="modal-body">
               
                <form class="form-horizontal form-label-left" action="{{ route('admin.payment_method.store') }}" method="post"
                enctype="multipart/form-data">
                    @csrf
                 
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="logo"> @lang('site.logo') </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="file" name="logo" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name_ar"> @lang('site.name_ar') <span
                                class="required">*</span>
                        </label>
            
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="name_ar" class="form-control col-md-7 col-xs-12" required 
                        value="{{ old('name_ar') }}" />
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name_en"> @lang('site.name_en') <span
                                class="required">*</span>
                        </label>
            
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="name_en" class="form-control col-md-7 col-xs-12"   
                        value="{{ old('name_en') }}" />
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name_hi"> @lang('site.name_hi') <span
                                class="required">*</span>
                        </label>
            
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="name_hi" class="form-control col-md-7 col-xs-12"   
                        value="{{ old('name_hi') }}" />
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sort"> @lang('site.sort') <span
                                class="required">*</span>
                        </label>
            
                        <div class="col-md-2 col-sm-6 col-xs-12">
                            <select name="sort" class="form-control">
                                @for($i = 0; $i <= 15 ; $i++)
                                    <option value="{{ $i }}"> {{ $i }} </option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description_ar"> @lang('site.description_ar') </label>
            
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <textarea name="description_ar" class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description_en"> @lang('site.description_en') </label>
            
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <textarea name="description_en" class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description_hi"> @lang('site.description_hi') </label>
            
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <textarea name="description_hi" class="form-control"></textarea>
                        </div>
                    </div>
                    
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="active"> @lang('site.active')</label>
            
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="radio" name="active"  required value="1" checked/> @lang('site.yes')

                            <input type="radio" name="active"  value="0" /> @lang('site.no')
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
 