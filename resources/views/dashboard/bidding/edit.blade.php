<div class="modal fade" id="editItem{{$item->id}}" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form class="mt-5" method="post" action="{{url('admin/car-bidding/update/'.$item->id)}}" id="form">
                    @csrf
                    <input type="hidden" value="{{ LaravelLocalization::getCurrentLocale() }}" name="lang" />
                    <div class="card ">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">{{ __('site.date_auction') }}</h4>
                            <p class="card-category">{{ __('site.enter_the_below_required_data') }}</p>
                        </div>
                        <div class="card-body">


                        @if(isset($item['car']->id))
                            <input type="hidden" value="{{$item['car']->id}}" name="id" >
                        @endif
                            <div class="row">
                                <label class="col-sm-3 col-form-label">{{ __('site.date_auction') }}</label>
                                <div class="col-sm-9">
                                    <div class="form-group{{ $errors->has('date_auction') ? ' has-danger' : '' }}">
                                    @if(isset($item['car']->id))
                                        <input class="form-control{{ $errors->has('date_auction') ? ' is-invalid' : '' }}" name="date_auction" id="date_auction"
                                               type="date"  value="{{date('Y-m-d', strtotime($item['car']->date_auction))}}" required="true" aria-required="true"/>

                                        @if ($errors->has('date_auction'))
                                            <span id="name-error" class="error text-danger" for="date_auction">{{ $errors->first('date_auction') }}</span>
                                        @endif
                                    @endif
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="card-footer ml-auto mr-auto">
                            <button type="submit" class="btn btn-primary">{{ __('site.save') }}</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
