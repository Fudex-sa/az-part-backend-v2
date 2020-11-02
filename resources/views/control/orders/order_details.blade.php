
 
  
    <h3> @lang('site.order_data') </h3>

    <table class="table table-striped">
        <tr>
            <td> @lang('site.order_no') </td>
            <td> AZ-{{ $item->id }} </td>
        </tr>

        <tr>
            <th> @lang('site.order_package') </th>
            <td> {{ $item->package_subscribe ? __('site.'.$item->package_subscribe->package_type) : '-' }} </td>
       </tr>

       <tr>
            <th> @lang('site.request_owner') </th>
            <td> {{ $item->user->name }} </td>
        </tr>

        <tr>
            <th> @lang('site.user_type') </th>
            <td> {{ __('site.'.$item->user_type) }} </td>
        </tr>
 
        <tr>
            <th> @lang('site.sub_total') </th>
            <td> {{ $item->sub_total }} @lang('site.rs') </td>
        </tr>

        <tr>
            <th> @lang('site.delivery_price') </th>
            <td> {{ $item->delivery_price }} @lang('site.rs') </td>
        </tr>

        <tr>
            <th> @lang('site.taxs') </th>
            <td> {{ $item->taxs }} @lang('site.rs') </td>
        </tr>

        <tr>
            <th> @lang('site.total') </th>
            <td> {{ $item->total }} @lang('site.rs') </td>
        </tr>

        <tr>
            <th> @lang('site.coupon_value') </th>
            <td> {{ $item->coupon_id ? $item->coupon_value : '-' }} </td>
        </tr>

        <tr>
            <th> @lang('site.order_status') </th>
            <td> <span class="btn status-{{ $item->order_status->id }}"> {{ $item->order_status['name_'.my_lang()] }} </td>
        </tr>
       
         
    </table>
  

    