

 
    <h3 class="col-md-12"> @lang('site.order_cost') </h3>
                
    @if(payment_type() == 'cart')
        <div class="col-md-6"> <h6> @lang('site.parts_total')  </h6> </div>   
        <div class="col-md-6"> <h6 class="float-left"> {{ sub_total() }}  @lang('site.rs')  </h6> </div>

        <div class="col-md-6"> <h6> @lang('site.pieces_tax')  </h6> </div>   
        <div class="col-md-6"> <h6 class="float-left"> {{ setting('pieces_tax') }}  @lang('site.rs')  </h6> </div>

        <div class="col-md-6"> <h6> @lang('site.site_commission')  </h6> </div>   
        <div class="col-md-6"> <h6 class="float-left"> {{ setting('site_commission') }}  @lang('site.rs')  </h6> </div>
    @endif

    <div class="col-md-6"> <h6> @lang('site.total') </h6> </div>
    <div class="col-md-6"> <h6 class="float-left"> <span> {{ total() }}  @lang('site.rs')  </span> </h6> </div>
    
  