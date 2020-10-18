


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
        
        @foreach ($myCities as $myCity)
            <tr>
                <td> {{ $myCity->city['name_'.my_lang()] }} </td>

                <td> {{ $myCity->price }} @lang('site.rs') </td>

                <td> {{ $myCity->active == 1 ? __('site.yes') : __('site.no') }} </td>
            </tr>
        @endforeach
        
    </tbody>
</table>