 
 
    <p class="lead"> @lang('site.shipping_data')  </p>

<form method="post" action="{{ route('admin.order.update',$item->id) }}">
    @csrf

    <table class="table table-striped">
        <tbody>
            <tr>
                <th> @lang('site.region') </th>
                <td> {{ $item->shipping->country ?  $item->shipping->country['name_'.my_lang()] : '-'}} -
                    {{ $item->shipping->region ?  $item->shipping->region['name_'.my_lang()] : '-'}}
                </td>
            </tr>

            <tr>
                <th> @lang('site.city') </th>
                <td> {{ $item->shipping->city ?  $item->shipping->city['name_'.my_lang()] : '-'}} </td>
            </tr>

            <tr>
                <th> @lang('site.street') </th>
                <td>  {{ $item->shipping->street }} </td>
            </tr>

            <tr>
                <th> @lang('site.rep') </th>
                <td>  {{ $item->shipping->rep ? $item->shipping->rep->name : '-' }} </td>
            </tr>
            
            <tr>
                <th> @lang('site.rep_mobile') </th>
                <td>  {{ $item->shipping->rep ? $item->shipping->rep->mobile : '-' }} </td>
            </tr>
                
            <tr>
                <td>  @lang('site.change_order_rep') </td>
                <td>
                    <select name="rep_id" class="col-md-6">
                        @foreach ($reps as $rep)
                            <option value="{{ $rep->id }}" {{ $rep->id == $item->shipping->rep_id ? 'selected' : '' }}>
                                {{ $rep['name'] }} </option>
                        @endforeach
                    </select>                        
                </td>
            </tr>
 
            @if($item->status == 8)
            <tr>
                <th> @lang('site.delivery_time') </th>
                <td>  <input type="text" class="form-control" name="delivery_time" value="{{ $item->shipping->delivery_time }}" /> </td>
            </tr>
            @elseif($item->status == 9)
            <tr>
                <th> @lang('site.reject_reason') </th>
                <td>  {{ $rejected ? $rejected->reject_reason : '' }} </td>
            </tr>
            @endif

            <tr>
                <th> @lang('site.notes') </th>
                <td>  {{ $item->shipping->notes ? $item->shipping->notes : '-' }} </td>
            </tr>

            <tr>
                <th> @lang('site.order_status') </th>
                <td>
                    <span class="status-{{ $item->order_status->id }}">
                        {{ $item->order_status['name_'.my_lang()] }} </span>
                        
                        <hr/>
                        <div class="row">
                            <label class="col-md-5"> @lang('site.change_order_status') </label>

                            <select name="status" class="col-md-6">
                                @foreach ($order_status as $order_stat)
                                    <option value="{{ $order_stat->id }}" {{ $order_stat->id == $item->status ? 'selected' : '' }}>
                                        {{ $order_stat['name_'.my_lang()] }} </option>
                                @endforeach
                            </select>    
                        </div>
                </td>
            </tr>

        </tbody>
    </table>

    <input type="submit" value="@lang('site.save')" class="btn btn-success" />
                    
</form>