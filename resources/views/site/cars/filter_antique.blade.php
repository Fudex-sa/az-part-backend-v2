

<form class="row mt-4 m-form m-form-2" method="GET" action="{{ route('cars.search') }}">
 
    <div class="col-lg-3 col-md-6 col-sm-6">

      <div class="form-group">
        <label for="city"> @lang('site.brand')   </label>

        <select class="form-control select2" name="brand" id="brand_id">
            <option value=""> @lang('site.choose_brand') </option>
            @foreach ($brands as $brand)
                <option value="{{ $brand->id }}"
                  data-image="{{ brand_img($brand->logo) }}"  class="left"> {{ $brand['name_'.my_lang()] }} </option>    
            @endforeach
          </select>
      </div>
    </div>
    
    <div class="col-lg-3 col-md-6 col-sm-6">
      <div class="form-group">
        <label for="city"> @lang('site.choose_model') </label>

        <select class="form-control" name="model" id="model_id">
            <option value=""> @lang('site.choose_model') </option>                
        </select>
      </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6">
      <div class="form-group">
        <label for="city1"> @lang('site.manufacturing_year') </label>

        <select class="form-control" name="year" id="year">
        <option value=""> @lang('site.choose_brand') </option>
        @for($i = date('Y')+1  ; $i >= 1970 ; $i--)
            <option value="{{$i}}" {{ app('request')->input('year')  == $i ? 'selected' : '' }}
            >{{$i}}</option>
        @endfor
        </select>
      </div>
    </div>
 
   
    <div class="col-lg-1 col-md-3 col-sm-6">
    <label> &nbsp; <input type="hidden" name="type" value="antique" /> </label>
      <button type="submit" class="btn btn-go btn-block"> @lang('site.apply') </button>

    </div>
  </form>