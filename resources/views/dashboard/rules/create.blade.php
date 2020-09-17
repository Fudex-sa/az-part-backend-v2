<div class="modal fade add_item" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel2"> @lang('site.create_new_rule') </h4>
            </div>
            <div class="modal-body">
               
                <form class="form-horizontal form-label-left" action="{{ route('rules.store') }}" method="post" novalidate>
                    @csrf
                
                    <input type="hidden" value="{{ LaravelLocalization::getCurrentLocale() }}" name="lang" />
                    
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> @lang('site.name') <span
                                class="required">*</span>
                        </label>
            
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="name" class="form-control col-md-7 col-xs-12" required />
                        </div>
                    </div>
            
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> @lang('site.permissions') <span
                                class="required">*</span>
                        </label>
                        
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            @foreach($permissions as $permission)
                            <div class="col-md-6">                            
                                    <label class="fancy-checkbox">
                                        
                                        <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"/>
                                        <span>{{ __('site.'.$permission->permission) }}</span>
                                    </label>
                            </div>                    
                            @endforeach     
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
 