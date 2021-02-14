<h3> @lang('site.order_cost') </h3>
<ul class="sam-list">
    @if(request()->type == 'cart' || session()->get('payment_type') == 'cart')

    <li>
        <span>@lang('site.parts_total')</span>
        <span>{{ sub_total() }} @lang('site.rs')</span>
    </li>
    <li>
        <span>@lang('site.site_commission') </span>
        <span>
            <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="top"
                title="{{ data('commsion_info') }}"></i> <span class="my-blue"> {{ setting('site_commission') }} %
            </span>
            ({{ commission() .' '. __('site.rs') }})
        </span>
    </li>
    <li>
        <span> @lang('site.pieces_tax') </span>
        <span>
            <span class="my-blue"> {{ setting('pieces_tax') }} % </span>
            ({{ taxs() .' '. __('site.rs') }})
        </span>
    </li>
    <li>
        <span>@lang('site.delivery_price') </span>
        <span>
            <span id="delivery_price"> {{ delivery_price() }} </span> @lang('site.rs')
        </span>
    </li>
    <li>
        <span> @lang('site.with_oil_cost') </span>
        <span>
            <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="top"
                title="{{ data('with_oil_info') }}"></i>
            <span id="with_oil"> {{ session()->get('with_oil') ? session()->get('with_oil') : 0 }} </span>
            @lang('site.rs')
        </span>
    </li>
    @else
    <li>
        <span> @lang('site.package_price') </span>
        <span>{{ total_without_tax() }} @lang('site.rs') </span>
    </li>
    @endif
    <li>
        <span>@lang('site.coupon') </span>
        <span>
            <span class="my-blue"> {{ coupon_discount() }} % </span>
            ({{ discount() . ' ' . __('site.rs') }})
        </span>
    </li>
    <li>
        <span>@lang('site.total') </span>
        <span>
            <span id="total" class="total"> {{ total() }} </span> <span> @lang('site.rs') </span>
        </span>
    </li>
</ul>