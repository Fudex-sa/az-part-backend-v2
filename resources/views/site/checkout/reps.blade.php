
@extends('site.app')

@section('title') @lang('site.available_reps') @endsection

@section('styles')
    
@endsection

@section('content')

<section class="manual-search">
  <div class="container">
    <div class="row">
      @include('layouts.breadcrumb')
       
      <div class="col-md-12">
      <form class="row mt-4 m-form" method="get" action="{{ route('reps.filter') }}">
 
          <div class="col-lg-3 col-md-6 col-sm-6">
              <label > @lang('site.country') </label>
              
              <select class="form-control" name="country" id="country_id">
                <option value=""> @lang('site.choose_country') </option>
                @foreach (countries() as $country)
                    <option value="{{ $country->id }}" @if(request()->country) {{ request()->country == $country->id ? 'selected' : '' }}
                      @elseif(search_session()) {{  search_session()['country'] == $country->id ? 'selected' : '' }} @endif>
                         {{ $country['name_'.my_lang()] }} </option>    
                @endforeach
              </select>
            
          </div>

          <div class="col-lg-2 col-md-6 col-sm-6">            
              <label>  @lang('site.region') </label>
              
              <select class="form-control" name="region" id="region_id">
                <option value=""> @lang('site.choose_region') </option>     
                @foreach ($regions as $region)
                  <option value="{{ $region->id }}" @if(request()->region) {{ request()->region == $region->id ? 'selected' : '' }} 
                    @else {{ search_session()['region'] == $region->id ? 'selected' : '' }} @endif>
                     {{$region['name_'.my_lang()] }} </option>    
                @endforeach            
              </select>             
          </div>

          <div class="col-lg-2 col-md-6 col-sm-6">            
              <label>  @lang('site.city') </label>
              
              <select class="form-control" name="city" id="cities">
                <option value=""> @lang('site.choose_city') </option>  
                
                @foreach ($cities as $city)
                  <option value="{{ $city->id }}" @if(request()->city) {{ request()->city == $city->id ? 'selected' : '' }}
                    @else {{ search_session()['city'] == $city->id ? 'selected' : '' }} @endif>
                     {{$city['name_'.my_lang()] }} </option>    
                @endforeach 
              </select>          
          </div>

          <div class="col-lg-3 col-md-6 col-sm-6">            
              <label>  @lang('site.car_size') </label>
               <br/>

              <label> <input type="radio" name="size" value="light"
                {{ request()->size == 'light' ? 'checked' : '' }}> @lang('site.light') </label>

              <label> <input type="radio" name="size" value="medium" checked
                {{ request()->size == 'medium' ? 'checked' : '' }}> @lang('site.medium') </label>

              <label> <input type="radio" name="size" value="heavy"
                {{ request()->size == 'heavy' ? 'checked' : '' }}> @lang('site.heavy') </label>   
          </div>
          
          <div class="col-lg-2 col-md-6 col-sm-6">
            <br/>
            <button type="submit" class="btn btn-go btn-block btn-lg"> @lang('site.apply') </button>
          </div>

        </form>

      </div>
      

      @foreach ($rep_prices as $rep_price)
        @if(in_array(request()->size ? request()->size : 'medium',$rep_price->car_size))

        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="search-box shadow">
            <div class="s-box-head">
              @if($rep_price->rep->photo)
                  <img src="{{ img_path($rep_price->rep->photo) }}" alt="" class="img-fluid">
              @else <img src="{{ site('assets/images/logo.png') }}" alt="" class="img-fluid" width="65%"> @endif
            </div>
            <div class="s-box-body">
              <h4> {{ $rep_price->rep->name }}  </h4>
              <h6><img src="assets/images/location.png" alt=""> {{ $rep_price->rep->address }}  </h6>
            </div>
            <div class="s-box-footer">
            <a href="{{ route('choose_rep',$rep_price->id) }}" class="btn btn-client float-left">  @lang('site.choose_rep') </a>
              <h6><span> {{ $rep_price->price }} </span> @lang('site.rs')  </h6>
            </div>
          </div>
        </div>

        @endif
      @endforeach
        
       
    </div>

  </div>
</section>


@endsection

@section('scripts')
 
  @include('dashboard.ajax.load_regions') 
  @include('dashboard.ajax.load_cities')

@endsection