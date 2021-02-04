@extends('site.app')

@section('title') @lang('site.new_registeration') @endsection

@section('styles')
    {{-- <link href="{{asset('templates/maps/style.css')}}" type="text/css" rel="stylesheet"> --}}
    
@endsection

@section('content')


<section class="login">
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="white-card shadow">

                    <ul class="nav nav-tabs row" id="myTab" role="tablist">
                        <li class="nav-item col-md-3">
                          <a class="nav-link active activeted"> <span class="badge cir-active">1</span> @lang('site.data') </a>
                        </li>
                        
                        <li class="col-md-6 col-12"><div class="step"></div></li>

                        <li class="nav-item col-md-3">
                          <a class="nav-link"> <span class="badge cir">2</span> @lang('site.confirmation') </a> </li>               
                    </ul>
                      <div class="tab-content" id="myTabContent">
                         
                        <div class="tab-pane fade show active">
                            
                            <div class="row justify-content-center">
                                <div class="col-lg-10">
                                    <div class="tab-card">
                                        <div class="tab-card-head text-center pb-2">
                                            <h4> @lang('site.new_registeration') </h4>
                                            <p> @lang('site.complete_data_entry') </p>
                                        </div>
                                        <div class="tab-content mt-5">
                                        <form class="row" method="post" action="{{ route('seller.signup') }}" enctype="multipart/form-data">
                                            @csrf 
                                            <div class="form-group col-4">
                                                <input class="form-check-input" type="radio" name="user_type" id="broker" value="b"  
                                                checked {{ old('user_type') == 'b' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="broker"> @lang('site.broker') </label>
                                                <i class="fas fa-question-circle"  data-toggle="tooltip" data-placement="top"
                                            title="{{ data('broker_bio') }}"></i>
                                            </div>

                                            <div class="form-group col-4">
                                                <input class="form-check-input" type="radio" name="user_type" id="tashalih" value="t"
                                                {{ old('user_type') == 't' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="tashalih"> @lang('site.tashalih') </label>
                                                <i class="fas fa-question-circle"  data-toggle="tooltip" data-placement="top" title="{{ data('tashlih_bio') }}"></i>
                                            </div>

                                            <div class="form-group col-4">
                                                <input class="form-check-input" type="radio" name="user_type" id="manufacturing" value="m"
                                                {{ old('user_type') == 'm' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="manufacturing"> @lang('site.manufacturing') </label>
                                            <i class="fas fa-question-circle"  data-toggle="tooltip" data-placement="top" title="{{ data('manufacturing_bio') }}"></i>
                                            </div>
                                            
                                              
                                            <div class="form-group">
                                                <div class="custom-file col-4">
                                                    <label> @lang('site.logo') </label>
                                                    <input type="file" name="photo" >                                                   
                                                </div>
                                            </div>
                                                  
                                            <div class="form-group col-12">
                                                <input type="text" class="form-control" id="name" name="name" 
                                                    placeholder="@lang('site.company_name')" value="{{ old('name') }}" maxlength="100">
                                            </div>

                                            <div class="form-group col-12">
                                                <input type="tel" class="form-control" id="mobile" name="mobile" maxlength="9"
                                                minlength="9" value="{{ old('mobile') }}" placeholder="@lang('site.mobile')">
                                            </div>
                                            
                                            <div class="form-group col-12">
                                                <input type="password" class="form-control" id="password" name="password" 
                                                placeholder="@lang('site.password')" autocomplete="new-password" maxlength="100">
                                            </div>
                                            
                                            <div class="form-group col-12">
                                                <input type="password" class="form-control" id="confirm_password" name="password_confirmation" 
                                                    placeholder="@lang('site.confirm_password')" maxlength="100">
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

                                            {{-- <div class="form-group col-12">
                                                <input id="pac-input" class="form-control add-bg" name="address" type="text"
                                                    placeholder="{{ __('site.find_address') }}" value="{{ old('address') }}">

                                                <div id="map" style="width:420px;height: 400px;"></div>
                                                <input type="hidden" name="lat"  id="latitude" value="26.420031"/>
                                                <input type="hidden" name="lng" id="longitude" value="50.089986"/>
                                            </div> --}}
                                             
                                            <div class="form-group col-12">
                                                <select class="form-control" name="tashlih_region" id="tashlih_region">
                                                    <option value=""> @lang('site.choose_tashlih_region') </option>
                                                    
                                                    @foreach ($delvry_regions as $delvry_region)
                                                        <option value="{{ $delvry_region->id }}" {{ old('delvry_region') == $delvry_region->id ? 'selected' : '' }}>
                                                           {{ $delvry_region['name_'.my_lang()] }} </option>    
                                                    @endforeach
            
                                                </select>
                                            </div>


                                            <div class="form-group form-check col-12">
                                                <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                                                <label class="form-check-label" for="exampleCheck1"> @lang('site.agree_to_all') 
                                                    <a href="{{ route('terms') }}"> @lang('site.terms_and_condition') </a>    
                                                    &     
                                                    <a href="{{ route('privacy') }}"> @lang('site.privacy_policy') </a>                                               
                                                </label>
                                            </div>
                                                <button type="submit" class="btn btn-dropform btn-block btn-lg mt-2"> @lang('site.next') </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    
                        </div>

                         
                      </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
    </section>


@endsection

@section('scripts')
  
@include('dashboard.ajax.load_regions') 
@include('dashboard.ajax.load_cities')

{{-- <script src="{{site('maps/script.js')}}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDBr8fHyX4CFO0PMq4dxJlhPH8RrjXfyN8&libraries=places&callback=initAutocomplete"
async defer></script> --}}

<script src="{{site('assets/js/my_scripts.js')}}"></script>

@endsection