

<form action="{{ route('admin.rep.store',$item->id) }}" method="post" data-parsley-validate 
    class="form-horizontal form-label-left" enctype="multipart/form-data">

    @csrf
    
        @foreach ($cols as $col)
            @if($col != 'id' & $col != 'created_at' & $col != 'updated_at' & $col != 'verification_code' 
                
                & $col != 'verified' & $col != 'lang' & $col != 'last_login' & $col != 'total_requests'
                
                & $col != 'rating' & $col != 'api_token' & $col != 'email_verified_at' & $col != 'remember_token'
                
                & $col != 'created_by' & $col != 'city_id' & $col != 'region_id' & $col != 'lat' & $col != 'lng')
    
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
                            <input type="email" name="{{ $col }}" class="form-control" value="{{ $item->$col }}"
                            required>  
    
                        @elseif($col == 'mobile' || $col == 'phone')
                            <input type="tel" name="{{ $col }}" class="form-control" value="{{ $item->$col }}"
                            required>  
    
                        @elseif($col == 'password')
                            <input type="password" name="{{ $col }}" class="form-control" autocomplete="new-password">  
    
                        @elseif($col == 'available_requests')
                            <input type="number" min="1" name="{{ $col }}" class="form-control" value="{{ $item->$col }}"
                                required>  

                        @elseif($col == 'photo' || $col == 'id_copy' || $col == 'car_license_img' || $col == 'car_img')
                            <input type="file" name="{{ $col }}" >  
    
                        @elseif($col == 'saudi' || $col == 'active' || $col == 'vip')
                            <label>
                                <input type="radio" class="flat" name="{{ $col }}" value="1"  
                                    {{ $item->$col == 1 ? 'checked' : '' }} required/> @lang('site.yes')
                            </label>
    
                            <label>
                                <input type="radio" class="flat" name="{{ $col }}" value="0"  
                                    {{ $item->$col == 0 ? 'checked' : '' }} required/> @lang('site.no')
                            </label>
                            
                            @elseif($col == 'type')
                            <label>
                                <input type="radio" class="flat" name="{{ $col }}" value="individual"  checked
                                {{ $item->$col == 'individual' ? 'checked' : '' }} required/> @lang('site.individual')
                            </label>
        
                            <label>
                                <input type="radio" class="flat" name="{{ $col }}" value="company"  
                                    {{ $item->$col == 'company' ? 'checked' : '' }} required/> @lang('site.company')
                            </label>
        
                            @elseif($col == 'status')
                            <label>
                                <input type="radio" class="flat" name="{{ $col }}" value="join_request"
                                {{ $item->$col == 'join_request' ? 'checked' : '' }} required/> @lang('site.join_request')
                            </label>
        
                            <label>
                                <input type="radio" class="flat" name="{{ $col }}" value="activated"  checked
                                    {{ $item->$col == 'activated' ? 'checked' : '' }} required/> @lang('site.activated')
                            </label>
        
                            <label>
                                <input type="radio" class="flat" name="{{ $col }}" value="not_activated"  
                                    {{ $item->$col == 'not_activated' ? 'checked' : '' }} required/> @lang('site.not_activated')
                            </label>
        
                            <label>
                                <input type="radio" class="flat" name="{{ $col }}" value="rejected"  
                                    {{ $item->$col == 'rejected' ? 'checked' : '' }} required/> @lang('site.rejected')
                            </label>
        
                            @elseif($col == 'bank_id')
                            <select name="{{ $col }}" class="form-control">
                                <option value=""> @lang('site.choose_bank') </option>
                                
                                @foreach ($banks as $bank)
                                    <option value="{{ $bank->id }}" {{ $item->$col == $bank->id ? 'selected' : '' }}>
                                         {{ $bank['name_'.my_lang()] }} </option>    
                                @endforeach
                            </select>
        
                            @elseif($col == 'address')
                            <input id="pac-input" class="form-control add-bg" name="{{ $col }}" type="text"
                            placeholder="{{ __('site.find_address') }}" value="{{ $item->$col }}">
        
                            <div id="map" style="width:420px;height: 400px;"></div>
                            <input type="hidden" name="lat"  id="latitude" value="{{ $item->lat }}"/>
                            <input type="hidden" name="lng" id="longitude" value="{{ $item->lng }}"/>

                        @elseif($col == 'car_data') 
                        <textarea name="{{ $col }}" class="form-control"> {{ $item->$col }} </textarea>
                            
                        @else
                        <input type="text" name="{{ $col }}" class="form-control" value="{{ $item->$col }}">                                
    
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
                            @if(in_array($role->id,$rep_rols))
                                <input type="checkbox" class="flat" name="role_id[]" value="{{ $role->id }}" 
                                checked /> {{ $role['name_'.my_lang()] }}
                            @else
                                <input type="checkbox" class="flat" name="role_id[]" value="{{ $role->id }}" />
                                {{ $role['name_'.my_lang()] }}
                            @endif
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
                    @if($my_regions)
                        @foreach ($my_regions as $region)
                            <option value="{{ $region->id }}" {{ $region->id == $item->region_id ? 'selected' : '' }}>
                                {{ $region['name_'.my_lang()] }} </option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12"> @lang('site.city') </label>

            <div class="col-md-6 col-sm-6 col-xs-12">
                
                <select id="cities" name="city_id" class="form-control">
                    <option value=""> @lang('site.choose_city') </option>
                    @if($myCities)
                        @foreach ($myCities as $myCity)
                            <option value="{{ $myCity->id }}" {{ $myCity->id == $item->city_id ? 'selected' : '' }}>
                                {{ $myCity['name_'.my_lang()] }} </option>
                        @endforeach
                    @endif
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