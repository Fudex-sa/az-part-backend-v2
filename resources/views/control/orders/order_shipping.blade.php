
 
  
    <h3> @lang('site.shipping_details') </h3>
    
    @if($shipping)
    <table class="my-tbl text-center">
        
        <tr>
            <th> @lang('site.country') </th>
            <td> {{ $shipping->country['name_'.my_lang()] }} </td>
        </tr>
        <tr>
            <th> @lang('site.region') </th>
            <td> {{ $shipping->region['name_'.my_lang()] }} </td>
        </tr>
        <tr>
            <th> @lang('site.city') </th>
            <td> {{ $shipping->city['name_'.my_lang()] }} </td>
        </tr>
        <tr>
            <th> @lang('site.street') </th>
            <td> {{ $shipping->street ? $shipping->street : '-' }} </td>
        </tr>

        <tr>
            <th> @lang('site.with_oil') </th>
            <td> {{ $shipping->with_oil == 1 ? __('site.yes') : __('site.no') }} </td>
        </tr>

        <tr>
            <th> @lang('site.car_size') </th>
            <td> {{ __('site.'.$shipping->size) }} </td>
        </tr>

        <tr>
            <th> @lang('site.rep') </th>
            <td> {{ $shipping->rep ? $shipping->rep['name'] : '-' }} </td>
        </tr>

        @if($item->status == 8)
        <tr>
            <th> @lang('site.delivery_time') </th>
            <td> {{ $shipping->delivery_time }} </td>
        </tr>
        @elseif($item->status == 9)
        <tr>
            <th> @lang('site.reject_reason') </th>
            <td> {{ $order_rejected ? $order_rejected->reject_reason : '' }} </td>
        </tr>
        @endif

        <tr>
            <th> @lang('site.status') </th>
            <td> {{ $item->order_status['name_'.my_lang()] }} </td>
        </tr>

        <tr>
            <th> @lang('site.notes') </th>
            <td> {{ $shipping->notes ? $shipping->notes : '-' }} </td>
        </tr>

        @if(user_type() == 'rep' && $shipping->rep_id == logged_user()->id)
            <tr class="text-center">
                <td colspan="2">               
                    <button class="btn btn-info" data-toggle="modal" data-target=".update_shipping"> 
                        @lang('site.update') </button> </td>               
            </tr>
        @endif
    </table>

    @endif
 
    