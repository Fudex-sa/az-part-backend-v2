


@if(coupon_discount() > 0)
<div class="row mt-4">
    <div class="alert alert-success col-md-12 text-center pt-4 shadow rounded" role="alert">
    <h5> @lang('site.coupon_use_name') </h5>
    
    <h4 class="pt-2"> 
    <img src="{{ site('assets/images/ok.png') }}" alt="" class=" pl-2"> {{ session()->get('coupon') }} </h4>
    </div>
</div>
@endif