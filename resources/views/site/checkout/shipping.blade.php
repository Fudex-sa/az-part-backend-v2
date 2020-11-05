
@extends('site.app')

@section('title') @lang('site.shipping') @endsection

@section('styles')
  
  <link href="{{site('maps/style.css')}}" type="text/css" rel="stylesheet">
    
@endsection

@section('content')

<section class="cart">
    <div class="container">
      <div class="row">
        
        @include('layouts.breadcrumb')

        <div class="col-md-12">
          <div class="white-card  white-card-2">
            <ul class="nav nav-tabs row" id="myTab" role="tablist">
              <li class="nav-item col-lg-4 col-md-4 col-sm-12  after-line after-line-3">

                <a class="nav-link disabled activeted" id="home-tab" data-toggle="tab" href="#home" role="tab"
                  aria-controls="home" aria-selected="true"><span class="badge cir-active">1</span>  @lang('site.items_added')  
                </a>
              </li>

              <li class="col">
                <div class=""></div>
              <li class="nav-item col-lg-4 col-md-4 col-sm-12 after-line-2">
                <a class="nav-link active activeted" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                  aria-controls="profile" aria-selected="false" disabled><span class="badge cir">2</span>  @lang('site.shipping')
                  </a>
              </li>

              <li class="col-lg-1 col-md-1 col-sm-1">
                <div class=""></div>
              </li>
              <li class="nav-item col-lg-2 col-md-2 col-sm-12">
                <a class="nav-link disabled" id="profile-tab-2" data-toggle="tab" href="#profile-2" role="tab"
                  aria-controls="profile-2" aria-selected="false"><span class="badge cir">3</span>  @lang('site.payment')</a>
              </li>

            </ul>
            <div class="tab-content" id="myTabContent">
               

            <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <form class="row" method="POST" action="{{ route('shipping.save') }}">
                    @csrf

                <div class="row mt-5">
                  <div class="col-md-7">
                    <div class="cart-address shadow rounded">
                      <h3> @lang('site.shipping_address')  </h3>

                      <div class="form-group col-12">
                        <label class="col-3"> @lang('site.shipping_size') : </label>

                          <label> <input type="radio" name="size" value="light"
                            {{ old('size') == 'light' ? 'checked' : '' }}> @lang('site.light') </label>

                          <label> <input type="radio" name="size" value="medium" checked
                            {{ old('size') == 'medium' ? 'checked' : '' }}> @lang('site.medium') </label>

                          <label> <input type="radio" name="size" value="heavy"
                            {{ old('size') == 'heavy' ? 'checked' : '' }}> @lang('site.heavy') </label>                      
                      </div>
                      
                      <div class="form-group col-12">
                          <label class="col-3"> @lang('site.spare') : </label>

                          <label> <input type="radio" name="with_oil" value="1"
                            {{ old('with_oil') == 1 ? 'checked' : '' }}> @lang('site.with_oil') </label>

                          <label> <input type="radio" name="with_oil" value="0" checked
                            {{ old('with_oil') == 0 ? 'checked' : '' }}> @lang('site.without_oil') </label>
                      </div>

                        <div class="form-group col-12">
                            <select class="form-control" name="country_id" id="country_id">
                                <option value=""> @lang('site.choose_country') </option>
                                
                                @foreach (countries() as $country)
                                    <option value="{{ $country->id }}" {{ old('country_id') == $country->id ? 'selected' : '' }}>
                                       {{ $country['name_'.my_lang()] }} </option>    
                                @endforeach

                            </select>
                        </div>
                        
                        <div class="form-group col-12">
                            <select class="form-control" name="region_id" id="region_id">
                                <option value=""> @lang('site.choose_region') </option>    
                                  
                                  @foreach (regions(old('country_id')) as $reg)
                                    <option value="{{ $reg->id }}" {{ old('region_id') == $reg->id ? 'selected' : '' }}>
                                       {{ $reg['name_'.my_lang()] }} </option>
                                  @endforeach             

                              </select>
                        </div>
                        <div class="form-group col-12">
                            <select class="form-control" name="city_id" id="cities">
                                <option value=""> @lang('site.choose_city') </option>    
                                             
                                @foreach (cities(old('city_id')) as $cit)
                                    <option value="{{ $cit->id }}" {{ old('city_id') == $cit->id ? 'selected' : '' }}>
                                       {{ $cit['name_'.my_lang()] }} </option>
                                  @endforeach 

                              </select>
                        </div>
                       
                        <div class="form-group col-md-12">
                          <input type="text" class="form-control" name="street" value="{{ old('street') }}" 
                          placeholder="@lang('site.building_number')">
                        </div>
                
                
                        <div class="form-group col-12">
                          <input type="text" class="form-control" name="notes" value="{{ old('notes') }}" 
                            placeholder="@lang('site.add_note')">
                        </div>
                     
                    </div>
                     
                  </div>
                  <div class="col-md-5">
                     

                    @include('site.checkout.coupon')

                    <div class="cart-details row  p-4 shadow rounded">
                      
                      @include('site.checkout.sammary')

                      <div class="col-md-12">
                        <input type="submit" class="btn btn-next btn-block btn-lg" value="@lang('site.continue_purchase')"> 
                      </div>
                      
                    </div>
                  </div>
                </div>
                  
                </form>
            </div>
                      
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>
 

 
@endsection

@section('scripts')

    @include('dashboard.ajax.load_regions') 
    @include('dashboard.ajax.load_cities')
    @include('dashboard.ajax.load_reps')
    @include('dashboard.ajax.choose_rep')
    @include('dashboard.ajax.with_oil_cost')

    <script src="{{site('maps/script.js')}}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDBr8fHyX4CFO0PMq4dxJlhPH8RrjXfyN8&libraries=places&callback=initAutocomplete"
    async defer></script>
 
@endsection