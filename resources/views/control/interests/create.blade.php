<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
aria-labelledby="myLargeModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
    <div class="modal-content modal-padding">
    <div class="head-section">
        <h2> @lang('site.enter_interest_details') </h2>
    </div>

<form class="mt-3 pop-margin row" method="post" action="{{ route('control.user_interests.store') }}" enctype="multipart/form-data">
    @csrf





    <div class="form-group col-md-4">
        <label> @lang('site.brand') </label>

        <select class="form-control select2 " name="brand_id" id="brand_id">
            <option value=""> @lang('site.choose_brand') </option>
            @foreach ($brands as $brand)
                <option value="{{ $brand->id }}"
                    data-image="{{ brand_img($brand->logo) }}"  class="left"> {{ $brand['name_'.my_lang()] }} </option>
            @endforeach
            </select>
    </div>

    <div class="form-group col-md-4">
        <label> @lang('site.model') </label>

        <select class="form-control select2" name="car_model_id" id="model_id">
            <option value=""> @lang('site.choose_model') </option>

        </select>
    </div>


    <div class="form-group col-md-4">
        <label> @lang('site.year') </label>

        <select class="form-control" name="year" id="year">
            <option value=""> @lang('site.manufacturing_year') </option>
            @for($i = date('Y')+1  ; $i >= 1970 ; $i--)
                <option value="{{$i}}" {{ old('year')  == $i ? 'selected' : '' }}
                >{{$i}}</option>
            @endfor
            </select>
    </div>

    <div class="form-group col-md-4">
        <label> @lang('site.country') </label>

        <select class="form-control" name="country_id" id="country_id">
            <option value=""> @lang('site.choose_country') </option>
            @foreach ($countries as $country)
                <option value="{{ $country->id }}"> {{ $country['name_'.my_lang()] }} </option>
            @endforeach
            </select>
    </div>

    <div class="form-group col-md-4">
        <label> @lang('site.region') </label>

        <select class="form-control" name="region_id" id="region_id">
            <option value=""> @lang('site.choose_region') </option>

            </select>
    </div>


    <div class="form-group col-md-4">
        <label> @lang('site.city') </label>

        <select class="form-control" name="city_id" id="cities">
            <option value=""> @lang('site.choose_city') </option>
            @foreach ($cities as $city)
                <option value="{{ $city->id }}"> {{ $city['name_'.my_lang()] }} </option>
            @endforeach
            </select>


    </div>

    <div class="form-group col-md-4">
        <label> @lang('site.price') </label>

        <div class="form-check">
            <label> <input type="radio" name="price_type" value="fixed" {{ old('price_type') == 1 ? 'checked' : '' }}>
            @lang('site.fixed_price') </label>

            <label> <input type="radio" name="price_type" value="fees" {{ old('price_type') == 0 ? 'checked' : '' }} checked>
            @lang('site.price_on_bidding') </label>
        </div>
    </div>


    <div class="form-group col-md-4" style="display: none;" id="price_div">
        <label> @lang('site.from') </label>

        <div class="form-check">
            <input type="number" name="price_from" value="{{ old('price') }}" class="form-control" />
        </div>

          <label> @lang('site.to') </label>
        <div class="form-check">
            <input type="number" name="price_to" value="{{ old('price') }}" class="form-control" />
        </div>
    </div>

    <div class="clear-fix"></div>




        <button type="submit" class="btn btn-next btn-block btn-lg"> @lang('site.send') </button>

    </form>
    </div>
</div>
</div>
