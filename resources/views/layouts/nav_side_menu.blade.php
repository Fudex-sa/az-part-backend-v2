

<div class=" col- lg-2 col-md-2 col">
    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">

    <a class="nav-link active" href="{{ route('profile') }}"> @lang('site.my_info') </a>
      
      <a class="nav-link"  data-toggle="pill" href="#my_orders" role="tab"
        aria-controls="my_orders" aria-selected="false"> @lang('site.my_orders') </a>

      <a class="nav-link" data-toggle="pill" href="#my_interests" role="tab"
        aria-controls="my_interests" aria-selected="false"> @lang('site.my_interests') </a>
      
      <a class="nav-link" data-toggle="pill" href="#my_cars" role="tab"
        aria-controls="my_cars" aria-selected="false"> @lang('site.my_cars') </a>

      <a class="nav-link"  href="{{ route('seller.avaliable_models') }}"> @lang('site.avaliable_models') </a>

    </div>
  </div>