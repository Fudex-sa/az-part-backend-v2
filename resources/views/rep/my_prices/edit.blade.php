
@extends('site.app')

@section('title')  @lang('site.update_delivery_price') @endsection

@section('styles')
    
@endsection

@section('content')

<section class="profile">
  <div class="container">
    <div class="row">

      @include('layouts.breadcrumb')
 
      <div class="col-md-12">
        <div class="row">

          @include('layouts.nav_side_menu')          

          <div class="col-lg-9 col-md-9  col-12" style="margin-top: -66px;">
 
              <form class="row" method="post" action="{{ route('rep.my_price.store',$item->id) }}">
                @csrf 
                
                <div class="form-group col-6">         
                  <label>  @lang('site.tashlih_region') </label>

                  <select name="_from" id="_from" class="form-control">
                    <option value=""> @lang('site.choose_tashlih_region') </option>
                    
                    @foreach ($delivery_regions as $delivery_region)
                        <option value="{{ $delivery_region->id }}" {{ $delivery_region->id == $item->_from ? 'selected' : '' }}>
                           {{ $delivery_region['name_'.my_lang()] }} </option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group col-6">   </div>

                <div class="form-group col-6">    
                  <label>  @lang('site.country') </label>

                  <select name="country_id" id="country_id" class="form-control">
                    <option value=""> @lang('site.choose_country') </option>
                    
                    @foreach (countries() as $country)
                        <option value="{{ $country->id }}" > 
                          {{ $country['name_'.my_lang()] }} </option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group col-6">
                  <label>  @lang('site.region') </label>

                  <select name="region_id" id="region_id" class="form-control">
                    <option value=""> @lang('site.choose_region') </option>
                      
                </select>
                </div>
                
                <div class="form-group col-6">
                  <label>  @lang('site.city') </label>

                  <select id="cities" name="city_id" class="form-control">
                    @foreach (cities($item->city->region['id']) as $city)
                        <option value="{{ $city->id }}" {{ $city->id == $item->city_id ? 'selected' : '' }}>
                           {{ $city['name_'.my_lang()] }} </option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group col-6">
                  <label>  @lang('site.price') </label>
                <input type="number" name="price" min="0" class="form-control" value="{{ $item->price }}"
                      placeholder="@lang('site.price')"/>
                </div>

                <div class="form-group col-12">
                  <label> @lang('site.car_size') </label>
 
                  <div class="col-md-6">                     
                    <label> <input type="checkbox" value="light" name="car_size[]" 
                      @if(in_array('light',$item->car_size)) checked @endif /> @lang('site.light') </label>

                    <label> <input type="checkbox" value="medium" name="car_size[]" 
                      @if(in_array('medium',$item->car_size)) checked @endif /> @lang('site.medium') </label>
                    
                      <label> <input type="checkbox" value="heavy" name="car_size[]" 
                        @if(in_array('heavy',$item->car_size)) checked @endif /> @lang('site.heavy') </label>
                  </div>
                </div>
                
                <div class="form-group col-3">
                    <button type="submit" class="btn btn-dropform btn-block btn-lg mt-2"> @lang('site.save') </button>
                </div>

                </form>
          
        
         
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

 

@endsection
  
@section('scripts')
     
 
    @include('dashboard.ajax.load_regions') 
    @include('dashboard.ajax.load_cities') 
 

@endsection

 