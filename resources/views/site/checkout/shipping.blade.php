
@extends('site.app')

@section('title') @lang('site.shipping') @endsection

@section('styles')
  
  <link href="{{site('assets/maps/style.css')}}" type="text/css" rel="stylesheet">
    
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
               
                        <div class="form-group col-md-12">
                           <input id="pac-input" class="form-control add-bg" name="address" type="text"
                           placeholder="{{ __('site.find_address') }}" value="{{ old('address') }}">
               
                           <div id="map" style="width:100%;height: 400px;"></div>
                        <input type="hidden" name="latitude"  id="latitude" value="{{ old('lat') ? old('lat') : '26.420031' }}"/>
                        <input type="hidden" name="longitude" id="longitude" value="{{ old('lng') ? old('lng') : '50.089986' }}"/>
                        </div>
                
                        <div class="form-group col-12">
                          <input type="text" class="form-control" name="notes" value="{{ old('notes') }}" 
                            placeholder="@lang('site.add_note')">
                        </div>
                     
                    </div>
                     
                  </div>
                  <div class="col-md-5">
                    <div class="row">
                      <div class="cart-order shadow col-md-12 rounded">
                        <h3 class="col-md-12"> @lang('site.choose_rep') </h3>
 
                            <div class="col-md-12">
                            <ul class="my-ordar row" id="reps">
                                @foreach (reps(old('city_id')) as $r)
                                  <li> <label> 
                                          <input type='radio' name='rep_id' value="{{ $r->id }}" /> {{ $r->name }} 
                                      </label> 
                                  </li>    
                                @endforeach
                            </ul>                          
                            </div>
                        
                      </div>
                    </div>
                    <div class="row mt-4">
                      <div class="alert alert-success col-md-12 text-center pt-4 shadow rounded" role="alert">
                        <h5>تم إستخدام كود خصم</h5>
                        <h4 class="pt-2"> <img src="assets/images/ok.png" alt="" class=" pl-2">HANNR15</h4>
                      </div>
                    </div>

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

    <script src="{{site('maps/script.js')}}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDBr8fHyX4CFO0PMq4dxJlhPH8RrjXfyN8&libraries=places&callback=initAutocomplete"
    async defer></script>

@endsection