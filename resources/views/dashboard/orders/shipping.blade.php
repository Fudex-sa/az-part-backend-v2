 
@if($shipping)

    <p class="lead"> @lang('site.shipping_data')  </p>

    <table class="table table-striped">
        <tbody>
            <tr>
                <th> @lang('site.region') </th>
                <td> {{ $shipping->country ?  $shipping->country['name_'.my_lang()] : '-'}} -
                    {{ $shipping->region ?  $shipping->region['name_'.my_lang()] : '-'}}
                </td>
            </tr>

            <tr>
                <th> @lang('site.city') </th>
                <td> {{ $shipping->city ?  $shipping->city['name_'.my_lang()] : '-'}} </td>
            </tr>

            <tr>
                <th> @lang('site.street') </th>
                <td>  {{ $shipping->street }} </td>
            </tr>

            <tr>
                <th> @lang('site.address') </th>
                <td>  {{ $shipping->address }} </td>
            </tr>

            <tr>
                <th> @lang('site.rep') </th>
                <td>  {{ $shipping->rep ? $shipping->rep->name : '-' }} </td>
            </tr>

            <tr>
                <th> @lang('site.status') </th>
                <td>  {{ __('site.'.$shipping->status) }} </td>
            </tr>

            @if($shipping->status == 'accepted')
            <tr>
                <th> @lang('site.delivery_time') </th>
                <td>  {{ $shipping->delivery_time }} </td>
            </tr>
            @elseif($shipping->status == 'rejected')
            <tr>
                <th> @lang('site.reject_reason') </th>
                <td>  {{ $rejected ? $rejected->reject_reason : '' }} </td>
            </tr>
            @endif

            <tr>
                <th> @lang('site.notes') </th>
                <td>  {{ $item->notes }} </td>
            </tr>

        </tbody>
    </table>
@endif


                        