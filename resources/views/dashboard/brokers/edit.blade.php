

<form action="{{ route('admin.broker.store',$item->id) }}" method="post" enctype="multipart/form-data"
     data-parsley-validate class="form-horizontal form-label-left">

    @csrf
    
        @foreach ($cols as $col)
        @if($col != 'id' & $col != 'created_at' & $col != 'updated_at' & $col != 'verification_code' 
                
        & $col != 'verified' & $col != 'lang' & $col != 'last_login' & $col != 'total_requests'
        
        & $col != 'rating' & $col != 'api_token' & $col != 'email_verified_at' & $col != 'remember_token'
        
        & $col != 'created_by' & $col != 'city_id' & $col != 'region_id' & $col != 'lat' & $col != 'lng'
        & $col != 'country_id')
    
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12"> @lang('site.'.$col)
                    @if($col == 'name'  || $col == 'mobile' || $col == 'password')
                        <span class="required">*</span>
                    @endif
                    </label>
            
                    @if($col == 'available_orders' || $col == 'special_stores_no')
                        <div class="col-md-2 col-sm-6 col-xs-12">
                    @else <div class="col-md-6 col-sm-6 col-xs-12"> @endif

                        @if($col == 'email')
                            <input type="email" name="{{ $col }}" class="form-control" value="{{ $item->$col }}">  
    
                        @elseif($col == 'mobile')
                            <input type="tel" name="{{ $col }}" class="form-control" value="{{ $item->$col }}"
                            required maxlength="10">  
    
                        @elseif($col == 'password')
                            <input type="password" name="{{ $col }}" class="form-control" autocomplete="new-password">  
    
                        @elseif($col == 'available_orders' || $col == 'special_stores_no')
                            <input type="number" min="0" name="{{ $col }}" class="form-control" value="{{ $item->$col }}">  

                        @elseif($col == 'photo')
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
                            
                        @elseif($col == 'user_type')
                            <label>
                                <input type="radio" class="flat" name="{{ $col }}" value="tashalih"  
                                    {{ $item->$col  == 'tashalih' ? 'checked' : '' }} required/> @lang('site.tashalih')
                            </label>

                            <label>
                                <input type="radio" class="flat" name="{{ $col }}" value="manufacturing"  
                                    {{ $item->$col == 'manufacturing' ? 'checked' : '' }} required/> @lang('site.manufacturing')
                            </label>
                        
                        @elseif($col == 'address')
                            <input id="pac-input" class="form-control add-bg" name="address" type="text"
                            placeholder="{{ __('site.find_address') }}" value="{{ old('address') }}">
        
                            <div id="map" style="width:420px;height: 400px;"></div>
                            <input type="hidden" name="lat"  id="latitude" value="26.420031"/>
                            <input type="hidden" name="lng" id="longitude" value="50.089986"/>
                             

                        @elseif($col == 'tashlih_region')
                            <select class="form-control" name="{{ $col }}">
                                <option value=""> @lang('site.choose_region') </option>
                                @foreach ($delivery_regions as $dr)
                                    <option value="{{ $dr->id }}" {{ $item->tashlih_region == $dr->id ? 'selected' : '' }}>
                                         {{ $dr['name_'.my_lang()] }} </option>
                                @endforeach
                            </select>

                        @else
                        <input type="text" name="{{ $col }}" class="form-control" value="{{ $item->$col }}">                                
    
                        @endif
                    </div>
                </div>
    
            @endif
        @endforeach
        
    
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
                    @if($regions)
                        @foreach ($regions as $region)
                            <option value="{{ $region->id }}">
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
                    @if($region_cities)
                        @foreach ($region_cities as $region_city)
                            <option value="{{ $region_city->id }}" {{ $region_city->id == $item->city_id ? 'selected' : '' }}>
                                {{ $region_city['name_'.my_lang()] }} </option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>

        <div class="ln_solid"></div>
        <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <button type="submit" class="btn btn-success"> @lang('site.save') </button>
    
                <button type="button" onclick="window.location.href='{{ route('admin.brokers') }}'" 
                class="btn btn-primary"> @lang('site.cancel') </button>
            </div>
        </div>
    
    </form>