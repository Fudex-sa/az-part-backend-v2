<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="{{ site('assets/css/bootstrap.min.css') }}">
   
  <link rel="stylesheet" href="{{ site('assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ site('assets/css/dev.css') }}">
  <title>{{ config('app.name', 'AZParts') }} | @lang('site.signup_as') </title>
  <link rel="icon" href="{{ site('assets/images/logo.png') }}" type="image/ico"/>

</head>

<body>
<section class="half-background">
  <div class="container-fluid">
    <div class="row ">
      <div class=" col-lg-1 col-md-1">

      </div>
      <div class="col-lg-4 col-md-10  ">
        <div class="sign-box text-center">
        <a href="{{ route('home') }}"> <img src="{{ site('assets/images/sign-logo.png') }}" alt=""> </a>
          <h5> @lang('site.new_registeration')   </h5>
          <h6> @lang('site.choose_signup_type') </h6>
        </div>
        <div class="row  mt-5 text-center">
          <div class="col-md-4">
            <a href="{{ route('user.register') }}">
                <div class="shadow py-4 px-2 rounded">
                <img src="{{ site('assets/images/n-1.png') }}" alt="">
                <h6> @lang('site.as_user_and_company')  </h6>               
                </div>
            </a>
          </div>

          <div class="col-md-4 ">
            <a href="{{ route('seller.register') }}">
                <div class="shadow py-4 px-2 rounded">
                <img src="{{ site('assets/images/n-2.png') }}" alt="">
                <h6> @lang('site.seller_or_broker') </h6>               
                </div>
            </a>
          </div>

          <div class="col-md-4">
            <a href="{{ route('rep.register') }}">
                <div class="shadow py-4 px-2 rounded">
                <img src="{{ site('assets/images/n-3.png') }}" alt="">
                <h6> @lang('site.rep') </h6>             
                </div>
            </a>
          </div>

        </div>
      </div>

    </div>
  </div>
</section>
 

</body>

</html>