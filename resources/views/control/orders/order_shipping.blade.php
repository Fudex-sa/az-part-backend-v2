
 
  
    <h3> @lang('site.shipping_details') </h3>

    <table class="table table-success">
        
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
            <td> @lang('site.rep') </td>
            <td> {{ $shipping->rep ? $shipping->rep['name'] : '-' }} </td>
        </tr>

        @if($shipping->status == 'accepted')
        <tr>
            <td> @lang('site.delivery_time') </td>
            <td> {{ $shipping->delivery_time }} </td>
        </tr>
        @elseif($shipping->status == 'rejected')
        <tr>
            <td> @lang('site.reject_reason') </td>
            <td> {{ $order_rejected->reject_reason }} </td>
        </tr>
        @endif

        <tr>
            <td> @lang('site.status') </td>
            <td> {{ __('site.'.$shipping->status) }} </td>
        </tr>

        <tr>
            <td> @lang('site.notes') </td>
            <td> {{ $shipping->notes ? $shipping->notes : '-' }} </td>
        </tr>

        <tr class="text-center">
            <td colspan="2">
                @if($shipping->status == 'pending')
                 <button class="btn btn-info" data-toggle="modal" data-target=".update_shipping"> 
                     @lang('site.update') </button> </td>
                @endif
        </tr>
    </table>
 
    