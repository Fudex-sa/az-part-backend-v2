
@extends('site.app')

@section('title') @lang('site.payment') @endsection

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
            <div class="tab-content" id="myTabContent">

                     
                       <div class="tab-pane fade show active" id="profile-2" role="tabpanel" aria-labelledby="profile-tab-2">
                      
                        <div class="row mt-5">
                          <div class="col-md-7">
                            <div class="cart-address shadow rounded">
                              <h3> @lang('site.enter_data_to_complete_payment')  </h3>

                              
                              <script src="https://test.oppwa.com/v1/paymentWidgets.js?checkoutId={{$checkoutId}}"></script>
                              
                              <form action="{{url('/resourcePath=/v1/checkouts/'.$checkoutId.'/payment')}}" 
                              class="paymentWidgets" data-brands="VISA MASTER MADA"></form>

                              
                            </div>
                    
                          </div>
                          <div class="col-md-5">
                            
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