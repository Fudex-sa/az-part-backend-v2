
@extends('site.app')

@section('title') @lang('site.payment_method') @endsection

@section('styles')

@endsection

@section('content')

<section class="cart">
    <div class="container">
      <div class="row">

        @include('layouts.breadcrumb')

        <div class="col-md-12">
          <div class="white-card  white-card-2">

            @if(request()->type != 'package')
            <ul class="nav nav-tabs row" id="myTab" role="tablist">

              <li class="nav-item col-lg-4 col-md-4 col-sm-12 after-line  after-line-3">
                <a class="nav-link disabled activeted" id="home-tab" data-toggle="tab" href="#home" role="tab"
                  aria-controls="home" aria-selected="true"><span class="badge cir-active">1</span> @lang('site.items_added')
                </a>
              </li>

              <li class="col">
                <div class=""></div>
              <li class="nav-item col-lg-4 col-md-4 col-sm-12 after-line-2  after-line-3">
                <a class="nav-link disabled activeted" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                  aria-controls="profile" aria-selected="false" disabled><span class="badge cir-active">2</span>  @lang('site.shipping')
                </a>
              </li>

              <li class="col-lg-1 col-md-1 col-sm-1">
                <div class=""></div>
              </li>
              
              <li class="nav-item col-lg-2 col-md-2 col-sm-12">
                <a class="nav-link active activeted" id="profile-tab-2" data-toggle="tab" href="#profile-2" role="tab"
                  aria-controls="profile-2" aria-selected="false"><span class="badge cir">3</span> @lang('site.payment') </a>
              </li>

            </ul>
            @else
            <ul class="nav nav-tabs row" id="myTab" role="tablist">

              <li class="nav-item col-lg-4 col-md-4 col-sm-12 after-line  after-line-3">
                <a class="nav-link disabled activeted" id="home-tab" data-toggle="tab" href="#home" role="tab"
                  aria-controls="home" aria-selected="true"><span class="badge cir-active">1</span> @lang('site.choose_package')
                </a>
              </li>

              <li class="col-lg-1"> </li>

                <div class=""></div>
              <li class="nav-item col-lg-4 col-md-4 col-sm-12">
                <a class="nav-link disabled activeted" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                  aria-controls="profile" aria-selected="false" disabled><span class="badge cir-active">2</span>  @lang('site.payment')
                </a>
              </li>
 
            </ul>
            @endif

            <div class="tab-content" id="myTabContent">


                       <div class="tab-pane fade show active" id="profile-2" role="tabpanel" aria-labelledby="profile-tab-2">

                        <div class="row mt-5">
                          <div class="col-md-7">
                            <div class="cart-address shadow rounded">
                              <h3> @lang('site.please_choose_payment_method')  </h3>

                              <br/> 
                              <form method="get" action="{{ route('payment.choose') }}" class="row">
                                @if(request()->type == 'package')

                                    @foreach (payment_methods() as $payment_method)

                                      @if($payment_method->keyword != 'cash')

                                        <div class="form-group col-12">
                                        <label for="{{ $payment_method->id }}">
                                          <input id="{{ $payment_method->id }}" type="radio" name="method" value="{{ $payment_method->keyword }}" checked required>
                                              {{ $payment_method['name_'.my_lang()] }}

                                              <img src="{{ img_path($payment_method->logo) }}" class="payment_logos"/>
                                          </label>

                                          <br/>
                                          <p class="pay_hint"> {{ $payment_method['description_ar_'.my_lang()] }}  </p>
                                      </div>    
                                      @endif
                                  @endforeach

                                @else

                                @foreach (payment_methods() as $payment_method)

                                  {{-- @if(request()->type != 'package' & $payment_method->keyword != 'cash') --}}

                                    <div class="form-group col-12">
                                    <label for="{{ $payment_method->id }}">
                                      <input id="{{ $payment_method->id }}" type="radio" name="method" value="{{ $payment_method->keyword }}" checked required>
                                          {{ $payment_method['name_'.my_lang()] }}

                                          <img src="{{ img_path($payment_method->logo) }}" class="payment_logos"/>
                                      </label>

                                      <br/>
                                          <p class="pay_hint"> {{ $payment_method['description_'.my_lang()] }}  </p>
                                  </div>    
                                  {{-- @endif --}}
                                @endforeach
                                 
                                  @endif

                                <div class="col-md-12">
                                    
                                
                                  <div class="col-md-12">
                                    @if(total() > 0)
                                      <input type="submit" class="btn btn-next btn-block btn-lg" value="@lang('site.continue_purchase')">
                                    @else

                                      <p class="required text-center"> {{ data('min_order_cost') }} </p>
                                    @endif
                                  </div>


                              </form>
                            </div>

                          </div>
                        </div>
                      
                            <div class="col-md-5">

                            @include('site.checkout.coupon')


                            @if(! session()->get('coupon') & request()->type == 'package')
                              <div class="cart-details row  p-4 shadow rounded">
                                <h3 class="col-md-12"> @lang('site.coupon')  </h3>

                              <form method="post" action="{{ route('coupon.use') }}" class="row">
                                    @csrf
                                    <div class="form-group col-md-9">
                                      <input type="text" name="code" class="form-control" placeholder="@lang('site.enter_coupon')" required>
                                    </div>
                                    <div class="form-group col-md-3">
                                      <input type="submit" value="@lang('site.use_now')" class="btn btn-primary" />
                                    </div>
                                  </form>
                              </div>
                            @endif

                            <br/>

                            <div class="cart-details row  p-4 shadow rounded">

                              @include('site.checkout.sammary')

                            </div>
                          </div>
                          
                        </div>

                  </div>
            </div>
          </div>
        </div>
      </div>

    </div>
 
  </section>





@endsection

@section('scripts')

@endsection
