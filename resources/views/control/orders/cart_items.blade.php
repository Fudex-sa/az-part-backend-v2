
 
  
    <h3> @lang('site.order_content') </h3>
<div class="table-responsive">
    <table class="text-center my-tbl">
        
         <tr>
            <th> # </th>
            <th> <i class=" fa fa-camera"></i> </th>
            <th> @lang('site.piece_name') </th>
            <th> @lang('site.qty') </th>
            <th> @lang('site.price') </th>
            <th> @lang('site.pieces_price') </th>
            <th> @lang('site.seller') </th>
            <th> @lang('site.tashlih_region') </th>
            <th> @lang('site.guarantee') </th>
            <th> @lang('site.notes') </th>
            <th> @lang('site.color') </th>
         </tr>

         @foreach ($item->cart as $k=>$cart_item)
             <tr>
                <td> {{ $k+1 }} </td>
                
                <td> 
                    @if($cart_item->photo)
                        <img src="{{ cart_img($cart_item->photo) }}" class="img-user" />
                    @else <img src="{{ site('assets/images/logo.png') }}" class="img-user" /> @endif
                </td>

                <td> {{ $cart_item->piece_alt['name_'.my_lang()] }} </td>

                <td> {{ $cart_item->qty }} </td>

                <td> {{ $cart_item->price }} @lang('site.rs') </td>

                <td> {{ $cart_item->price * $cart_item->qty }} @lang('site.rs') </td>

                <td> @if(isset($cart_item->seller)) 
                        {{ $cart_item->seller ? $cart_item->seller->name : '' }} 
                    @endif
                </td>

                <td> @if(isset($cart_item->seller) && isset($cart_item->seller->tashlih)) 
                        {{ $cart_item->seller ? $cart_item->seller->tashlih['name_'.my_lang()] : '-' }}
                    @endif
                </td>
                
                <td> {{ $cart_item->guarantee ? $cart_item->guarantee : '-' }} </td>

                <td> {{ $cart_item->notes ? $cart_item->notes : '-' }} </td>

                <td> {{ $cart_item->color ? $cart_item->color : '-' }} </td>

             </tr>
         @endforeach
    </table>
 </div>
    @if($item->coupon)

    <hr/>
        <h3> @lang('site.coupon_used')  </h3>
    
<div class="table-responsive">
        <table class="my-tbl text-center">
            <tbody>
                <tr>
                    <th> @lang('site.code') </th>
                    <th> @lang('site.value') </th>
                    <th> @lang('site.uses_number') </th>
                    <th> @lang('site.expiration_date') </th>
                </tr>

                <tr>
                    <td> {{ $item->coupon->code }} </td>
                    <td> {{ $item->coupon->value }} % </td>
                    <td> {{ coupon_used_times($item->coupon->id) }}  </td>
                    <td> {{ $item->coupon->expiration_date }} </td>
                </tr>

            </tbody>
        </table>
        </div>
    @endif


    @if($item->package_subscribe)

<hr/>
    <h3> @lang('site.order_package')  </h3>

<div class="table-responsive">
    <table class="my-tbl text-center">
        <tbody>
            <tr>
                <th> @lang('site.package_name') </th>
                <th> @lang('site.price') </th>
                <th> {{ $item->package_subscribe->package_type == 'manual' ? __('site.stores_no') : __('site.requests_count') }}  </th>
                <th> @lang('site.expired') </th>
            </tr>

            <tr>
                <td> {{  __('site.'.$item->package_subscribe->package_type) }} </td>
                <td> {{ $item->package_subscribe->price }} @lang('site.rs') </td>
                <td> {{ $item->package_subscribe->stores_no }} </td>
                <td> {{ $item->package_subscribe->expired == 1 ? __('site.yes') : __('site.no')  }} </td>
            </tr>
 
        </tbody>
    </table>
    </div>
@endif
