@extends('dashboard.app')

@section('title') @lang('site.add_rep') @endsection

@section('styles')
    
    <link href="{{ dashboard('vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">
    <link href="{{asset('templates/maps/style.css')}}" type="text/css" rel="stylesheet">

@endsection


@section('content')
     


<form action="{{ route('admin.rep.store') }}" method="post" data-parsley-validate 
    class="form-horizontal form-label-left" enctype="multipart/form-data">

@csrf

    @foreach ($cols as $col)
        @if($col != 'id' & $col != 'created_at' & $col != 'updated_at' & $col != 'verification_code' 
            
            & $col != 'verified' & $col != 'lang' & $col != 'last_login' & $col != 'total_requests'
            
            & $col != 'rating' & $col != 'api_token' & $col != 'email_verified_at' & $col != 'remember_token'
            
            & $col != 'created_by' & $col != 'city_id' & $col != 'lat' & $col != 'lng' & $col != 'country_id'
            & $col != 'region_id'  & $col != 'address') 

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12"> @lang('site.'.$col)
                @if($col == 'name'  || $col == 'mobile' || $col == 'password')
                    <span class="required">*</span>
                @endif
                </label>
        
                @if($col == 'available_requests')
                    <div class="col-md-2 col-sm-6 col-xs-12">
                @else <div class="col-md-6 col-sm-6 col-xs-12"> @endif

                    @if($col == 'email')
                        <input type="email" name="{{ $col }}" class="form-control" value="{{ old($col) }}">  

                    @elseif($col == 'mobile')
                        <input type="tel" name="{{ $col }}" class="form-control" maxlength="10" value="{{ old($col) }}" required>  

                    @elseif($col == 'available_requests')
                    <input type="number" min="1" name="{{ $col }}" class="form-control" value="{{ old($col) }}"
                        required>  

                    @elseif($col == 'password')
                        <input type="password" name="{{ $col }}" class="form-control" autocomplete="new-password"
                        required>  

                    @elseif($col == 'photo' || $col == 'id_copy' || $col == 'car_license_img' || $col == 'car_img')
                        <input type="file" name="{{ $col }}" >  

                    @elseif($col == 'saudi' || $col == 'active' || $col == 'vip')
                        <label>
                            <input type="radio" class="flat" name="{{ $col }}" value="1"   checked
                            {{ old($col) == 1 ? 'checked' : '' }} required/> @lang('site.yes')
                        </label>

                        <label>
                            <input type="radio" class="flat" name="{{ $col }}" value="0"  
                                {{ old($col) == 0 ? 'checked' : '' }} required/> @lang('site.no')
                        </label>
                    
                    @elseif($col == 'type')
                    <label>
                        <input type="radio" class="flat" name="{{ $col }}" value="individual"  checked
                        {{ old($col) == 'individual' ? 'checked' : '' }} required/> @lang('site.individual')
                    </label>

                    <label>
                        <input type="radio" class="flat" name="{{ $col }}" value="company"  
                            {{ old($col) == 'company' ? 'checked' : '' }} required/> @lang('site.company')
                    </label>

                    @elseif($col == 'status')
                    <label>
                        <input type="radio" class="flat" name="{{ $col }}" value="join_request"
                        {{ old($col) == 'join_request' ? 'checked' : '' }} required/> @lang('site.join_request')
                    </label>

                    <label>
                        <input type="radio" class="flat" name="{{ $col }}" value="activated"  checked
                            {{ old($col) == 'activated' ? 'checked' : '' }} required/> @lang('site.activated')
                    </label>

                    <label>
                        <input type="radio" class="flat" name="{{ $col }}" value="not_activated"  
                            {{ old($col) == 'not_activated' ? 'checked' : '' }} required/> @lang('site.not_activated')
                    </label>

                    <label>
                        <input type="radio" class="flat" name="{{ $col }}" value="rejected"  
                            {{ old($col) == 'rejected' ? 'checked' : '' }} required/> @lang('site.rejected')
                    </label>

                    @elseif($col == 'bank_id')
                    <select name="{{ $col }}" class="form-control">
                        <option value=""> @lang('site.choose_bank') </option>
                        
                        @foreach ($banks as $bank)
                            <option value="{{ $bank->id }}"> {{ $bank['name_'.my_lang()] }} </option>    
                        @endforeach
                    </select>

                    @elseif($col == 'address')
                    <input id="pac-input" class="form-control add-bg" name="address" type="text"
                    placeholder="{{ __('site.find_address') }}" value="{{ old('address') }}">

                    <div id="map" style="width:420px;height: 400px;"></div>
                    <input type="hidden" name="lat"  id="latitude" value="26.420031"/>
                    <input type="hidden" name="lng" id="longitude" value="50.089986"/>
                    
                    @elseif($col == 'car_data') 
                    <textarea name="{{ $col }}" class="form-control"> {{ old($col) }} </textarea>

                    @else
                    <input type="text" name="{{ $col }}" class="form-control" value="{{ old($col) }}"
                    required>                                

                    @endif
                </div>
            </div>

        @endif
    @endforeach
  
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12"> @lang('site.user_role') </label>

        <div class="col-md-9 col-sm-6 col-xs-12">             
                @foreach ($roles as $role)
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <label>                        
                        <input type="checkbox" class="flat" name="role_id[]" value="{{ $role->id }}" />
                        {{ $role['name_'.my_lang()] }}                      
                    </label>                       
                </div>                
                @endforeach             
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12"> @lang('site.country') </label>

        <div class="col-md-6 col-sm-6 col-xs-12">
            <select name="country_id" id="country_id" class="form-control">
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
            <select name="region_id" id="region_id" class="form-control">
                <option value=""> @lang('site.choose_region') </option>
                 
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12"> @lang('site.city') </label>

        <div class="col-md-6 col-sm-6 col-xs-12">            
            <select id="cities" name="city_id" class="form-control">
               
            </select>
        </div>
    </div>

    <div class="ln_solid"></div>
    <div class="form-group">
        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
            <button type="submit" class="btn btn-success"> @lang('site.save') </button>

            <button type="button" onclick="window.location.href='{{ route('admin.reps') }}'" 
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