<div class="modal fade add_item" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel2"> @lang('site.add_stock') </h4>
            </div>
            <div class="modal-body">
               
                <form class="form-horizontal form-label-left" action="{{ route('admin.stock.store') }}" 
                method="post" enctype="multipart/form-data" novalidate>
                    @csrf
                 
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="brand_id"> @lang('site.brand') <span
                                class="required">*</span>
                        </label>
            
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control col-md-7 col-xs-12" name="brand_id" id="brand_id">
                                <option value="">{{__('site.choose_brand')}}</option>
                                
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}"> {{ $brand['name_'.my_lang()] }} </option>
                                    @endforeach
                             
                            </select>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="model_id"> @lang('site.model') <span
                                class="required">*</span>
                        </label>
            
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control col-md-7 col-xs-12" name="model_id" id="model_id">
                                <option disabled selected value="">{{__('site.choose_model')}}  </option>
                            </select>
 
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="year"> @lang('site.year') <span
                                class="required">*</span>
                        </label>
            
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control col-md-7 col-xs-12" name="year">
                                <option disabled selected value="">{{__('site.year')}}  </option>
                                @for($i = date('Y')+1  ; $i >= 1900 ; $i--)
                                    <option value="{{$i}}">{{$i}}</option>
                                @endfor
                            </select>
 
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="piece"> @lang('site.piece') <span
                                class="required">*</span>
                        </label>
            
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control col-md-7 col-xs-12" name="piece_id" id="piece_id">
                                <option value="">{{__('site.choose_piece')}}</option>
 
                                    @foreach($pieces as $piece)
                                        <option value="{{ $piece->id }}"> {{ $piece['name_'.my_lang()] }} </option>
                                    @endforeach
                               
                            </select>
 
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="piece"> @lang('site.price') <span
                                class="required">*</span>
                        </label>
            
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <input type="number" name="price" class="form-control" />
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
 