
@extends('site.app')

@section('title') @lang('site.profile') @endsection

@section('styles')

  <link href="{{asset('templates/maps/style.css')}}" type="text/css" rel="stylesheet">
    
@endsection

@section('content')

<section class="profile">
  <div class="container">
    <div class="row">

      @include('layouts.breadcrumb')
 
      <div class="col-md-12">
        <div class="row">

          @include('layouts.nav_side_menu')          

          <div class="col-lg-9 col-md-9  col-12" style="margin-top: -40px;">
         
              <div class="tab-pane fade show active" id="profile" role="tabpanel"
                aria-labelledby="profile">
                <div class="row">
                  <form class="profile-form row" method="POST" action="{{ route('profile.update') }}"
                  enctype="multipart/form-data">
                      @csrf
                      
                  <div class="col-md-3 text-center">
                    
                    <div class="up-img">
                      
                        <input type='file' name="photo" class="imgpo" onchange="readURLL(this);" />
                        <span class="file-hover"> @lang('site.change') </span>
                      
                        @if(logged_user()->photo)
                            <img id="blah" src="{{ img_path(logged_user()->photo) }}" alt="" class="img-fluid">
                        @else
                            <img id="blah" src="{{ site('assets/images/avatar.jpg') }}" alt="" class="img-fluid">
                        @endif
                     
                    </div>

                    <div class="pro-image-upload mt-4">
                      
                      <h5> {{ logged_user()->name }} </h5>
                      <h6> {{ __('site.'.user_type()) }} </h6>
                    </div>
                  </div>
                  <div class="col-md-9">
                   
                        <div class="row">
                          
                          <div class="form-group col-12">
                            <h3 class=""> @lang('site.personal_info') </h3>
                          </div>
                            
                          <div class="form-group col-md-6">
                            <input type="text" name="name" id="name" class="form-control pro-input" placeholder="@lang('site.name')"
                          value="{{ logged_user()->name }}">
                          </div>
                          
                          <div class="form-group col-md-6">
                            <input type="email" name="email" id="email" class="form-control pro-input" placeholder="@lang('site.email')"
                            value="{{ logged_user()->email }}">
                          </div>
    
                          <div class="form-group col-md-6">
                            <input type="tel" name="mobile" id="mobile" class="form-control pro-input" placeholder="@lang('site.mobile')"
                            value="{{ logged_user()->mobile }}">
                          </div>
    
                          <div class="form-group col-md-6">
                            <input type="tel" name="phone" id="phone" class="form-control pro-input" placeholder="@lang('site.phone')"
                            value="{{ logged_user()->phone }}">
                          </div>
    
                          <div class="form-group col-md-6">
                            <select name="country_id" id="country_id" class="form-control pro-input">
                              <option value=""> @lang('site.choose_country') </option>
                              
                              @foreach (countries() as $country)
                                  <option value="{{ $country->id }}" {{ logged_user()->country_id == $country->id ? 'selected' : '' }}>                                    
                                     {{ $country['name_'.my_lang()] }} </option>
                              @endforeach
                          </select>
                          </div>
    
                          <div class="form-group col-md-6">
                            <select name="region_id" id="region_id" class="form-control pro-input">
                              <option value=""> @lang('site.choose_region') </option>
                              @if($regions)
                                  @foreach ($regions as $region)
                                      <option value="{{ $region->id }}" {{ logged_user()->region_id == $region->id ? 'selected' : '' }}>
                                          {{ $region['name_'.my_lang()] }} </option>
                                  @endforeach
                              @endif
                            </select>
                          </div>
    
                          <div class="form-group col-md-6">
                            <select id="cities" name="city_id" class="form-control pro-input">
                              <option value=""> @lang('site.choose_city') </option>
                              @if($cities)
                                  @foreach ($cities as $city)
                                      <option value="{{ $city->id }}" {{ $city->id == logged_user()->city_id ? 'selected' : '' }}>
                                          {{ $city['name_'.my_lang()] }} </option>
                                  @endforeach
                              @endif
                          </select>
                          </div>

                          @if(user_type() == 'seller' || user_type() == 'broker')
                            <div class="form-group col-md-6">
                              <select id="tashlih_region" name="tashlih_region" class="form-control pro-input">
                                <option value=""> @lang('site.choose_tashlih_region') </option>
                               
                                    @foreach ($delivery_regions as $delivery_region)
                                        <option value="{{ $delivery_region->id }}" {{ $delivery_region->id == logged_user()->tashlih_region ? 'selected' : '' }}>
                                            {{ $delivery_region['name_'.my_lang()] }} </option>
                                    @endforeach
                               
                            </select>
                            </div>
                          @endif
    
                          <div class="form-group col-md-12">
                            <input id="pac-input" class="form-control add-bg" name="address" type="text"
                                placeholder="{{ __('site.find_address') }}" value="{{ logged_user()->address }}">
    
                            <div id="map" style="width:100%;height: 400px;"></div>
                            
                          <input type="hidden" name="lat"  id="latitude" value="{{ logged_user()->lat }}"/>
                            <input type="hidden" name="lng" id="longitude" value="{{ logged_user()->lng }}"/>
                        </div>
 
                        <hr class="dashed-hr"/>
                          
                          @if(user_type() == 'rep')
                            <div class="form-group col-md-12">
                              <h3> @lang('site.rep_info') </h3>
                            </div>

                            <div class="form-group col-md-6">
                              <label> @lang('site.national_id') </label>

                              <input type="text" name="national_id" id="national_id" class="form-control pro-input" 
                              value="{{ logged_user()->national_id }}">
                            </div>

                            <div class="form-group col-md-6">
                              <label> @lang('site.id_copy') </label>

                              <input type="file" name="id_copy" id="id_copy" class="form-control pro-input">
                            </div>

                            <div class="form-group col-md-6">
                              <label> @lang('site.bank_id') </label>

                              <select name="bank_id" class="form-control">
                                <option value=""> @lang('site.choose_bank') </option>

                                @foreach ($banks as $bank)
                                  <option value="{{ $bank->id }}" {{ $bank->id == logged_user()->bank_id ? 'selected' : '' }}>
                                     {{ $bank['name_'.my_lang()] }} </option>    
                                @endforeach
                              </select>
                            </div>

                            <div class="form-group col-md-6">
                              <label> @lang('site.car_license_img') </label>

                              <input type="file" name="car_license_img" id="car_license_img" class="form-control pro-input">
                            </div>

                            <div class="form-group col-md-6">
                              <label> @lang('site.car_data') </label>

                              <input type="text" name="car_data" id="car_data" class="form-control pro-input" 
                                placeholder="@lang('site.car_info')" value="{{ logged_user()->car_data }}">
                            </div>

                            <div class="form-group col-md-6">
                              <label> @lang('site.car_img') </label>

                              <input type="file" name="car_img" id="car_img" class="form-control pro-input">
                            </div>

                              <hr class="dashed-hr"/>
                          @endif

                          <div class="form-group col-md-6">
                            <h3 class=""> @lang('site.change_password') </h3>
                          </div>
                          
                          <div class="form-group col-md-6"></div>
                          
                          <div class="form-group col-md-6">
                            <input type="password" name="password" class="form-control pro-input" 
                              placeholder="@lang('site.password')" autocomplete="new-password">
                          </div>
                          <div class="form-group col-md-6">
                            <input type="password" name="confirm_password" class="form-control pro-input" 
                              placeholder="@lang('site.confirm_password')">
                          </div>
 
                         
                        <div class="form-group col-md-12 text-center">
                          <button type="submit" class="btn btn-save col-md-3"> @lang('site.save') </button>
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

@section('scripts')

    <script src="{{ site('assets/js/bootstrap-input-spinner.js') }}"></script>
    <script>
      $("input[type='number']").inputSpinner()
    </script>

    <script src="{{site('maps/script.js')}}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDBr8fHyX4CFO0PMq4dxJlhPH8RrjXfyN8&libraries=places&callback=initAutocomplete"
    async defer></script>

    @include('dashboard.ajax.load_regions') 
    @include('dashboard.ajax.load_cities')

@endsection