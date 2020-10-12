

<div class="col-md-12">
    <!-- start breadcramb -->
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('') }}"> @lang('site.home') </a></li>
        <li class="breadcrumb-item active" aria-current="page"> @yield('title')  </li>
      </ol>
    </nav>
</div>


@if(cur_root() != 'search.parts')
<div class="col-md-12">
  <div class="head-section my-3">
    <h2> @yield('title') </h2>
  </div>
</div>
@endif