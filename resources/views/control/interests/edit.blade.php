
@extends('site.app')

@section('title')  {{__('site.edit')}} |  {{ $item->brand['name_'.my_lang()] .' - '.
            $item->model['name_'.my_lang()] .' - '.$item->year }} @endsection

@section('styles')

@endsection

@section('content')

<section class="profile">
  <div class="container">
    <div class="row">

      @include('layouts.breadcrumb')

      <div class="col-md-12">
        <div class="row">

          @include('layouts.nav_side_menu')

          <div class="col-lg-9 col-md-9  col-12 my-wrap">

            <div class="row">

              <div class="col-md-12">
                <div class="table-responsive">

                  <div class="head-section">
                    <h4> @lang('site.enter_interest_details') </h4>
                  </div>

                  <form class="mt-3 pop-margin row" method="post" action="{{ route('control.user_interests.store',$item->id) }}"
                    enctype="multipart/form-data">
                    @csrf




                    <div class="form-group col-md-4">
                        <label> @lang('site.brand') </label>

                        <select class="form-control select2 " name="brand_id" id="brand_id">
                            <option value=""> @lang('site.choose_brand') </option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}" {{ $item->brand_id == $brand->id ? 'selected' : '' }}
                                    data-image="{{ brand_img($brand->logo) }}"  class="left"> {{ $brand['name_'.my_lang()] }} </option>
                            @endforeach
                            </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label> @lang('site.model') </label>

                        <select class="form-control select2" name="car_model_id" id="model_id">
                            <option value=""> @lang('site.choose_model') </option>
                            @foreach ($models as $model)
                              <option value="{{ $model->id }}" {{ $model->id == $item->car_model_id ? 'selected' : '' }}>
                                 {{ $model['name_'.my_lang()] }} </option>
                            @endforeach
                        </select>
                    </div>


                    <div class="form-group col-md-4">
                        <label> @lang('site.year') </label>

                        <select class="form-control" name="year" id="year">
                            <option value=""> @lang('site.manufacturing_year') </option>
                            @for($i = date('Y')+1  ; $i >= 1970 ; $i--)
                                <option value="{{$i}}" {{ $item->year  == $i ? 'selected' : '' }}
                                >{{$i}}</option>
                            @endfor
                            </select>
                    </div>



                    <div class="form-group col-md-4">
                        <label> @lang('site.country') </label>

                        <select class="form-control" name="country_id" id="country_id">
                            <option value=""> @lang('site.choose_country') </option>
                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}" {{ $item->country_id == $country->id ? 'selected' : '' }} >
                                   {{ $country['name_'.my_lang()] }} </option>
                            @endforeach
                            </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label> @lang('site.region') </label>

                        <select class="form-control" name="region_id" id="region_id">
                            <option value=""> @lang('site.choose_region') </option>
                              @foreach ($regions as $region)
                                  <option value="{{ $region->id }}" {{ $region->id == $item->region_id ? 'selected' : '' }}>
                                     {{ $region['name_'.my_lang()] }} </option>
                              @endforeach
                            </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label> @lang('site.city') </label>

                        <select class="form-control" name="city_id" id="cities">
                            <option value=""> @lang('site.choose_city') </option>
                            @foreach ($cities as $city)
                                  <option value="{{ $city->id }}" {{ $city->id == $item->city_id ? 'selected' : '' }}>
                                     {{ $city['name_'.my_lang()] }} </option>
                              @endforeach
                            </select>
                    </div>

                    {{-- <div class="form-group col-md-4">
                        <label> @lang('site.price') </label>

                        <div class="form-check">
                            <label> <input type="radio" name="price_type" value="fixed" {{ $item->price_type == 'fixed' ? 'checked' : '' }}>
                            @lang('site.fixed_price') </label>

                            <label> <input type="radio" name="price_type" value="fees" {{ $item->price_type == 'fees' ? 'checked' : '' }}>
                            @lang('site.price_on_bidding') </label>
                        </div>
                    </div> --}}


                    {{-- <div class="form-group col-md-4" style="{{ $item->price_type == 'fixed' ? 'block' : 'none' }}" id="price_div">
                      <label> @lang('site.from') </label>

                        <div class="form-check">
                            <input type="number" name="price_from" value="{{ $item->price_from }}" class="form-control" />
                        </div>

                          <label> @lang('site.to') </label>
                        <div class="form-check">
                            <input type="number" name="price_to" value="{{ $item->price_to }}" class="form-control" />
                        </div>
                    </div> --}}

                    <div class="clear-fix"></div>

                    </div>

                    <div class="form-group custom-custom-2 col-md-12">
                      <button type="submit" class="btn btn-next btn-block btn-lg"> @lang('site.save') </button>
                    </div>

                    </form>

                </div>

              </div>
            </div>

          </div>


        </div>
      </div>
    </div>
  </div>
</section>

@endsection

@section('popup')

  @include('control.interests.create')

@endsection

@section('scripts')
  <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

  <script src="{{ site('assets/js/select2.js') }}"></script>

  @include('dashboard.ajax.load_models')
  @include('dashboard.ajax.load_regions')
  @include('dashboard.ajax.load_cities')



  <script>
    $(document).on("click","input[name=price_type]:radio",function(){
        var price_type = $(this).val();

        if(price_type == 'fixed')
          $("#price_div").show();
        else
          $("#price_div").hide();

    });
  </script>

@endsection
