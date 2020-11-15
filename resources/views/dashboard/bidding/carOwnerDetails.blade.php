<div class="modal fade" id="carOwnerDetails{{$item->id}}" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
<div class="modal-body">                
        
        <div class="card ">
            <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('site.car_owner_details') }}</h4>                            
            </div>
            <div class="card-body">
            
                <div class="row">
                    <label class="col-sm-3 col-form-label">{{ __('site.name') }}</label>
                    <div class="col-sm-9">
                        <div class="form-group">
                            <input class="form-control" readonly type="text" value=" {{$item->car ? $item->car->user['name'] : ''}}" />                            
                        </div>
                    </div>
                </div>

                <div class="row">
                    <label class="col-sm-3 col-form-label">{{ __('site.mobile') }}</label>
                    <div class="col-sm-9">
                        <div class="form-group">
                            <input class="form-control" readonly type="text" value=" {{$item->car ? $item->car->user['mobile'] : ''}}" />                            
                        </div>
                    </div>
                </div>

            </div>
            
        </div>
     
</div>

        </div>
    </div>
</div>
