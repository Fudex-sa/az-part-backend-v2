

 
    <h3 class="col-md-12"> @lang('site.order_cost') </h3>
                
    @if(request()->type == 'cart' || session()->get('payment_type') == 'cart')
    
        <div class="col-md-6"> <h6> @lang('site.parts_total')  </h6> </div>   
        <div class="col-md-6"> <h6 class="float-left"> {{ sub_total() }}  @lang('site.rs')  </h6> </div>

        <div class="col-md-6"> <h6> @lang('site.pieces_tax')  </h6> </div>   
        <div class="col-md-6"> <h6 class="float-left"> <span class="my-blue"> {{ setting('pieces_tax') }} %  </span>
                ({{ taxs() .' '. __('site.rs') }})  </h6> </div>

        <div class="col-md-6"> <h6> @lang('site.site_commission')  </h6> </div>   
        <div class="col-md-6"> <h6 class="float-left"> <span class="my-blue"> {{ setting('site_commission') }} % </span>
                 ({{ commission() .' '. __('site.rs') }}) </h6> </div>

        <div class="col-md-6"> <h6> @lang('site.delivery_price')  </h6> </div>   
        <div class="col-md-6"> <h6 class="float-left">  
            <span id="delivery_price"> {{ delivery_price() }} </span>  @lang('site.rs')  </h6> </div>

        <div class="col-md-6"> <h6> @lang('site.with_oil_cost')  </h6> </div>   
        <div class="col-md-6"> <h6 class="float-left">  
            <span id="with_oil"> {{ session()->get('with_oil') ? session()->get('with_oil') : 0 }} </span>  @lang('site.rs')  </h6> </div>
 

        <div class="col-md-6"> <h6> @lang('site.coupon')  </h6> </div>   
        <div class="col-md-6"> <h6 class="float-left"> <span class="my-blue"> {{ coupon_discount() }}  % </span>
            ({{ discount() . ' ' . __('site.rs') }})
        </h6> </div>

    @endif

    <div class="col-md-6"> <h6> @lang('site.total') </h6> </div>
    <div class="col-md-6"> <h6 class="float-left"> 
        <span id="total"> {{ total() }}  </span> <span>  @lang('site.rs') </span> </h6> 
    </div>
    
  