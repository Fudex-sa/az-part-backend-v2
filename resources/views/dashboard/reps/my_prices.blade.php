

<form method="post" action="{{ route('admin.rep_price.store') }}">
    @csrf

<input type="hidden" value="{{ $item->id }}" name="rep_id" />

    <div class="col-md-4">
        <select class="form-control" name="_from" id="_from">
            <option value=""> @lang('site.choose_tashlih_region') </option>
            @foreach ($delivery_regions as $delivery_region)
                <option value="{{ $delivery_region->id }}">
                    {{ $delivery_region['name_'.my_lang()] }} </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <select class="form-control" name="country_id" id="country">
            <option value=""> @lang('site.choose_country') </option>
            @foreach (countries() as $country)
                <option value="{{ $country->id }}"> {{ $country['name_'.my_lang()] }} </option>    
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <select class="form-control col-md-8" name="region_id" id="region">
            <option value=""> @lang('site.choose_region') </option>                 
        </select>
    </div>

    <br/> <br/>

    <div class="col-md-4">        
        <select class="form-control col-md-8" name="city_id" id="city">
            <option value=""> @lang('site.choose_city') </option>                 
        </select> 
    </div>

    <div class="col-md-4">        
        <input type="number" name="price" class="form-control" min="0" placeholder="@lang('site.price')"/> @lang('site.rs')
    </div>

    <div class="col-md-5">        
        <label> @lang('site.car_size') </label>

        <label> <input type="checkbox" value="light" name="car_size[]" /> @lang('site.light') </label>
        <label> <input type="checkbox" value="medium" name="car_size[]" checked /> @lang('site.medium') </label>
        <label> <input type="checkbox" value="heavy" name="car_size[]" /> @lang('site.heavy') </label>

    </div>

    <div class="col-md-2"> 
        <input type="submit" value="@lang('site.add')" class="btn btn-default"/> 
    </div>

</form>

<hr/> 

<table class="data table table-striped no-margin">
    <thead>
    <tr>
        <th>#</th>
        <th> @lang('site.tashlih_region') </th>
        <th> @lang('site.city') </th>
        <th> @lang('site.price') </th>  
        <th> @lang('site.car_size') </th>     
        <th> @lang('site.active') </th>  
        <th> </th>      
    </tr>
    </thead>
    <tbody>
        
        @foreach ($myPrices as $k=>$myPrice)
            <tr>
                <td> {{ $k+1 }} </td>
                
                <td>{{$myPrice->region_from ? $myPrice->region_from['name_'.my_lang()] : ''}}</td>

                <td> {{ $myPrice->city ? $myPrice->city['name_'.my_lang()] : '' }} </td>

                <td> {{ $myPrice->price }} @lang('site.rs') </td>

                <td> {{ implode(',',$myPrice->car_size) }} </td>

                <td> {{ $myPrice->active == 1 ? __('site.yes') : __('site.no') }} </td>

                <td> 
                    @if(has_permission('rep_price_delete'))
                        <a onclick="deleteItem({{ $myPrice->id }})" class="btn btn-danger btn-xs">
                            <i class="fa fa-trash"></i> </a>
                    @endif
                </td>

            </tr>
        @endforeach
        
    </tbody>
</table>