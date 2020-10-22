
<p class="lead"> @lang('site.order_details')  </p>

@if($item->cart)
<table class="table table-striped">
    <thead>
        <tr>
            <th> # </th>
            <th> @lang('site.type') </th>
            <th> @lang('site.seller') </th>
            <th> @lang('site.model') </th>
            <th> @lang('site.city') </th>
            <th> @lang('site.piece') </th>
            <th> @lang('site.price') </th>
            <th> @lang('site.guarantee') </th>
            <th> @lang('site.notes') </th>
            <th> @lang('site.color') </th>
        </tr>
    </thead>
    <tbody>
         
        @foreach ($item->cart as $k=>$cart)
            <tr>
                <td> {{ $k+1 }} </td>
                <td> {{ __('site.'.$cart->type) }} </td>
                <td> {{ $cart->seller ? $cart->seller->name : '-' }} </td>
                <td> 
                    {{ $cart->brand ? $cart->brand['name_'.my_lang()] : '' }} - 
                    {{ $cart->model ? $cart->model['name_'.my_lang()] : '' }} - 
                    {{ $cart->year }}                
                </td>
                <td>
                    {{ $cart->country ? $cart->country['name_'.my_lang()] : '' }} - 
                    {{ $cart->region ? $cart->region['name_'.my_lang()] : '' }} - 
                    {{ $cart->city ? $cart->city['name_'.my_lang()] : '' }} 
                </td>
                <td> {{ $cart->piece_alt['name_'.my_lang()] }} </td>
                <td> {{ $cart->price }} @lang('site.rs') </td>
                <td> {{ $cart->guarantee }} </td>
                <td> {{ $cart->notes ? $cart->notes : '-' }} </td>
                <td> {{ $cart->color ? $cart->color : '-' }} </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endif
               