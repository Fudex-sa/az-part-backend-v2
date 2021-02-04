
@extends('site.app')

@section('title')  @lang('site.edit') {{ $item->title }} @endsection

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
                    <h4> @lang('site.enter_car_details') </h4>
                  </div>

                  <form class="mt-3 pop-margin row" method="post" action="{{ route('control.car.store',$item->id) }}"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="form-group col-md-8">
                        <label> @lang('site.title') </label>

                    <input type="text" name="title" class="form-control" value="{{ $item->title }}"/>
                    </div>

                    <div class="form-group col-md-4">
                        <label> @lang('site.type') </label>

                        <div class="form-check">
                            <label> <input type="radio" name="type" value="damaged" {{ $item->type == 'damaged' ? 'checked' : '' }} checked>
                            @lang('site.damaged')  </label>

                            <label> <input type="radio" name="type" value="antique" {{ $item->type == 'antique' ? 'checked' : '' }}>
                            @lang('site.antique') </label>
                        </div>
                    </div>

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

                        <select class="form-control select2" name="model_id" id="model_id">
                            <option value=""> @lang('site.choose_model') </option>
                            @foreach ($models as $model)
                              <option value="{{ $model->id }}" {{ $model->id == $item->model_id ? 'selected' : '' }}>
                                 {{ $model['name_'.my_lang()] }} </option>
                            @endforeach
                        </select>
                    </div>


                    <div class="form-group col-md-4">
                        <label> @lang('site.year') </label>

                        <select class="form-control" name="year" id="year">
                            <option value=""> @lang('site.manufacturing_year') </option>
                            @for($i = date('Y')+1  ; $i >= 1900 ; $i--)
                                <option value="{{$i}}" {{ $item->year  == $i ? 'selected' : '' }}
                                >{{$i}}</option>
                            @endfor
                            </select>
                    </div>


                    <div class="form-group col-md-6">
                        <label> @lang('site.color') </label>

                        <input type="text" name="color" class="form-control" value="{{ $item->color }}"/>
                    </div>

                    <div class="form-group col-md-6">
                        <label> @lang('site.kilometers') </label>

                        <input type="number" min="0" name="kilo_no" class="form-control" value="{{ $item->kilo_no }}"/>
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

                    <div class="form-group col-md-4 price-options" style="display: {{ $item->auction == 1 ? 'none' : 'block' }}">
                        <label> @lang('site.price') </label>

                        <div class="form-check">
                            <label> <input type="radio" name="price_type" value="fixed" {{ $item->price_type == 'fixed' ? 'checked' : '' }}>
                            @lang('site.fixed_price') </label>

                            <label> <input type="radio" name="price_type" value="fees" {{ $item->price_type == 'fees' ? 'checked' : '' }}>
                            @lang('site.price_on_bidding') </label>
                        </div>
                    </div>

                     
                    <div class="form-group col-md-4" style="display:{{ $item->price_type == 'fixed' ? 'block' : 'none' }}" id="price_div">
                        <label> @lang('site.price') </label>

                        <div class="form-check">
                            <input type="number" name="price" value="{{ $item->price }}" class="form-control" />
                        </div>
                    </div>


                    <div class="clear-fix"></div>

                  <div class="form-group col-md-6">
                      <label> @lang('site.tenders') </label>

                      <div class="form-check">
                          <label> <input type="radio" name="auction" value="1" {{ $item->auction == 1 ? 'checked' : '' }}>
                           @lang('site.yes') </label>

                          <label> <input type="radio" name="auction" value="0" {{ $item->auction == 0 ? 'checked' : '' }}>
                           @lang('site.no') </label>
                      </div>
                  </div>
 
                  <div class="form-group col-md-4" style="display:{{ $item->date_auction == NULL ? 'none' : 'block' }};" id="auction_div">
                      <label> @lang('site.Auction_time') </label>

                      <div class="form-check">
                          <input type="datetime-local" name="date_auction" value="{{ $item->date_auction }}" class="form-control" />
                      </div>
                  </div>

                    <div class="clear-fix"></div>
 
                    <div class="form-group col-md-6">
                        <label> @lang('site.validatly') </label>

                        <div class="form-check">
                            <label> <input type="radio" name="validatly" value="1" {{ $item->validatly == 1 ? 'checked' : '' }} checked>
                             @lang('site.yes') </label>

                            <label> <input type="radio" name="validatly" value="0" {{ $item->validatly == 0 ? 'checked' : '' }}>
                             @lang('site.no') </label>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label> @lang('site.periodic_inspection_validity') </label>

                        <div class="form-check">
                            <label> <input type="radio" name="examination" value="1" {{ $item->examination == 1 ? 'checked' : '' }}checked>
                            @lang('site.yes') </label>

                            <label> <input type="radio" name="examination" value="0" {{ $item->examination == 0 ? 'checked' : '' }}>
                            @lang('site.no') </label>
                        </div>
                    </div>

                    <div class="form-group col-md-12">
                        <label> @lang('site.notes') </label>

                        <div class="form-check">
                        <input type="text" name="notes"  class="form-control" value="{{ $item->notes }}"/>
                        </div>
                    </div>


                    <div class="form-group custom-custom-2 col-md-12">
                        <div class="row">
                            <div class="custom-file col-md-4 ml-2 car-imgs">
                              <input type="file" class="custom-file-input" id="customFile1" name="imgs[]">
                              <label class="custom-file-label" for="customFile1"></label>
                            </div>

                            <div class="custom-file col-md-3 ml-2 car-imgs">
                              <input type="file" class="custom-file-input" id="customFile2" name="imgs[]">
                              <label class="custom-file-label" for="customFile2"></label>
                            </div>
                            
                            <div class="custom-file col-md-4 car-imgs">
                              <input type="file" class="custom-file-input" id="customFile3" name="imgs[]">
                              <label class="custom-file-label" for="customFile3"></label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group custom-custom-2 col-md-12">
                      <div class="row">
                        @if($item->imgs)
                          @foreach ($item->imgs as $img)
                            <div class="custom-file col-md-4 text-center" style="height: 110px;">
                                <img src="{{ img_path($img->photo) }}" class="img-user"/>
                                <br/>
                                <a onclick="deleteItem({{ $img->id }})" class="btn-delete"><i class="fa fa-trash"></i> </a>
                            </div>
                          @endforeach
                        @endif
                      </div>
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

  @include('control.cars.create')

@endsection

@section('scripts')
  <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

  <script src="{{ site('assets/js/select2.js') }}"></script>

  @include('dashboard.ajax.load_models')
  @include('dashboard.ajax.load_regions')
  @include('dashboard.ajax.load_cities')

  @include('dashboard.ajax.delete',['target'=>'image_car'])

  <script>
    $(document).on("click","input[name=price_type]:radio",function(){
        var price_type = $(this).val();

        if(price_type == 'fixed')
          $("#price_div").show();
        else
          $("#price_div").hide();
    });

    $(document).on("click","input[name=auction]:radio",function(){
        var auction = $(this).val();

        if(auction == 1){ 
          $("#auction_div").show();
          $(".price-options").hide();
        }else{
          $("#auction_div").hide();
          $(".price-options").show();
        }
    });

    $(document).on("click","input[name=type]:radio",function(){
        var type = $(this).val();

        if(type == 'antique'){
          $(".tender").show();
          $("#original_or_not").show();
        }else{ 
          $(".tender").hide();
          $("#auction_div").hide();
          $("#original_or_not").hide();
        }
    });

    $(document).on("click","input[name=original]:radio",function(){
        var original = $(this).val();

        if(original == 0){
          $(".replica_years").show();  
          $(".car-year").hide();        
        }else{ 
          $(".replica_years").hide();          
          $(".car-year").show();
        }
    });

  </script>

@endsection
