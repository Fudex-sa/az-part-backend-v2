<form method="post" class="form-horizontal form-label-left" action="{{ route('admin.supervisor.cities',$item->id) }}" >

    @csrf

<div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12"> @lang('site.country')                
        <span class="required">*</span>                
    </label>

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
    <label class="control-label col-md-3 col-sm-3 col-xs-12"> @lang('site.region')                
        <span class="required">*</span>                
    </label>

    <div class="col-md-6 col-sm-6 col-xs-12"> 
        <select name="region_id" id="region_id" class="form-control">
            <option value=""> @lang('site.choose_region') </option>
             
        </select>
    </div>

</div>

<div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12"> @lang('site.cities')                
        <span class="required">*</span>                
    </label>

    <div class="col-md-6 col-sm-6 col-xs-12"> 
         
        <select id="cities" name="cities[]" class="selectpicker form-control" multiple>
             @if($supervisor->cities)
                @foreach ($supervisor->cities as $myCity)
                    <option value="{{ $myCity->city_id }}"> {{ $myCity->city['name_'.my_lang()] }} </option>
                    
                @endforeach
             @endif
        </select>
         
    </div>

</div>


<div class="ln_solid"></div>
<div class="form-group">
    <div class="col-md-6 col-md-offset-3">
    <button type="button" onclick="location.href='{{ route('admin.supervisors') }}'" class="btn btn-primary"> 
        @lang('site.cancel') </button>

        <button type="submit" class="btn btn-success"> @lang('site.save') </button>
    </div>
</div>

</form>
