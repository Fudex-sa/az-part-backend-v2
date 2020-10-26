
 
  
    <h3> @lang('site.shipping_details') </h3>

    <table class="table @if($item->status == 1)  table-warning
            @elseif($item->status == 8) table-success @else table-danger
        @endif">
        
        <tr>
            <td> @lang('site.country') </td>
            <td> {{ $shipping->country['name_'.my_lang()] }} </td>
        </tr>
        <tr>
            <td> @lang('site.region') </td>
            <td> {{ $shipping->region['name_'.my_lang()] }} </td>
        </tr>
        <tr>
            <td> @lang('site.city') </td>
            <td> {{ $shipping->city['name_'.my_lang()] }} </td>
        </tr>
        <tr>
            <td> @lang('site.street') </td>
            <td> {{ $shipping->street }} </td>
        </tr>

        <tr>
            <td> @lang('site.with_oil') </td>
            <td> {{ $shipping->with_oil == 1 ? __('site.yes') : __('site.no') }} </td>
        </tr>

        <tr>
            <td> @lang('site.car_size') </td>
            <td> {{ __('site.'.$shipping->size) }} </td>
        </tr>

        <tr>
            <td> @lang('site.rep') </td>
            <td> {{ $shipping->rep ? $shipping->rep['name'] : '-' }} </td>
        </tr>

        @if($item->status == 8)
        <tr>
            <td> @lang('site.delivery_time') </td>
            <td> {{ $shipping->delivery_time }} </td>
        </tr>
        @elseif($item->status == 9)
        <tr>
            <td> @lang('site.reject_reason') </td>
            <td> {{ $order_rejected ? $order_rejected->reject_reason : '' }} </td>
        </tr>
        @endif

        <tr>
            <td> @lang('site.status') </td>
            <td> {{ $item->order_status['name_'.my_lang()] }} </td>
        </tr>

        <tr>
            <td> @lang('site.notes') </td>
            <td> {{ $shipping->notes ? $shipping->notes : '-' }} </td>
        </tr>

        <tr class="text-center">
            <td colspan="2">
                @if(user_type() == 'rep' && $shipping->rep_id == logged_user()->id)
                 <button class="btn btn-info" data-toggle="modal" data-target=".update_shipping"> 
                     @lang('site.update') </button> </td>
                @endif
        </tr>
    </table>
 
    