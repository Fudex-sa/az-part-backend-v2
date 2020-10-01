

 <form action="{{ route('admin.rep.search') }}" method="get" class="form-horizontal form-label-left">
 
        <div class="form-group col-md-5">
            <label class="col-md-5 col-sm-3 col-xs-12"> @lang('site.rep_name') </label>

            <div class="col-md-7 col-sm-6 col-xs-12">
            <input type="text" name="name" class="form-control" value="{{ request()->name }}" />
            </div>
        </div>

        <div class="form-group col-md-5">
            <label class="col-md-5 col-sm-3 col-xs-12"> @lang('site.mobile') </label>

            <div class="col-md-7 col-sm-6 col-xs-12">
            <input type="tel" name="mobile" class="form-control" value="{{ request()->mobile }}"/>
            </div>
        </div>

        <div class="form-group col-md-5">
            <label class="col-md-5 col-sm-3 col-xs-12"> @lang('site.status') </label>

            <div class="col-md-7 col-sm-6 col-xs-12">
                <label> <input type="radio" class="flat" name="status" value="1" checked required/> @lang('site.active') </label>
                <label> <input type="radio" class="flat" name="status" value="0" required/> @lang('site.de_active') </label>
            </div>                               
        </div>

        <div class="form-group col-md-5">
            <label class="col-md-5 col-sm-3 col-xs-12"> @lang('site.country') </label>

            <div class="col-md-7 col-sm-6 col-xs-12">
                <select name="country" id="country_id" class="form-control">
                    <option value=""> @lang('site.choose_country') </option>
                    
                    @foreach (countries() as $country)
                        <option value="{{ $country->id }}" {{ request()->country == $country->id ? 'selected' : '' }}>
                             {{ $country['name_'.my_lang()] }} </option>
                    @endforeach
                </select>
            </div>                               
        </div>


        <div class="form-group col-md-5">
            <label class="col-md-5 col-sm-3 col-xs-12"> @lang('site.region') </label>

            <div class="col-md-7 col-sm-6 col-xs-12">
                <select name="region" id="region_id" class="form-control">
                    <option value=""> @lang('site.choose_region') </option>
                   
                </select>
            </div>                               
        </div>

        <div class="form-group col-md-5">
            <label class="col-md-5 col-sm-3 col-xs-12"> @lang('site.city') </label>

            <div class="col-md-7 col-sm-6 col-xs-12">
                <select id="cities" name="city" class="form-control">
                    <option value=""> @lang('site.choose_city') </option>
                </select>
            </div>                               
        </div>

        <div class="form-group col-md-2">
            <button type="submit" class="btn btn-success"> @lang('site.search') </button>

            <button type="button" onclick="window.location.href='{{ route('admin.reps') }}'" 
            class="btn btn-primary"> @lang('site.all') </button>
        </div>

</form>