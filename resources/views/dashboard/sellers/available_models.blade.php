
 <div class="x_content">
    <div class="table-responsive">
    <form method="post" action="{{ route('admin.available_brand.store') }}">
            @csrf

    <input type="hidden" value="{{ $item->id }}" name="user_id" />

            <div class="col-md-3">
                <select name="brand_id" id="brand_id" class="form-control">
                    <option value=""> @lang('site.choose_brand') </option>

                    @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}"> {{ $brand['name_'.my_lang()] }} </option>    
                    @endforeach
                </select>
            </div>
 
            <div class="col-md-3">
                <select name="model_id" id="model_id" class="form-control">
                    <option value=""> @lang('site.choose_model') </option>
                </select>
            </div>
 
            <div class="col-md-3">
                <select class="form-control" name="year" id="year">
                    <option value=""> @lang('site.manufacturing_year') </option>
                    @for($i = date('Y')+1  ; $i >= 1970 ; $i--)
                        <option value="{{$i}}" {{ app('request')->input('year')  == $i ? 'selected' : '' }}
                        >{{$i}}</option>
                    @endfor
                  </select> 
            </div>

            <div class="col-md-2"> 
                <input type="submit" value="@lang('site.add')" class="btn btn-default"/> 
            </div>

        </form>
    </div>
 </div>


<table class="data table table-striped no-margin">
    <thead>
    <tr>
        <th>#</th>
        <th> @lang('site.brand') </th>        
        <th> @lang('site.model') </th>
        <th> @lang('site.year') </th>        
    </tr>
    </thead>
    <tbody>
        
        @foreach ($avaliable_models as $k=>$avaliable_model)
            <tr>
                <td> {{ $k+1 }} </td>

                <td> {{ $avaliable_model->brand['name_'.my_lang()] }} </td>

                <td> {{ $avaliable_model->model['name_'.my_lang()] }} </td>

                <td> {{ $avaliable_model->year }} </td>
            </tr>
        @endforeach

        
    </tbody>
</table>