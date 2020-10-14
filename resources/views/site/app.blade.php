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

        <li class="nav-item"> <a class="nav-link" href="{{ route('home') }}"> @lang('site.home') </a> </li>

        <li class="nav-item"> <a class="nav-link" href="{{ route('cars.damaged') }}">@lang('site.cars_yard')  </a> </li>
        
        <li class="nav-item"> <a class="nav-link" href="{{ route('cars.antique') }}"> @lang('site.antique_cars') </a> </li>
          
        <li class="nav-item"> <a class="nav-link" href="{{ route('stock') }}"> @lang('site.old_stock') </a> </li>

        <li class="nav-item"> <a class="nav-link" href="{{ route('package.show','electronic') }}"> @lang('site.packages') </a> </li>

      </ul>
      <ul class="navbar-nav contact-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="tel:{{ setting('mobile') }}">
            <img src="{{ site('assets/images/phone.png') }}" alt="" class="pl-1 phone">
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="#">
            <img src="{{ site('assets/images/cart.png') }}" alt="">
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="{{ route('cart') }}">  <i class="fa fa-bell"> </i>
            @if(logged_user()) <span class="blue"> {{ count(cart()) }} </span> @endif
           </a>
        </li>

        <li class="nav-item dropdown ">
          <a class="nav-link dropdown-toggle after-none-2" href="#" id="navbarDropdown-2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img src="{{ site('assets/images/pro.png') }}" alt="">
          </a>

          @if(auth()->guard('company')->user() || auth()->user() || auth()->guard('broker')->user() ||
            auth()->guard('seller')->user() || auth()->guard('rep')->user() )
            
            <div class="dropdown-menu logged_menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item profile-drob" href="{{ route('profile') }}"> @lang('site.profile')  </a>

              {{-- @can('createAvailableBrand') --}}
              <a class="dropdown-item profile-drob" href="{{ route('seller.avaliable_models') }}"> @lang('site.avaliable_models')  </a>
              {{-- @endcan --}}

              <a class="dropdown-item log-out" href="{{ route('logout') }}"> @lang('site.logout') </a>
            </div>
          @else

          <div class="dropdown-menu" aria-labelledby="navbarDropdown">

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
                  
                  <div class="form-group form-check">
                    <input type="radio" class="form-check-input" id="user" name="user_type" value="u" checked
                    {{ old('user_type') == 'u' ? 'checked' : '' }} required> 
                    <label class="form-check-label" for="user"> @lang('site.user')  </label>

                    <input type="radio" class="form-check-input" id="company" name="user_type" value="c"
                    {{ old('user_type') == 'c' ? 'checked' : '' }}> 
                    <label class="form-check-label" for="company"> @lang('site.company')  </label>

                    <input type="radio" class="form-check-input" id="seller_manu" name="user_type" value="sm"
                    {{ old('user_type') == 'sm' ? 'checked' : '' }}> 
                    <label class="form-check-label" for="seller_manu"> @lang('site.manufacturing')  </label>

                    <input type="radio" class="form-check-input" id="seller_tashlih" name="user_type" value="st"
                    {{ old('user_type') == 'st' ? 'checked' : '' }}> 
                    <label class="form-check-label" for="seller_tashlih"> @lang('site.tashalih')  </label>

                    <input type="radio" class="form-check-input" id="broker" name="user_type" value="b"
                    {{ old('user_type') == 'b' ? 'checked' : '' }}> 
                    <label class="form-check-label" for="broker"> @lang('site.broker')  </label>

                  </div>

                  <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1"> @lang('site.remember_me')  </label>
                  </div>
                  
                  <a href="{{ route('user.forget_password') }} " class="an-forgget"> @lang('site.forget_password') </a>

                  <button type="submit" class="btn btn-dropform btn-block btn-lg mt-2"> @lang('site.login') </button>
              </form>

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
            <p><a href="#">الدمام</a></p>
            <p><a href="#">الخبر</a></p>
            <p><a href="#">لنكولن ٢٠٠٨ ام كي اكس</a></p>
  
          </div>
        </div>
        <div class="col">
          <div class="footer-box">
            <h4> &nbsp;</h4>
            <p><a href="#">حفر الباطن</a></p>
            <p><a href="#">القطيف</a></p>
            <p><a href="#">اكسنت 2004</a></p>
  
          </div>
        </div>
        <div class="col">
          <div class="footer-box">
            <h4> @lang('site.browse') </h4>
          <p><a href="{{ route('cars.damaged') }}"> @lang('site.cars_yard') </a></p>
          <p><a href="{{ route('stock') }}"> @lang('site.old_stock') </a></p>
          <p><a href="{{ route('privacy') }}"> @lang('site.privacy_policy') </a></p>
  
          </div>
        </div>
        <div class="col">
          <div class="footer-box">
            <h4> @lang('site.menu') </h4>
            <p><a href="{{ route('home') }}"> @lang('site.home') </a></p>
            <p><a href="{{ route('about_us') }}"> @lang('site.about_us') </a></p>
            <p><a href="{{ route('terms') }}"> @lang('site.terms_and_condition') </a></p>
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
  <a href="#" class="float">
    <img src="{{ site('assets/images/whatsapp-green.png') }}" alt="" class="img-fluid">
  </a>
  <!-- start my script -->
  <script src="{{ site('assets/js/jquery-3.3.1.min.js') }}"></script>
  <script src="{{ site('assets/js/highlight.pack.js') }}"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="{{ site('assets/js/popper.min.js') }}"></script>
  <script src="{{ site('assets/js/bootstrap.min.js') }}"></script>
  <script src="{{ site('assets/js/slick.min.js') }}"></script>
  <script src="{{ site('assets/js/code.js') }}"></script>

@include('layouts.message')

@yield('scripts')
 
</body>

</html>
 









