<div class="modal fade add_item" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel2"> @lang('site.add_ads') </h4>
            </div>
            <div class="modal-body">
               
                <form class="form-horizontal form-label-left" action="{{ route('admin.ad.store') }}" method="post" 
                    enctype="multipart/form-data">
                    @csrf
                 
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="img"> @lang('site.image') <span
                                class="required">*</span>
                        </label>
            
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="file" name="img" class="col-md-7 col-xs-12" required />
                        </div>
                    </div>

                    {{-- <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="width"> @lang('site.choose_width') <span
                                class="required">*</span>
                        </label>
            
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select name="width" id="width" class="form-control">
                                <option disabled selected>{{__('site.choose_width')}}</option>
                                    <option value="1" >728*90</option>
                                    <option value="2" >300*250</option>
                            </select>
                        </div>
                    </div> --}}

                    {{-- <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="location"> @lang('site.location') <span
                                class="required">*</span>
                        </label>
            
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select name="location" id="location" class="form-control" required>
                                <option disabled selected>{{__('site.choose_location')}}</option>
                                    <option value="damaged"> @lang('site.damaged') </option>
                                    <option value="antique"> @lang('site.antique') </option>
                            </select>
                        </div>
                    </div> --}}

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="link"> @lang('site.link') </label>
            
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" class="form-control" name="link" />
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

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sort"> @lang('site.sort') </label>
            
                        <div class="col-md-2 col-sm-6 col-xs-12">
                            <select name="sort" id="sort" class="form-control">
                                @for($i = 0 ; $i <= 20 ; $i++)
                                    <option value="{{ $i }}"> {{ $i }} </option>
                                @endfor
                            </select>
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
 