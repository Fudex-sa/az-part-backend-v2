
@extends('site.app')

@section('title') @lang('site.shipping') @endsection

@section('styles')
    
@endsection

@section('content')

<section class="cart">
    <div class="container">
      <div class="row">
        
        @include('layouts.breadcrumb')

        <div class="col-md-12">
          <div class="white-card  white-card-2">
            <ul class="nav nav-tabs row" id="myTab" role="tablist">
              <li class="nav-item col-lg-4 col-md-4 col-sm-12  after-line after-line-3">

                <a class="nav-link disabled activeted" id="home-tab" data-toggle="tab" href="#home" role="tab"
                  aria-controls="home" aria-selected="true"><span class="badge cir-active">1</span>  @lang('site.items_added')  
                </a>
              </li>

              <li class="col">
                <div class=""></div>
              <li class="nav-item col-lg-4 col-md-4 col-sm-12 after-line-2">
                <a class="nav-link active activeted" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                  aria-controls="profile" aria-selected="false" disabled><span class="badge cir">2</span>  @lang('site.shipping')
                  </a>
              </li>

              <li class="col-lg-1 col-md-1 col-sm-1">
                <div class=""></div>
              </li>
              <li class="nav-item col-lg-2 col-md-2 col-sm-12">
                <a class="nav-link disabled" id="profile-tab-2" data-toggle="tab" href="#profile-2" role="tab"
                  aria-controls="profile-2" aria-selected="false"><span class="badge cir">3</span>  @lang('site.payment')</a>
              </li>

            </ul>
            <div class="tab-content" id="myTabContent">
               

            <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <form class="row" method="POST" action="{{ route('shipping.save') }}">
                    @csrf

                <div class="row mt-5">
                  <div class="col-md-7">
                    <div class="cart-address shadow rounded">
                      <h3> @lang('site.shipping_address')  </h3>

                        <div class="form-group col-12">
                            <select class="form-control" name="country_id" id="country_id">
                                <option value=""> @lang('site.choose_country') </option>
                                @foreach (countries() as $country)
                                    <option value="{{ $country->id }}"> {{ $country['name_'.my_lang()] }} </option>    
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="form-group col-12">
                            <select class="form-control" name="region_id" id="region_id">
                                <option value=""> @lang('site.choose_region') </option>                 
                              </select>
                        </div>
                        <div class="form-group col-12">
                            <select class="form-control" name="city_id" id="cities">
                                <option value=""> @lang('site.choose_city') </option>                 
                              </select>
                        </div>
                       
                        <div class="form-group col-12">
                          <input type="text" class="form-control" name="note" id="note" placeholder="@lang('site.add_note')">
                        </div>
                     
                    </div>
                     
                  </div>
                  <div class="col-md-5">
                    <div class="row">
                      <div class="cart-order shadow col-md-12 rounded">
                        <h3 class="col-md-12"> @lang('site.choose_rep') </h3>
 
                            <div class="col-md-12">
                            <ul class="my-ordar row" id="reps">
                                 
                            </ul>                          
                            </div>
                        
                      </div>
                    </div>
                    <div class="row mt-4">
                      <div class="alert alert-success col-md-12 text-center pt-4 shadow rounded" role="alert">
                        <h5>تم إستخدام كود خصم</h5>
                        <h4 class="pt-2"> <img src="assets/images/ok.png" alt="" class=" pl-2">HANNR15</h4>
                      </div>
                    </div>

                    <div class="cart-details row  p-4 shadow rounded">
                      <h3 class="col-md-12">@lang('site.order_cost')  </h3>

                        <div class="col-md-6"> <h6> @lang('site.parts_total')  </h6> </div>   
                      <div class="col-md-6"> <h6 class="float-left"> {{ sub_total() }}  @lang('site.rs')  </h6> </div>
 
                      <div class="col-md-6"> <h6> @lang('site.total') </h6> </div>
                      <div class="col-md-6"> <h6 class="float-left"> <span> {{ total() }}  @lang('site.rs')  </span> </h6> </div>

                        
                      <div class="col-md-12">
                        <input type="submit" class="btn btn-next btn-block btn-lg" value="@lang('site.continue_purchase')"> 

                      </div>
                    </div>
                  </div>
                </div>
                  
                </form>
            </div>
                      
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
    @include('dashboard.ajax.load_reps')

@endsection