


<table class="data table table-striped no-margin">
    <thead>
    <tr>
        <th>#</th>
        <th> @lang('site.city') </th>
        <th> @lang('site.price') </th>     
        <th> @lang('site.active') </th>        
    </tr>
    </thead>
    <tbody>
        
        @foreach ($myPrices as $k=>$myPrice)
            <tr>
                <td> {{ $k+1 }} </td>
                <td> {{ $myPrice->city['name_'.my_lang()] }} </td>

                <td> {{ $myPrice->price }} @lang('site.rs') </td>

                <td> {{ $myPrice->active == 1 ? __('site.yes') : __('site.no') }} </td>
            </tr>
        @endforeach
        
    </tbody>
</table>