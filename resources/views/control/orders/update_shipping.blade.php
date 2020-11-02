<div class="modal fade update_shipping" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel2"> @lang('site.update_shipping_status') </h4>
            </div>
            <div class="modal-body">
               
                <form class="form-horizontal form-label-left" action="{{ route('rep.order.update',$shipping->id) }}" method="post" 
                    enctype="multipart/form-data">
                    @csrf
                   
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="status"> @lang('site.status') </label>
            
                        <div class="row">
                            @foreach ($ordr_stat as $od_st)
                            <div class="col-md-3 col-sm-12 col-xs-12">
                                <label> <input type="radio" name="status" value="{{ $od_st->id }}" 
                                            {{ $od_st->id == $item->status ? 'checked' : '' }} /> {{ $od_st['name_'.my_lang()] }} </label>    
                            </div>
                            @endforeach
                            
                        </div>
                    </div>
             

                <div class="item form-group" id="delivery_time" style="display: {{ $item->status == 8 ? 'block' : 'none' }}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="delivery_time"> @lang('site.delivery_time') </label>
            
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" name="delivery_time" value="{{ $shipping->delivery_time }}"
                         class="form-control" required/>
                        </div>
                    </div> 

                    <div class="item form-group" id="reject_reason" style="display: {{ $item->status == 9 ? 'block' : 'none' }}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="reject_reason"> @lang('site.reject_reason') </label>
            
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <textarea name="reject_reason" class="form-control" required> </textarea>
                        </div>
                    </div> 
                     
                
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">                        
                            <button type="submit" class="btn btn-primary"> @lang('site.save')  </button>
                            <button type="button" class="btn btn-default" data-dismiss="modal"> @lang('site.close') </button>
                        </div>
                    </div>
            
                </form>


            </div>
           

        </div>
    </div>
</div>
 