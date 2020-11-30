<form action="{{ route('admin.supervisor.store',$item->id) }}" method="post" data-parsley-validate 
    class="form-horizontal form-label-left" enctype="multipart/form-data">

    @csrf
    
        @foreach ($cols as $col)
            @if($col != 'id' & $col != 'created_at' & $col != 'updated_at' & $col != 'verification_code' 
                
                & $col != 'verified' & $col != 'lang' & $col != 'last_login' & $col != 'total_requests'
                
                & $col != 'rating' & $col != 'api_token' & $col != 'email_verified_at' & $col != 'remember_token'
                
                & $col != 'created_by' & $col != 'city_id')

    
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12"> @lang('site.'.$col)
                    @if($col == 'name' || $col == 'mobile' || $col == 'password')
                        <span class="required">*</span>
                    @endif
                    </label>
            
                    @if($col == 'available_requests')
                        <div class="col-md-2 col-sm-6 col-xs-12">
                    @else <div class="col-md-6 col-sm-6 col-xs-12"> @endif

                        @if($col == 'email')
                            <input type="email" name="{{ $col }}" class="form-control" value="{{ $item->$col }}">  
    
                        @elseif($col == 'mobile')
                            <input type="tel" name="{{ $col }}" class="form-control" value="{{ $item->$col }}"
                            required maxlength="10">  
    
                        @elseif($col == 'password')
                            <input type="password" name="{{ $col }}" class="form-control" autocomplete="new-password">  
    
                        @elseif($col == 'available_requests')
                            <input type="number" min="1" name="{{ $col }}" class="form-control" value="{{ $item->$col }}"
                                required>  

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
                                <input type="radio" class="flat" name="{{ $col }}" value="supervisor"  
                                    {{ $item->$col  == 'supervisor' ? 'checked' : '' }} required/> @lang('site.supervisor')
                            </label>

                            <label>
                                <input type="radio" class="flat" name="{{ $col }}" value="admin"  
                                    {{ $item->$col == 'admin' ? 'checked' : '' }} required/> @lang('site.admin')
                            </label>
                                                          
                            
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
                            @if(in_array($role->id,$supervisor_rols))
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
                    
                    @foreach ($countries as $country)
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
    
                <button type="button" onclick="window.location.href='{{ route('admin.supervisors') }}'" 
                class="btn btn-primary"> @lang('site.cancel') </button>
            </div>
        </div>
    
    </form>