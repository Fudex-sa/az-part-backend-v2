
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
                              <style>
                              .cnpBillingCheckoutWrapper {position:relative;}
    .cnpBillingCheckoutHeader {width:100%;border-bottom: 1px solid #c0c0c0;margin-bottom:10px;}
    .cnpBillingCheckoutLeft {width:240px;margin-left: 5px;margin-bottom: 10px;border: 1px solid #c0c0c0;display:inline-block;vertical-align: top;padding:10px;}
    .cnpBillingCheckoutRight {width:50%;margin-left: 5px;border: 1px solid #c0c0c0;display:inline-block;vertical-align: top;padding:10px;}
    .cnpBillingCheckoutOrange {font-size:110%;color: rgb(255, 60, 22);font-weight:bold;}
    div.wpwl-wrapper, div.wpwl-label, div.wpwl-sup-wrapper { width: 100% }
    div.wpwl-group-expiry, div.wpwl-group-brand { width: 30%; float:left }
    div.wpwl-group-cvv { width: 68%; float:left; margin-left:2% }
    div.wpwl-group-cardHolder, div.wpwl-sup-wrapper-street1, div.wpwl-group-expiry { clear:both }
    div.wpwl-sup-wrapper-street1 { padding-top: 1px }
    div.wpwl-wrapper-brand { width: auto }
    div.wpwl-sup-wrapper-state, div.wpwl-sup-wrapper-city { width:32%;float:left;margin-right:2% }
    div.wpwl-sup-wrapper-postcode { width:32%;float:left }
    div.wpwl-sup-wrapper-country { width: 66% }
    div.wpwl-wrapper-brand, div.wpwl-label-brand, div.wpwl-brand { display: none;}
    div.wpwl-group-cardNumber { width:60%; float:left; font-size: 20px;  }
    div.wpwl-group-brand { width:35%; float:left; margin-top:28px }
    div.wpwl-brand-card  { width: 65px }
    div.wpwl-brand-custom  { margin: 0px 5px; background-image: url("https://oppwa.com/v1/paymentWidgets/img/brand.png") }
    .wpwl-wrapper > .wpwl-icon {  right: 300px; left: .5625em; top: 5px; }
 
                              </style>
                              <script>
                              var wpwlOptions = {
                                locale: "{{ my_lang() }}",
                                 style: "plain",
                                 forceCardHolderEqualsBillingName: true,
                                 showCVVHint: true,
                                 brandDetection: true,
                                 onReady: function(){
                                   $(".wpwl-group-cardNumber").after($(".wpwl-group-brand").detach());
                                   $(".wpwl-group-cvv").after( $(".wpwl-group-cardHolder").detach());
                                   var visa = $(".wpwl-brand:first").clone().removeAttr("class").attr("class", "wpwl-brand-card wpwl-brand-custom wpwl-brand-VISA")
                                   var mada = $(".wpwl-brand:first").clone().removeAttr("class").attr("class", "wpwl-brand-card wpwl-brand-custom wpwl-brand-MADA")
                                   var master = $(visa).clone().removeClass("wpwl-brand-VISA").addClass("wpwl-brand-MASTER");
                                   $(".wpwl-brand:first").after( $(mada)).after( $(master)).after( $(visa));
                                 },
                                 onChangeBrand: function(e){
                                   $(".wpwl-brand-custom").css("opacity", "0.3");
                                   $(".wpwl-brand-" + e).css("opacity", "1");
                                 }
                               }
</script>
                              <script src="https://test.oppwa.com/v1/paymentWidgets.js?checkoutId={{$checkoutId}}">


                              </script>

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
