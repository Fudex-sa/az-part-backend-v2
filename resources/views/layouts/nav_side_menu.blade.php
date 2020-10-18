

<div class=" col- lg-2 col-md-2 col">
    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">

    <a class="nav-link {{ isset($profile) ? 'active' : '' }}" 
          href="{{ route('profile') }}"> @lang('site.my_info') </a>
      
      <a class="nav-link {{ isset($my_orders) ? 'active' : '' }}"> @lang('site.my_orders') </a>

      <a class="nav-link {{ isset($my_interests) ? 'active' : '' }}"> @lang('site.my_interests') </a>
      
      <a class="nav-link {{ isset($my_cars) ? 'active' : '' }}"> @lang('site.my_cars') </a>

      <a class="nav-link {{ isset($avaliable_models) ? 'active' : '' }}"  
          href="{{ route('seller.avaliable_models') }}"> @lang('site.avaliable_models') </a>

      <a class="nav-link {{ isset($my_packages) ? 'active' : '' }}"  
          href="{{ route('my_packages') }}"> @lang('site.my_packages') </a>

     <a class="nav-link {{ isset($my_prices) ? 'active' : '' }}"  
          href="{{ route('rep.my_prices') }}"> @lang('site.my_prices') </a>

    </div>
  </div>