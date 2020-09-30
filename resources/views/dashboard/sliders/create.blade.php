
<div class="modal fade add_item" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel2"> @lang('site.add_slider') </h4>
            </div>
            <div class="modal-body">
               
                <form class="form-horizontal form-label-left" action="{{ route('admin.slider.store') }}" 
                method="post" enctype="multipart/form-data" novalidate>
                    @csrf
                 
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="img"> @lang('site.image') <span
                                class="required">*</span>
                        </label>
            
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="file" name="img" class="col-md-7 col-xs-12" />
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title_ar"> @lang('site.title_ar') </label>
            
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="title_ar" class="form-control col-md-7 col-xs-12"  value="{{ old('title_ar') }}" />
                        </div>
                    </div> 

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title_en"> @lang('site.title_en') </label>
            
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="title_en" class="form-control col-md-7 col-xs-12" value="{{ old('title_en') }}" />
                        </div>
                    </div> 

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title_hi"> @lang('site.title_hi') </label>
            
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="title_hi" class="form-control col-md-7 col-xs-12" value="{{ old('title_hi') }}" />
                        </div>
                    </div> 
                    
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="content_ar"> @lang('site.content_ar') </label>
            
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <textarea name="content_ar" class="form-control col-md-7 col-xs-12"> {{ old('content_ar') }} </textarea>                           
                        </div>
                    </div> 

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="content_en"> @lang('site.content_en') </label>
            
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <textarea name="content_en" class="form-control col-md-7 col-xs-12"> {{ old('content_en') }} </textarea>                           
                        </div>
                    </div> 

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="content_hi"> @lang('site.content_hi') </label>
            
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <textarea name="content_hi" class="form-control col-md-7 col-xs-12"> {{ old('content_hi') }} </textarea>                           
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
                            <button type="submit" class="btn btn-primary"> @lang('site.send')  </button>
                        </div>
                    </div>
            
                </form>


            </div>
           

        </div>
    </div>
</div>
 