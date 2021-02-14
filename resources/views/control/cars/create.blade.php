
@extends('site.app')

@section('title') @lang('site.add_car')  @endsection

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

          <div class="col-lg-9 col-md-9  col-12" style="margin-top: -120px;">

            <div class="row">
              <div class="col-md-12">
                <div class="btn-add-container float-left" style="margin-bottom: 10px;">
                  <a class="btn btn-save" href="{{ route('control.cars') }}">
                    <i class="fa fa-list"></i> @lang('site.my_cars')
                  </a>

                </div>
              </div>
              <div class="col-md-12">

                <div class="head-section">
                     
                    <h3> @lang('site.enter_car_details') </h3>
                </div>

                <form class="mt-3 pop-margin row" method="post" action="{{ route('control.car.store') }}" enctype="multipart/form-data">
                    @csrf
                
                    <div class="form-group col-md-8">
                        <label> @lang('site.title') </label>
                
                    <input type="text" name="title" class="form-control" value="{{ old('title') }}"/>
                    </div>
                
                    <div class="form-group col-md-4">
                        <label> @lang('site.type') </label>
                
                        <div class="form-check">
                            <label> <input type="radio" name="type" value="damaged" {{ old('type') == 'damaged' ? 'checked' : '' }} checked>
                            @lang('site.damaged')  </label>
                
                            <label> <input type="radio" name="type" value="antique" {{ old('type') == 'antique' ? 'checked' : '' }}>
                            @lang('site.antique') </label>
                        </div>
                    </div>
                
                    <div class="form-group col-md-4" id="original_or_not" style="display: none;">
                        <label> @lang('site.original_replica') </label>
                
                        <div class="form-check">
                            <label> <input type="radio" name="original" value="1" checked >
                            @lang('site.original') </label>
                
                            <label> <input type="radio" name="original" value="0"   >
                            @lang('site.replica') </label>
                        </div>
                    </div>
                
                    <div class="form-group col-md-4 replica_years" style="display: none;">
                        <label> @lang('site.original_manufacture_year') </label>
                
                        <select class="form-control" name="original_year">            
                            @for($i = date('Y')+1  ; $i >= 1900 ; $i--)
                                <option value="{{$i}}" {{ old('original_year')  == $i ? 'selected' : '' }}
                                >{{$i}}</option>
                            @endfor
                        </select>
                    </div>
                
                    <div class="form-group col-md-4 replica_years" style="display: none;">
                        <label> @lang('site.replica_manufacture_year') </label>
                
                        <select class="form-control" name="replica_year">            
                            @for($i = date('Y')+1  ; $i >= 1900 ; $i--)
                                <option value="{{$i}}" {{ old('replica_year')  == $i ? 'selected' : '' }}
                                >{{$i}}</option>
                            @endfor
                        </select>
                    </div>
                
                     
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
                
                        <select class="form-control select2" name="model_id" id="model_id">
                            <option value=""> @lang('site.choose_model') </option>
                
                        </select>
                    </div>
                
                
                    <div class="form-group col-md-4 car-year">
                        <label> @lang('site.year') </label>
                
                        <select class="form-control" name="year" id="year">
                            <option value=""> @lang('site.manufacturing_year') </option>
                            @for($i = date('Y')+1  ; $i >= 1900 ; $i--)
                                <option value="{{$i}}" {{ old('year')  == $i ? 'selected' : '' }}
                                >{{$i}}</option>
                            @endfor
                        </select>
                    </div>
                
                
                    <div class="form-group col-md-6">
                        <label> @lang('site.color') </label>
                
                        <input type="text" name="color" class="form-control" value="{{ old('color') }}"/>
                    </div>
                
                    <div class="form-group col-md-6">
                        <label> @lang('site.kilometers') </label>
                
                        <input type="number" min="0" name="kilo_no" class="form-control" value="{{ old('kilo_no') }}"/>
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
                
                            </select>
                    </div>
                
                    {{-- <div class="form-group col-md-6">
                        <label> @lang('site.tenders') </label>
                
                        <div class="form-check">
                            <label> <input type="radio" name="auction" value="1" {{ old('auction') == 1 ? 'checked' : '' }}>
                             @lang('site.yes') </label>
                
                            <label> <input type="radio" name="auction" value="0" checked>
                             @lang('site.no') </label>
                        </div>
                    </div> --}}
                
                    <div class="form-group col-md-4  price-options" style="display: {{ old('auction') == 1 ? 'none' : 'block' }}">
                        <label> @lang('site.price') </label>
                
                        <div class="form-check">
                            <label> <input type="radio" name="price_type" value="fixed" {{ old('price_type') == 1 ? 'checked' : '' }}>
                            @lang('site.fixed_price') </label>
                
                            <label> <input type="radio" name="price_type" value="fees" {{ old('price_type') == 0 ? 'checked' : '' }} checked>
                            @lang('site.price_on_bidding') </label>
                        </div>
                    </div>
                
                
                    <div class="form-group col-md-4" style="display: none;" id="price_div">
                        <label> @lang('site.price') </label>
                
                        <div class="form-check">
                            <input type="number" name="price" value="{{ old('price') }}" class="form-control" />
                        </div>
                    </div>
                
                      <div class="clear-fix"></div>
                
                    <div class="form-group col-md-6 tender" style="{{ old('type') == 'antique' ? 'display:block;' : 'display:none;' }}">
                        <label> @lang('site.tenders') </label>
                
                        <div class="form-check">
                            <label> <input type="radio" name="auction" value="1" {{ old('auction') == 1 ? 'checked' : '' }} checked>
                             @lang('site.yes') </label>
                
                            <label> <input type="radio" name="auction" value="0" {{ old('auction') == 0 ? 'checked' : '' }}>
                             @lang('site.no') </label>
                        </div>
                    </div>
                
                    <div class="form-group col-md-4" style="display: none;" id="auction_div">
                        <label> @lang('site.Auction_time') </label>
                
                        <div class="form-check">
                            <input type="datetime-local" name="date_auction" value="{{ old('date_auction') }}" class="form-control" />
                        </div>
                    </div>
                
                    <div class="clear-fix"></div>
                
                    <div class="form-group col-md-6">
                        <label> @lang('site.validatly') </label>
                
                        <div class="form-check">
                            <label> <input type="radio" name="validatly" value="1" {{ old('validatly') == 1 ? 'checked' : '' }} checked>
                             @lang('site.yes') </label>
                
                            <label> <input type="radio" name="validatly" value="0" {{ old('validatly') == 0 ? 'checked' : '' }}>
                             @lang('site.no') </label>
                        </div>
                    </div>
                
                    <div class="form-group col-md-6">
                        <label> @lang('site.periodic_inspection_validity') </label>
                
                        <div class="form-check">
                            <label> <input type="radio" name="examination" value="1" {{ old('examination') == 1 ? 'checked' : '' }}checked>
                            @lang('site.yes') </label>
                
                            <label> <input type="radio" name="examination" value="0" {{ old('examination') == 0 ? 'checked' : '' }}>
                            @lang('site.no') </label>
                        </div>
                    </div>
                
                    <div class="form-group col-md-12">
                        <label> @lang('site.notes') </label>
                
                        <div class="form-check">
                        <input type="text" name="notes"  class="form-control" value="{{ old('notes') }}"/>
                        </div>
                    </div>
                
                    <div class="form-group custom-custom-2 col-md-12">
                        <label> @lang('site.car_images') </label> <br/>
                        
                        <div class="row">
                            <div class="custom-file col-md-4 car-imgs">
                                <div class="upload-file">
                                    <label for="customFile1"  class="upload-file-label">
                                        <img class="prev" src="{{ site('assets/images/upload.png') }}">
                                    </label>
                                    <input type="file" name="imgs[]" id="customFile1" class="custom-file-input inputfile" />
                                </div>
                            </div>
                            <div class="custom-file col-md-4 car-imgs">
                                <div class="upload-file">
                                    <label for="customFile2"  class="upload-file-label">
                                        <img class="prev" src="{{ site('assets/images/upload.png') }}">
                                    </label>
                                    <input type="file" name="imgs[]" id="customFile2" class="custom-file-input inputfile" />
                                </div>
                            </div>
                            <div class="custom-file col-md-4 car-imgs">
                                <div class="upload-file">
                                    <label for="customFile3"  class="upload-file-label">
                                        <img class="prev" src="{{ site('assets/images/upload.png') }}">
                                    </label>
                                    <input type="file" name="imgs[]" id="customFile3" class="custom-file-input inputfile" />
                                </div>
                            </div>
                        </div>
                    </div>
                
                
                    {{-- <div class="form-group custom-custom-2 col-md-12">
                        <label> @lang('site.car_images') </label> <br/>
                        <div class="row">
                             
                            <div class="custom-file col-md-4">
                            <input type="file" name="imgs[]">
                           </div>
                            <div class="custom-file col-md-4">
                            <input type="file"  name="imgs[]">
                            </div>
                            <div class="custom-file col-md-4">
                            <input type="file"  name="imgs[]">
                            </div>
                        </div>
                    </div> --}}
                
                    <div class="form-group col-md-12">
                        <div class="form-check">
                            <label> <input type="radio" required> {{ data('cars_agrement') }} </label>
                
                        </div>
                    </div>
                
                        <button type="submit" class="btn btn-next btn-block btn-lg"> @lang('site.send') </button>
                
                    </form>



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

  

@endsection

@section('scripts')
  <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

  <script src="{{ site('assets/js/select2.js') }}"></script>

  @include('dashboard.ajax.load_models')
  @include('dashboard.ajax.load_regions')
  @include('dashboard.ajax.load_cities')

  @include('dashboard.ajax.delete',['target'=>'car'])

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
          $(".replica_years").hide();  
          $(".car-year").show();
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
   <script>
        // upload image
        function readURL(input) {
            var id = $(input).attr("id");
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {

                    $('label[for="' + id + '"] .prev').attr('src', e.target.result).show();
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $(".inputfile").change(function () {
            readURL(this);
        });
    </script>

@endsection

 