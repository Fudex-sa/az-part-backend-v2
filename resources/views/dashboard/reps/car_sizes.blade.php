


<table class="data table table-striped no-margin">
    <thead>
    <tr>
        <th>#</th>
        <th> @lang('site.car_size') </th>
        
    </tr>
    </thead>
    <tbody>
        
        @foreach ($carSizes as $k=>$carSize)
            <tr>
                <td> {{ $k+1 }} </td>
                <td> {{ __('site.'.$carSize->size) }} </td>

            </tr>
        @endforeach
        
    </tbody>
</table>