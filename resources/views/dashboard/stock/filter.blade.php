

<form action="{{ route('admin.stock.search') }}" method="get" class="form-horizontal form-label-left">
 
        <div class="form-group col-md-3">             
                <select class="form-control" name="brand_id" id="brand_id">
                    <option value="">{{__('site.choose_brand')}}</option>
                    
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}"> {{ $brand['name_'.my_lang()] }} </option>
                        @endforeach
                 
                </select>         
        </div>

        <div class="form-group col-md-3">            
                <select class="form-control" name="model_id" id="model_id">
                    <option disabled selected value="">{{__('site.choose_model')}}  </option>
                </select>            
        </div>

        <div class="form-group col-md-3">            
                <select class="form-control" name="year">
                    <option disabled selected value="">{{__('site.year')}}  </option>
                    @for($i = date('Y')+1  ; $i >= 1900 ; $i--)
                        <option value="{{$i}}">{{$i}}</option>
                    @endfor
                </select>                    
        </div>
   
        <div class="form-group col-md-3">
            <button type="submit" class="btn btn-success"> @lang('site.search') </button>

            <button type="button" onclick="window.location.href='{{ route('admin.stocks') }}'" 
            class="btn btn-primary"> @lang('site.all') </button>
        </div>

</form>