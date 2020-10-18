@extends('site.app')

@section('title') @lang('site.new_registeration') @endsection

@section('styles')
    <link href="{{asset('templates/maps/style.css')}}" type="text/css" rel="stylesheet">
    
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
                            
                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-8">
                                    <div class="tab-card">
                                        <div class="tab-card-head text-center pb-2">
                                            <h4> @lang('site.new_registeration') </h4>
                                            <p> @lang('site.complete_data_entry') </p>
                                        </div>
                                        <div class="tab-content mt-5">
                                        <form class="row" method="post" action="{{ route('user.signup') }}" enctype="multipart/form-data">
                                            @csrf 
                                            <div class="form-check col-3 mb-3">
                                                <input class="form-check-input" type="radio" name="user_type" id="individual" value="u" 
                                                checked {{ old('user_type') == 'u' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="individual"> @lang('site.individual') </label>
                                            </div>

                                            <div class="form-check col-3 mb-3">
                                                <input class="form-check-input" type="radio" name="user_type" id="company" value="c"
                                                {{ old('user_type') == 'c' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="company"> @lang('site.company') </label>
                                            </div>
                                            
                                            <div class="col-6"></div>
                                            
                                            <div class="form-group">
                                                <div class="custom-file col-4">
                                                    <input type="file" name="photo" >                                                   
                                                </div>
                                            </div>
                                                  
                                            <div class="form-group col-12">
                                                <input type="text" class="form-control" id="name" name="name" 
                                                    placeholder="@lang('site.name')" value="{{ old('name') }}">
                                            </div>

                                            <div class="form-group col-12">
                                                <input type="tel" class="form-control" id="mobile" name="mobile" 
                                                    value="{{ old('mobile') }}" placeholder="@lang('site.mobile')">
                                            </div>
                                            
                                            <div class="form-group col-12">
                                                <input type="password" class="form-control" id="password" name="password" placeholder="@lang('site.password')">
                                            </div>
                                            
                                            <div class="form-group col-12">
                                                <input type="password" class="form-control" id="confirm_password" name="password_confirmation" 
                                                    placeholder="@lang('site.confirm_password')">
                                            </div>
                                            
                                            <div class="form-group col-12">
                                                <input id="pac-input" class="form-control add-bg" name="address" type="text"
                                                    placeholder="{{ __('site.find_address') }}" value="{{ old('address') }}">

                                                <div id="map" style="width:420px;height: 400px;"></div>
                                                <input type="hidden" name="lat"  id="latitude" value="26.420031"/>
                                                <input type="hidden" name="lng" id="longitude" value="50.089986"/>
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
                                <div class="col-md-2"></div>
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
  
<script src="{{site('maps/script.js')}}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDBr8fHyX4CFO0PMq4dxJlhPH8RrjXfyN8&libraries=places&callback=initAutocomplete"
async defer></script>

@endsection