
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

          <div class="col-lg-10 col-md-10  col-12">
         
              <div class="tab-pane fade show active" id="profile" role="tabpanel"
                aria-labelledby="profile">
                <div class="row">
                  <div class="col-md-12">
                    
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
                  <div class="col-md-12">
                  <form class="profile-form row mt-3" method="POST" action="{{ route('profile.update') }}"
                  enctype="multipart/form-data">
                      @csrf
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

                      <div class="form-group col-md-4">
                        <select name="country_id" id="country_id" class="form-control pro-input">
                          <option value=""> @lang('site.choose_country') </option>
                          
                          @foreach (countries() as $country)
                              <option value="{{ $country->id }}"> {{ $country['name_'.my_lang()] }} </option>
                          @endforeach
                      </select>
                      </div>

                      <div class="form-group col-md-4">
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

                      <div class="form-group col-md-4">
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

                      <div class="form-group col-12">
                        <input id="pac-input" class="form-control add-bg" name="address" type="text"
                            placeholder="{{ __('site.find_address') }}" value="{{ logged_user()->address }}">

                        <div id="map" style="width:100%;height: 400px;"></div>
                        <input type="hidden" name="lat"  id="latitude" value="26.420031"/>
                        <input type="hidden" name="lng" id="longitude" value="50.089986"/>
                    </div>

                      <div class="form-group col-md-12  offset-md-6">
                        <h3 class="mt-5 mb-2"> @lang('site.change_password') </h3>
                      </div>
                      
                      <div class="form-group col-md-6">
                        <input type="password" name="password" class="form-control pro-input" 
                          placeholder="@lang('site.password')">
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