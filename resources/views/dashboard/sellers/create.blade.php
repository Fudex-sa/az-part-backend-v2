@extends('dashboard.app')

@section('title') @lang('site.add_seller') @endsection

@section('styles')
    
    <link href="{{ dashboard('vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">
    <link href="{{asset('templates/maps/style.css')}}" type="text/css" rel="stylesheet">

@endsection


@section('content')
     


<form action="{{ route('admin.seller.store') }}" method="post" 
data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">

@csrf

    @foreach ($cols as $col)
        @if($col != 'id' & $col != 'created_at' & $col != 'updated_at' & $col != 'verification_code'             
            & $col != 'verified' & $col != 'lang' & $col != 'last_login' & $col != 'total_requests'            
            & $col != 'rating' & $col != 'api_token' & $col != 'email_verified_at' & $col != 'remember_token'            
            & $col != 'created_by'   & $col != 'city_id' & $col != 'lat' & $col != 'lng'
            & $col != 'country_id' & $col != 'region_id')

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12"> @lang('site.'.$col)
                @if($col == 'name' || $col == 'email' || $col == 'mobile' || $col == 'password')
                    <span class="required">*</span>
                @endif
                </label>
        
                @if($col == 'available_requests')
                    <div class="col-md-2 col-sm-6 col-xs-12">
                @else <div class="col-md-6 col-sm-6 col-xs-12"> @endif

                    @if($col == 'email')
                        <input type="email" name="{{ $col }}" class="form-control" value="{{ old($col) }}" required>  

                    @elseif($col == 'mobile')
                        <input type="tel" name="{{ $col }}" class="form-control" value="{{ old($col) }}" required>  

                    @elseif($col == 'available_orders')
                    <input type="number" min="0" name="{{ $col }}" class="form-control" value="{{ old($col) }}"
                        required>  

                    @elseif($col == 'password')
                        <input type="password" name="{{ $col }}" class="form-control" required autocomplete="new-password">  

                    @elseif($col == 'photo')
                        <input type="file" name="{{ $col }}" >  

                    @elseif($col == 'saudi' || $col == 'active' || $col == 'vip')
                        <label>
                            <input type="radio" class="flat" name="{{ $col }}" value="1"  
                            {{ old($col) == 1 ? 'checked' : '' }} required/> @lang('site.yes')
                        </label>

                        <label>
                            <input type="radio" class="flat" name="{{ $col }}" value="0"  
                                {{ old($col) == 0 ? 'checked' : '' }} required/> @lang('site.no')
                        </label>
                    

                    @elseif($col == 'user_type')
                        <label>
                            <input type="radio" class="flat" name="{{ $col }}" value="tashalih"  
                                {{ old($col) == 'tashalih' ? 'checked' : '' }} required/> @lang('site.tashalih')
                        </label>

                        <label>
                            <input type="radio" class="flat" name="{{ $col }}" value="manufacturing"  
                                {{ old($col) == 'manufacturing' ? 'checked' : '' }} required/> @lang('site.manufacturing')
                        </label>
                  
                    @elseif($col == 'address')
                    <input id="pac-input" class="form-control add-bg" name="address" type="text"
                    placeholder="{{ __('site.find_address') }}" value="{{ old('address') }}">

                    <div id="map" style="width:420px;height: 400px;"></div>
                    <input type="hidden" name="lat"  id="latitude" value="26.420031"/>
                    <input type="hidden" name="lng" id="longitude" value="50.089986"/>
                    
                    @else
                    <input type="text" name="{{ $col }}" class="form-control" value="{{ old($col) }}">                                

                    @endif
                </div>
            </div>

        @endif
    @endforeach
  
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12"> @lang('site.country') </label>

        <div class="col-md-6 col-sm-6 col-xs-12">
            <select name="country_id" id="country_id" class="form-control" required>
                <option value=""> @lang('site.choose_country') </option>
                
                @foreach (countries() as $country)
                    <option value="{{ $country->id }}"> {{ $country['name_'.my_lang()] }} </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12"> @lang('site.region') </label>

        <div class="col-md-6 col-sm-6 col-xs-12">
            <select name="region_id" id="region_id" class="form-control" required>
                <option value=""> @lang('site.choose_region') </option>
                 
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12"> @lang('site.city') </label>

        <div class="col-md-6 col-sm-6 col-xs-12">            
            <select id="cities" name="city_id" class="form-control" required>
               
            </select>
        </div>
    </div>

    <div class="ln_solid"></div>
    <div class="form-group">
        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
            <button type="submit" class="btn btn-success"> @lang('site.save') </button>

            <button type="button" onclick="window.location.href='{{ route('admin.sellers') }}'" 
            class="btn btn-primary"> @lang('site.cancel') </button>
        </div>
    </div>

</form>
 

@endsection

@section('popup')
 
@endsection

    
@section('scripts')
     
    <script src="{{ dashboard('vendors/iCheck/icheck.min.js') }}" type="text/javascript"></script>
    <script src="{{site('maps/script.js')}}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDBr8fHyX4CFO0PMq4dxJlhPH8RrjXfyN8&libraries=places&callback=initAutocomplete"
    async defer></script>
    
    @include('dashboard.ajax.load_regions') 
    @include('dashboard.ajax.load_cities')
@endsection