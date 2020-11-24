<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="{{ site('assets/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ site('assets/css/all.min.css') }}">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="{{ site('assets/css/slick.css') }}">
  <link rel="stylesheet" href="{{ site('assets/css/slick-theme.css') }}">
  <link rel="stylesheet" href="{{ site('assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ site('assets/css/style-multi.css') }}">

  <link rel="icon" href="{{ site('assets/images/logo.png') }}" type="image/ico"/>
  <title>{{ config('app.name', 'AZParts') }} | @yield('title') </title>
  <link rel="stylesheet" href="{{ site('assets/css/dev.css') }}">

    @yield('styles')
</head>

<body>
  <!-- start navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light shadow ">
    <a class="navbar-brand" href="{{ route('home') }}"><img src="{{ site('assets/images/logo.png') }}" alt=""></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-custom">

      <li class="nav-item"> <a class="nav-link {{ isset($home) ? 'blue' : '' }}"
            href="{{ route('home') }}"> @lang('site.home') </a> </li>

        <li class="nav-item"> <a class="nav-link {{ isset($damaged) ? 'blue' : '' }}"
            href="{{ route('cars.damaged') }}">@lang('site.cars_yard')  </a> </li>

        <li class="nav-item"> <a class="nav-link {{ isset($antique) ? 'blue' : '' }}"
          href="{{ route('cars.antique') }}"> @lang('site.antique_cars') </a> </li>

        <li class="nav-item"> <a class="nav-link {{ isset($old_stock) ? 'blue' : '' }}"
            href="{{ route('stock') }}"> @lang('site.old_stock') </a> </li>

        <li class="nav-item"> <a class="nav-link {{ isset($packages) ? 'blue' : '' }}"
          href="{{ route('package.show','electronic') }}"> @lang('site.packages') </a> </li>

      </ul>
      <ul class="navbar-nav contact-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="tel:{{ data('mobile') }}">
            <img src="{{ site('assets/images/phone.png') }}" alt="" class="pl-1 phone">
          </a>
        </li>

        @if(user_type() == 'user' || user_type() == 'company' || user_type() == 'broker' || user_type() == 'seller')
        <li class="nav-item">
          <a class="nav-link" href="{{ route('cart') }}">
            <img src="{{ site('assets/images/cart.png') }}" alt="">
            @if(logged_user()) <span class="blue"> {{ count(cart()) }} </span> @endif
          </a>
        </li>
        @endif

        <li class="nav-item">
          <a href="{{ route('notification.all') }}" class="nav-link">
           <i class="fa fa-bell"> </i>
           </a>
        </li>

        <li class="nav-item dropdown ">
          <a class="nav-link dropdown-toggle after-none-2" href="#" id="navbarDropdown-2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img src="{{ site('assets/images/pro.png') }}" alt="">
          </a>

            @if(user_type() == 'user' || user_type() == 'company' || user_type() == 'broker'
            || user_type() == 'seller' || user_type() == 'rep' || user_type() == 'admin')

            <div class="dropdown-menu logged_menu" aria-labelledby="navbarDropdown">

              @if(user_type() != 'admin')
              <a class="dropdown-item profile-drob" href="{{ route('profile') }}">
                  <i class="fa fa-user"></i> @lang('site.profile')  </a>
              @endif

              @if(user_type() == 'user' || user_type() == 'company' || user_type() == 'broker' || user_type() == 'seller')
              <a class="dropdown-item profile-drob" href="{{ route('user.my_orders') }}">
                <i class="fa fa-list"></i> @lang('site.my_orders')  </a>
              @endif

              @if(user_type() == 'user' || user_type() == 'company')
              <a class="dropdown-item profile-drob" href="{{ route('my_requests') }}">
                <i class="fa fa-hashtag"></i> @lang('site.electronic_requests')  </a>
              @endif

              @if(user_type() == 'seller' || user_type() == 'broker')
              <a class="dropdown-item profile-drob" href="{{ route('seller.avaliable_models') }}">
                <i class="fa fa-car"></i> @lang('site.avaliable_models')  </a>
              @endif

              @if(user_type() == 'user' || user_type() == 'company')
              <a class="dropdown-item profile-drob" href="{{ route('control.user_interests') }}">
                <i class="fa fa-heart"></i> @lang('site.my_interests')  </a>
              @endif

              @if(user_type() == 'user' || user_type() == 'company')
              <a class="dropdown-item profile-drob" href="{{ route('control.wish_list') }}">
                <i class="fa fa-heart"></i> @lang('site.my_favorite')  </a>
              @endif

              @if(user_type() == 'user' || user_type() == 'company')
              <a class="dropdown-item profile-drob" href="{{ route('control.cars') }}">
                <i class="fa fa-car"></i> @lang('site.my_cars')  </a>
              @endif

              @if(user_type() == 'user' || user_type() == 'company' || user_type() == 'seller' || user_type() == 'broker')
              <a class="dropdown-item profile-drob" href="{{ route('my_packages') }}">
                <i class="fa fa-hashtag"></i> @lang('site.my_packages')  </a>
              @endif

              @if(user_type() == 'seller' || user_type() == 'broker')
              <a class="dropdown-item profile-drob" href="{{ route('seller.requests') }}">
                <i class="fa fa-hashtag"></i> @lang('site.seller_requests')  </a>
              @endif

              @if(user_type() == 'rep')
              <a class="dropdown-item profile-drob" href="{{ route('rep.my_prices') }}">
                <i class="fa fa-list"></i> @lang('site.my_prices') </a>

              <a class="dropdown-item profile-drob" href="{{ route('rep.my_orders') }}">
                  <i class="fa fa-list"></i> @lang('site.my_orders') </a>
              @endif

              <a class="dropdown-item log-out" href="{{ route('logout') }}"> @lang('site.logout') </a>
            </div>
          @else

          <div class="dropdown-menu login_drop" aria-labelledby="navbarDropdown">

            <div class="dropdown-head">
              <h3> @lang('site.login') </h3>
              <p> @lang('site.enter_mobile_and_password') </p>

              <form class="drop-form" method="POST" action="{{ route('user.login') }}">
                @csrf
                  <div class="form-group">
                  <input type="tel" class="form-control" name="mobile" value="{{ old('mobile') }}" placeholder="@lang('site.mobile')" required>
                  </div>

                  <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="@lang('site.password')" required>
                  </div>

                  <div class="form-group form-check row">
                    <input type="radio" class="form-check-input col-md-3" id="user" name="user_type" value="u" checked
                    {{ old('user_type') == 'u' ? 'checked' : '' }} required>
                    <label class="form-check-label" for="user"> @lang('site.user')  </label>

                    <input type="radio" class="form-check-input col-md-3" id="company" name="user_type" value="c"
                    {{ old('user_type') == 'c' ? 'checked' : '' }}>
                    <label class="form-check-label" for="company"> @lang('site.company')  </label>

                    <input type="radio" class="form-check-input col-md-3" id="seller_manu" name="user_type" value="sm"
                    {{ old('user_type') == 'sm' ? 'checked' : '' }}>
                    <label class="form-check-label" for="seller_manu"> @lang('site.manufacturing')  </label>

                    <input type="radio" class="form-check-input col-md-3" id="seller_tashlih" name="user_type" value="st"
                    {{ old('user_type') == 'st' ? 'checked' : '' }}>
                    <label class="form-check-label" for="seller_tashlih"> @lang('site.tashalih')  </label>

                    <input type="radio" class="form-check-input col-md-3" id="broker" name="user_type" value="b"
                    {{ old('user_type') == 'b' ? 'checked' : '' }}>
                    <label class="form-check-label" for="broker"> @lang('site.broker')  </label>

                    <input type="radio" class="form-check-input col-md-3" id="rep" name="user_type" value="r"
                    {{ old('user_type') == 'r' ? 'checked' : '' }}>
                    <label class="form-check-label" for="rep"> @lang('site.rep')  </label>

                  </div>

                  <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1"> @lang('site.remember_me')  </label>
                  </div>

                  <button type="submit" class="btn btn-dropform btn-block btn-lg mt-2"> @lang('site.login') </button>
              </form>

              <br/>

              <a href="{{ route('user.forget_password') }} " class="an-forgget"> @lang('site.forget_password') </a>

                <p class="mt-2"> @lang('site.easy_to_register') </p>

              <a href="{{ route('signup_as') }}" class="btn btn-logindrop btn-lg btn-block"> @lang('site.register_a_new_account') </a>

            </div>

          </div>

          @endif

        </li>

        <li class="nav-item sepretor mt-2">
          |
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="javascript:void(0);" id="menuCountries" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-globe"></i>
          </a>
          <div class="dropdown-menu logged_menu" aria-labelledby="navbarDropdown">
            
            @foreach (countries() as $counLi)
              <a class="dropdown-item" href=""> {{ $counLi['name_'.my_lang()] }}  </a> 
            @endforeach
               
          </div>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="menu1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-globe"></i>
          </a>
          <div class="dropdown-menu logged_menu" aria-labelledby="navbarDropdown">
            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
              <a class="dropdown-item" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                {{ $properties['native'] }}  </a>

            @endforeach
          </div>
        </li>
      </ul>
    </div>
  </nav>

  @yield('content')

  <footer @if(cur_root() != 'home') class="about-footer" @endif>
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="footer-box">
            <h4> @lang('site.latest_additional') </h4>

            @foreach (lateset_cars() as $lateset_car)
              <p><a href="{{ route('car',$lateset_car->id) }}"> {{ $lateset_car->title }} </a></p>
            @endforeach

          </div>
        </div>

        <div class="col">
          <div class="footer-box">
            <h4> @lang('site.menu') </h4>            
            
          <p><a href="{{ route('cars.damaged') }}"> @lang('site.cars_yard') </a></p>
          <p><a href="{{ route('cars.antique') }}"> @lang('site.antique_cars') </a></p>
          <p><a href="{{ route('stock') }}"> @lang('site.old_stock') </a></p>
          <p><a href="{{ route('package.show','electronic') }}"> @lang('site.packages') </a></p>
           
          </div>
        </div>
        <div class="col">
          <div class="footer-box">
            <h4> @lang('site.browse') </h4>            
            <p><a href="{{ route('privacy') }}"> @lang('site.privacy_policy') </a></p>
            <p><a href="{{ route('terms') }}"> @lang('site.terms_and_condition') </a></p>
            <p><a href="{{ route('about_us') }}"> @lang('site.about_us') </a></p>
            <p><a href="{{ route('faq') }}"> @lang('site.faq') </a></p>
          </div>
        </div>
        <div class="col">
              <div class="footer-box">
                  <h4>  @lang('site.reach_us') </h4>

                  <ul class="social-footer">
                      @foreach (social_links() as $social_link)
                          <li><a href="{{ $social_link->value }}" target="_blank">
                              <i class="fab fa-{{ $social_link->name }}"></i></a></li>
                      @endforeach
                  </ul>
              </div>

              <div class="footer-box mt-4">
                  <h4> @lang('site.payment') </h4>
                  <a href="#"><img src="{{ site('assets/images/visa.png') }}" alt=""> </a>
              </div>
        </div>


      </div>
    </div>
  </footer>

  @yield('popup')

  <!-- start floating button -->
  <a href="https://wa.me/{{ data('mobile') }}" target="_blank" class="float">
    <img src="{{ site('assets/images/whatsapp-green.png') }}" alt="" class="img-fluid">
  </a>
  <!-- start my script -->
  <script src="{{ site('assets/js/jquery-3.3.1.min.js') }}"></script>
  <script src="{{ site('assets/js/highlight.pack.js') }}"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="{{ site('assets/js/popper.min.js') }}"></script>
  <script src="{{ site('assets/js/bootstrap.min.js') }}"></script>
  <script src="{{ site('assets/js/slick.min.js') }}"></script>
  <script src="{{ site('assets/js/multi-countdown.js') }}"></script>

  <script src="{{ site('assets/js/code.js') }}"></script>

@include('layouts.message')

@yield('scripts')

</body>

</html>
