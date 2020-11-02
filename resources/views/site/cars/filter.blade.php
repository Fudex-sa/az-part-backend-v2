

<form class="row mt-4 m-form m-form-2" method="GET" action="{{ route('cars.search') }}">
 
    <div class="col-lg-2 col-md-6 col-sm-6">

      <div class="form-group row">
        <label for="city" class="col-md-5"> @lang('site.brand')   </label>

        <select class="form-control col-md-7 select2" name="brand_id" id="brand_id">
            <option value=""> @lang('site.choose_brand') </option>
            @foreach ($brands as $brand)
                <option value="{{ $brand->id }}"
                  data-image="{{ brand_img($brand->logo) }}"  class="left"> {{ $brand['name_'.my_lang()] }} </option>    
            @endforeach
          </select>
      </div>
    </div>
    
    <div class="col-lg-3 col-md-6 col-sm-6">
      <div class="form-group row">
        <label for="city" class="col-md-5"> @lang('site.choose_model') </label>

        <select class="form-control col-md-7" name="model_id" id="model_id">
            <option value=""> @lang('site.choose_model') </option>                
        </select>
      </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6">
      <div class="form-group row">
        <label for="city1" class="col-md-5"> @lang('site.manufacturing_year') </label>

        <select class="form-control col-md-7" name="year" id="year">
        <option value=""> @lang('site.choose_brand') </option>
        @for($i = date('Y')+1  ; $i >= 1970 ; $i--)
            <option value="{{$i}}" {{ app('request')->input('year')  == $i ? 'selected' : '' }}
            >{{$i}}</option>
        @endfor
        </select>
      </div>
    </div>

    <div class="col-lg-2 col-md-6 col-sm-6">
        <label> <input type="radio" name="type" value="damaged" checked /> @lang('site.damaged') </label>

        <label> <input type="radio" name="type" value="antique" checked /> @lang('site.antique') </label>
    </div>
   
    <div class="col-lg-1 col-md-3 col-sm-6">
      <button type="submit" class="btn btn-go btn-block"> @lang('site.apply') </button>

    </div>
  </form>