
<p class="lead"> @lang('site.order_details')  </p>

@if($item->cart)

@foreach ($item->cart as $k=>$cart)
<table class="table table-striped">
    <tbody>
        <tr>
            <th> @lang('site.piece_no') </th>
            <td> {{ $k+1 }}  </td>

            <th> <i class="fa fa-camera"></i> </th>
            <td> @if($cart->photo) 
                 
                <button type="button"  data-toggle="modal" data-target="#viewImg">
                    <img src="{{ cart_img($cart->photo) }}" class="img-tbl"/>
                </button>

                <div id="viewImg" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                          <div class="modal-body">
                            <img src="{{ cart_img($cart->photo) }}" class="img-responsive"/>                                                          
                          </div>
                      </div>
                    </div>
                </div>

                @endif </td>            
        </tr>

        <tr>            
            <th> @lang('site.piece') </th>
            <td> {{ $cart->piece_alt['name_'.my_lang()] }} </td>

            <th> @lang('site.piece_price') </th>
            <td> {{ $cart->price }} @lang('site.rs') </td>
        </tr>

        <tr>            
            <th> @lang('site.qty') </th>
            <td> {{ $cart->qty  }} </td>

            <th> @lang('site.model') </th>
            <td> 
                {{ $cart->brand ? $cart->brand['name_'.my_lang()] : '' }} - 
                {{ $cart->model ? $cart->model['name_'.my_lang()] : '' }} - 
                {{ $cart->year }}                
            </td>
        </tr>

        <tr>            
            <th> @lang('site.seller') </th>
            <td> <a href="{{ route('admin.seller',$cart->seller ? $cart->seller->id : '') }}" target="_blank" class="underline">
                    <i class="fa fa-user"></i> {{ $cart->seller ? $cart->seller->name : '-' }} </a> </td>

            <th> @lang('site.city') </th>
            <td>
                {{ $cart->country ? $cart->country['name_'.my_lang()] : '' }} - 
                {{ $cart->region ? $cart->region['name_'.my_lang()] : '' }} - 
                {{ $cart->city ? $cart->city['name_'.my_lang()] : '' }} 
            </td>
        </tr>

        <tr>            
            <th> @lang('site.guarantee') </th>
            <td> {{ $cart->guarantee }} </td>

            <th> @lang('site.color') </th>
            <td> {{ $cart->color ? $cart->color : '-' }} </td>
        </tr>

        <tr>            
            <th> @lang('site.notes') </th>
            <td colspan="2">  {{ $cart->notes ? $cart->notes : '-' }}  </td>
        </tr>

    </tbody>
</table>
@endforeach
@endif
 
               