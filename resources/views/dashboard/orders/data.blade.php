
<p class="lead"> @lang('site.order_data')  </p>

<table class="table table-striped">
    <tbody>
        <tr>
            <th> @lang('site.order_no') </th>
            <td> AZ-{{ $item->id }} </td>

        </tr>

        <tr>            
            <th> @lang('site.order_type') </th>
            <td> {{ __('site.'.$item->type) }} </td>

            <th> @lang('site.order_package') </th>
            <td> {{ $item->package_subscribe ? __('site.'.$item->package_subscribe->package_type) : '-' }} </td>
        </tr>

        <tr>
            <th> @lang('site.order_user') </th>
            <td> 
                @if($item->user_type == 'user')
                    <a href="{{ route('admin.user',$item->user->id) }}" target="_blank">
                         <i class="fa fa-user"></i> {{ $item->user->name }} </a>
                         
                @elseif($item->user_type == 'company')
                    <a href="{{ route('admin.company',$item->user->id) }}" target="_blank"> 
                        <i class="fa fa-user"></i> {{ $item->user->name }} </a>
                @endif
                </td>

            <th> @lang('site.user_type') </th>
            <td> {{ __('site.'.$item->user_type) }} </td>
        </tr>
 
        <tr>
            <th> @lang('site.sub_total') </th>
            <td> {{ $item->sub_total }} @lang('site.rs') </td>

            <th> @lang('site.delivery_price') </th>
            <td> {{ $item->delivery_price }} @lang('site.rs') </td>
        </tr>

        <tr>
            <th> @lang('site.taxs') </th>
            <td> {{ $item->taxs }} @lang('site.rs') </td>

            <th> @lang('site.coupon_value') </th>
            <td> {{ $item->coupon_id ? $item->coupon_value : '-' }} </td>
        </tr>
 
        <tr>
            <th> @lang('site.total') </th>
            <td> {{ $item->total }} @lang('site.rs') </td>

            <th> @lang('site.order_status') </th>
            <td> <span class="btn status-{{ $item->order_status->id }}">
                 {{ $item->order_status['name_'.my_lang()] }} </span> </td>
        </tr>
 

    </tbody>
</table>



@if($item->coupon)

<hr/>
    <p class="lead"> @lang('site.coupon_used')  </p>

    <table class="table table-striped">
        <tbody>
            <tr>
                <th> @lang('site.code') </th>
                <td> {{ $item->coupon->code }} </td>

                <th> @lang('site.value') </th>
                <td> {{ $item->coupon->value }} @lang('site.rs') </td>
            </tr>

            <tr>
                <th> @lang('site.uses_number') </th>
                <td> {{ $couponUsedCount }}  </td>

                <th> @lang('site.expiration_date') </th>
                <td> {{ $item->coupon->expiration_date }} </td>
            </tr>

        </tbody>
    </table>
@endif

@if($item->package_subscribe)

<hr/>
    <p class="lead"> @lang('site.order_package')  </p>

    <table class="table table-striped">
        <tbody>
            <tr>
                <th> @lang('site.package_name') </th>
                <td> {{  __('site.'.$item->package_subscribe->package_type) }} </td>

                <th> @lang('site.price') </th>
                <td> {{ $item->package_subscribe->price }} @lang('site.rs') </td>
            </tr>

            <tr>
                <th> {{ $item->package_subscribe->package_type == 'manual' ? __('site.stores_no') : __('site.requests_count') }}  </th>
                <td> {{ $item->package_subscribe->stores_no }} </td>

                <th> @lang('site.expired') </th>
            <td> {{ $item->package_subscribe->active == 1 ? __('site.yes') : __('site.no')  }} </td>
            </tr>

        </tbody>
    </table>
@endif


                        