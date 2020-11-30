
 
  
    <h3> @lang('site.shipping_details') </h3>
    
     
    <table class="my-tbl text-center">
        
        <tr>
            <th> @lang('site.payment_method') </th>
            <td> {{ __('site.'.$item->payment_method) }} </td>
        </tr>

        <tr>
            <th> @lang('site.country') </th>
            <td> {{ $item->shipping->country['name_'.my_lang()] }} </td>
        </tr>
        <tr>
            <th> @lang('site.region') </th>
            <td> {{ $item->shipping->region ? $item->shipping->region['name_'.my_lang()] : '-' }} </td>
        </tr>
        <tr>
            <th> @lang('site.city') </th>
            <td> {{ $item->shipping->city ? $item->shipping->city['name_'.my_lang()] : '-' }} </td>
        </tr>
        <tr>
            <th> @lang('site.street') </th>
            <td> {{ $item->shipping ? $item->shipping->street : '-' }} </td>
        </tr>

        <tr>
            <th> @lang('site.with_oil') </th>
            <td> {{ $item->shipping->with_oil == 1 ? __('site.yes') : __('site.no') }} </td>
        </tr>

        <tr>
            <th> @lang('site.car_size') </th>
            <td> {{ __('site.'.$item->shipping->size) }} </td>
        </tr>

        <tr>
            <th> @lang('site.rep') </th>
            <td> {{ $item->shipping->rep ? $item->shipping->rep['name'] : __('site.waiting_for_assign') }} </td>
        </tr>

        @if($item->status == 8)
        <tr>
            <th> @lang('site.delivery_time') </th>
            <td> {{ $item->shipping->delivery_time }} </td>
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
            <td> {{ $item->shipping->notes ? $item->shipping->notes : '-' }} </td>
        </tr>

        @if(user_type() == 'rep' && $item->shipping->rep_id == logged_user()->id)
            <tr class="text-center">
                <td colspan="2">               
                    <button class="btn btn-info" data-toggle="modal" data-target=".update_shipping"> 
                        @lang('site.update') </button> </td>               
            </tr>
        @endif
    </table>

     
    