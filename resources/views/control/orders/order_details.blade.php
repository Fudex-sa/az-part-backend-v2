
 
  
    <h3> @lang('site.order_data') </h3>

    <table class="my-tbl text-center">
        <tr>
            <th> @lang('site.order_no') </th>
            <td> AZ-{{ $item->id }} </td>
        </tr>

        <tr>
            <th> @lang('site.order_type') </th>
            <td> {{ __('site.'.$item->type) }} </td>
        </tr>

        <tr>
            <th> @lang('site.order_package') </th>
            <td> {{ $item->package_subscribe ? __('site.'.$item->package_subscribe->package_type) : '-' }} </td>
       </tr>

       <tr>
            <th> @lang('site.request_owner') </th>
            <td> @if($item->user_type == 'seller') {{ $item->seller ? $item->seller->name : ''}}
                 @elseif($item->user_type == 'broker') {{ $item->broker ? $item->broker->name : ''}}
                 @elseif($item->user_type == 'company') {{ $item->company ? $item->company->name : ''}}
                 @else {{ $item->user ? $item->user->name : ''}} @endif
            </td>
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
            <th> @lang('site.site_commission') </th>
            <td> {{ setting('site_commission') }} %  ({{ setting('site_commission') / 100 * $item->sub_total }} @lang('site.rs')) </td>
        </tr>

        <tr>
            <th> @lang('site.coupon_value') </th>
            <td>
                @if($item->coupon_id) {{ $item->coupon_value }} % ({{ $item->coupon_value / 100 * $item->sub_total }} @lang('site.rs'))

                @else - @endif
                
            </td>
        </tr>

         <tr>
            <th> @lang('site.pieces_tax') </th>
            <td> {{ $item->taxs }} @lang('site.rs') </td>
        </tr>

        <tr>
            <th> @lang('site.delivery_price') </th>
            <td> {{ $item->delivery_price }} @lang('site.rs') </td>
        </tr>
 
        <tr>
            <th> @lang('site.total') </th>
            <td> {{ $item->total }} @lang('site.rs') </td>
        </tr>

        <tr>
            <th> @lang('site.remaining_cost') </th>
            <td> {{ $item->remaining_cost }} @lang('site.rs') 
            
                @if(user_type() == 'rep' && $item->shipping->rep_id == logged_user()->id)
                    @if($item->remaining_cost != 0)
                        <button onclick="confirm_paid({{ $item->id }})" 
                            class="btn btn-success"> @lang('site.confirm_paid') </button> 
                    @else 
                        <button onclick="confirm_paid({{ $item->id }})" 
                            class="btn btn-danger"> @lang('site.cancel') </button> 
                    @endif

                @endif

            </td>
        </tr>
 
        <tr>
            <th> @lang('site.order_status') </th>
            <td> <span class="btn status-{{ $item->order_status->id }}"> {{ $item->order_status['name_'.my_lang()] }} </td>
        </tr>
       
         
    </table>
  

    