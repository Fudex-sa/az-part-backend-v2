

<table class="data table table-striped no-margin">
    <thead>
    <tr>
        <th>#</th>
        <th> @lang('site.brand') </th>        
        <th> @lang('site.model') </th>
        <th> @lang('site.years') </th>        
    </tr>
    </thead>
    <tbody>
        
        @foreach ($avaliable_models as $k=>$avaliable_model)
            <tr>
                <td> {{ $k+1 }} </td>

                <td> {{ $avaliable_model->brand['name_'.my_lang()] }} </td>

                <td> {{ $avaliable_model->model['name_'.my_lang()] }} </td>

                <td> {{ implode(',',$avaliable_model->years) }} </td>
            </tr>
        @endforeach

        
    </tbody>
</table>