

<div class="col-lg-3 col-md-2 col">
    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">

    <a class="nav-link {{ isset($profile) ? 'active' : '' }}"
          href="{{ route('profile') }}"> <i class="fa fa-user"></i> @lang('site.my_info') </a>

    @if(user_type() == 'user' || user_type() == 'company' || user_type() == 'seller' || user_type() == 'broker')
      <a class="nav-link {{ isset($my_orders) ? 'active' : '' }}" href="{{ route('user.my_orders') }}">
        <i class="fa fa-list"></i> @lang('site.my_orders') </a>
    @endif

    @if(user_type() == 'user' || user_type() == 'company' || user_type() == 'seller' || user_type() == 'broker')
      <a class="nav-link {{ isset($my_requests) ? 'active' : '' }}"
          href="{{ route('my_requests') }}">
          <i class="fa fa-search"></i> @lang('site.electronic_requests') </a>
    @endif

    @if( user_type() == 'broker' || user_type() == 'seller')
      <a class="nav-link {{ isset($seller_requests) ? 'active' : '' }}" href="{{ route('seller.requests') }}">
        <i class="fa fa-list"></i> @lang('site.seller_requests') </a>
    @endif

    @if(user_type() == 'user' || user_type() == 'company')
      <a class="nav-link {{ isset($my_interests) ? 'active' : '' }}" href="{{ route('control.user_interests') }}"> 
        <i class="fa fa-fav"></i> @lang('site.my_interests') </a>
    @endif

    @if(user_type() == 'user' || user_type() == 'company')
      <a class="nav-link {{ isset($my_cars) ? 'active' : '' }}" href="{{ route('control.cars') }}">
        <i class="fa fa-car"></i> @lang('site.my_cars') </a>
    @endif

    @if(user_type() == 'seller' || user_type() == 'broker')
      <a class="nav-link {{ isset($avaliable_models) ? 'active' : '' }}"
          href="{{ route('seller.avaliable_models') }}">
          <i class="fa fa-car"></i> @lang('site.avaliable_models') </a>
    @endif

    @if(user_type() == 'user' || user_type() == 'company' || user_type() == 'seller' || user_type() == 'broker')
      <a class="nav-link {{ isset($my_packages) ? 'active' : '' }}"
          href="{{ route('my_packages') }}"> <i class="fa fa-hashtag"></i> @lang('site.my_packages') </a>
    @endif

    @if(user_type() == 'rep')
        <a class="nav-link {{ isset($my_prices) ? 'active' : '' }}"
          href="{{ route('rep.my_prices') }}"> <i class="fa fa-money"></i> @lang('site.my_prices') </a>

        <a class="nav-link {{ isset($rep_orders) ? 'active' : '' }}"
          href="{{ route('rep.my_orders') }}"> <i class="fa fa-cart"></i> @lang('site.my_orders') </a>
    @endif

    </div>
  </div>
