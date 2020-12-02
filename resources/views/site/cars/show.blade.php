
@extends('site.app')

@section('title')  {{ $item->title }} @endsection

@section('styles')

  <link rel="stylesheet" href="{{ site('assets/css/refineslide.css') }}">

  <script type='text/javascript'
  src='https://platform-api.sharethis.com/js/sharethis.js#property=5e3cb8a1cd980c0012d9bbf0&product=inline-share-buttons' async='async'></script>

@endsection

@section('content')

<div class="cars-yard">
  <div class="container">
    <div class="row">
      @include('layouts.breadcrumb')
 
      <div class="col-md-5">
          <div class="pro-gallery wow zoomIn">
            <div class="slider-for">
              @foreach ($item->imgs as $img)
                <div><img src="{{ img_path($img->photo) }}" /></div>
              @endforeach  
            </div>
            <div class="slider-nav">
              @foreach ($item->imgs as $img)
                <div><img src="{{ img_path($img->photo) }}" /></div>
              @endforeach  
            </div>
        </div>
        
      </div>
      <div class="col-md-7">

        <div class="pragraph-box mt-3">
            <p><img src="{{ site('assets/images/place-1.png') }}" alt="">
              @lang('site.model') : {{ $item->brand ? $item->brand['name_'.my_lang()] : '' }} -
                                    {{ $item->model ? $item->model['name_'.my_lang()] : '' }}
                                    {{ $item->year }}
            </p>

            <p><img src="{{ site('assets/images/place-2.png') }}" alt="">
                @lang('site.type') : {{ __('site.'.$item->type) }} </p>

            @if($item->type == 'antique')
              <p><img src="{{ site('assets/images/place-2.png') }}" alt="">
                @lang('site.original_replica') : {{ $item->original == 1 ? __('site.original') : __('site.replica') }} </p>

                @if($item->original == 0)
                  <ul class="margin-right">
                    <li><p> <i class="fa fa-calendar"></i> @lang('site.original_manufacture_year') : {{ $item->original_year}} </p></li>
                    <li><p> <i class="fa fa-calendar"></i> @lang('site.replica_manufacture_year') : {{ $item->replica_year}} </p> </li>
                  </ul>
                @endif  

            @endif
          
            <p><img src="{{ site('assets/images/place-2.png') }}" alt="">
                  @lang('site.color') : {{ $item->color }} </p>

            @if($item->notes)
              <p><img src="{{ site('assets/images/cart-gray.png') }}" alt="">
                      @lang('site.notes') : {{  $item->notes ? $item->notes : '-' }} </p>
            @endif

            <p><img src="{{ site('assets/images/loc-gray.png') }}" alt=""> @lang('site.address') :
              {{ $item->region ? $item->region['name_'.my_lang()] : '' }} -
              {{ $item->city ? $item->city['name_'.my_lang()] : '' }}
            </p>

            <p><img src="{{ site('assets/images/cal-gray.png') }}" alt=""> {{ $item->created_at }} </p>

            <p><img src="{{ site('assets/images/per-gray.png') }}" alt="">
                @lang('site.owner') : {{ $item->user ? $item->user->name : '' }}

            <p> <i class="fa fa-eye"></i>
                  @lang('site.views') : {{ $item->views }}
            </p>

        </div>
        <div class="row mt-4">
          <span class=" badge badge-line col">
            @lang('site.validatly') : {{ $item->validatly == 1 ? __('site.yes') : __('site.no') }}
          </span>

          <span class="badge badge-line col">
            @lang('site.periodic_inspection_validity') : {{ $item->examination == 1 ? __('site.yes') : __('site.no') }}
          </span>

          <span class="badge badge-line col"> @lang('site.kilometers') : {{ $item->kilo_no }} </span>

        </div>
        <div class="auction mt-4 row">
          @if($item->price_type == 'fixed') <h3 class="col-md-12"> {{ $item->price }}  </h3> @endif

          @if($item->auction == 1)
          <a href="{{ route('control.getAuction',$item->id) }}" class="btn btn-save col-md-4  btn-lg">@lang('site.join_auction')</a>
          @endif
          <div class="col-md-12 text-left">
            <a href="tel:00966{{ $item->user ? $item->user->mobile : '' }}" class="btn btn-logindrop col-md-4 mt-3 btn-lg"> @lang('site.contact_with_administrator') </a>

            <a href="https://wa.me/{{ $item->user ? $item->user->mobile : '' }}" target="_blank" class="btn btn-logindrop col-md-1 mt-3 btn-lg"> 
                <img src="{{ site('assets/images/w-2.png') }}" /> 
            </a>

          </div>
          

        </div>
        <div class="row mt-5">
          <div class="col-md-4">
            <h5 class="pt-2"> @lang('site.share_via') </h5>
          </div>

          <div class="col-md-8">
            <ul class="share">
              <div class="sharethis-inline-share-buttons"></div>
            </ul>
          </div>
        </div>

        @if(logged_user() && logged_user()->id != 0)
        <div class="form-group row mt-5">
          <form method="POST" action="{{ route('car.comment.store',$item->id) }}">
            @csrf
            <textarea class="form-control comment" name="comment" rows="2" placeholder="@lang('site.add_comment')" required></textarea>
            
            <div class="text-left">
              <br/>
              <input type="submit" value="@lang('site.send')" class="btn btn-primary" />
            </div>
          </form>
        </div>
        @endif

      </div>


      @if(count($cars) > 0)

      <div class="col-md-12 mt-5 pt-5">
        <h2> @lang('site.see_also') </h2>
      </div>

          @foreach ($cars as $car)

          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="add-card shadow">
              <div class="add-card-head">
                <div class="add-card-layout">
                  <ul class="lay-out-menue">
                  <li> <a href="{{ route('car',$car->id) }}"> 
                      <img src="{{ site('assets/images/1.png') }}" alt=""></a></li>
                  @if(logged_user() && user_type() == 'user')
                  @if(App\Models\CarFavorite::where('car_id',$car->id)->where('user_id',logged_user()->id)->first())
                    <li><a href="{{ route('control.wishlist.remove_wish_list',$car->id) }}"><img src="{{ site('assets/images/2.png') }}" alt=""></a></li>
                    @else
                    <li><a href="{{ route('control.wishlist.add_wish_list',$car->id) }}"><img src="{{ site('assets/images/2.png') }}" alt=""></a></li>
                  @endif
                @endif

                  <li><a href="https://wa.me/?text={{ $car->title }}" target="_blank">
                    <img src="{{ site('assets/images/3.png') }}" alt=""></a></li>
                  </ul>
                </div>

                @if(count($car->imgs) > 0)
                  <img src="{{ img_path($car->imgs[0]->photo) }}" alt="" class="img-fluid">
                @else <img src="{{ site('assets/images/logo.png') }}" alt="" class="img-fluid"> @endif

              </div>
              <div class="add-card-body">
                <p class="float-left"> {{ $car->year }} </p>

              <img src="{{ brand_img($car->brand ? $car->brand['logo'] : '') }}" alt="" class="float-right brand-logo">

              <h6 class="float-right"> {{ $car->model ? $car->model['name_'.my_lang()] : '' }} </h6>

              <div class="clear-fix"></div>

              <div class="row">
                <span class="col-md-12"> <img src="{{ site('assets/images/location.png') }}" alt="">
                    {{ $car->region ? $car->region['name_'.my_lang()] : '' }} -
                    {{ $car->city ? $car->city['name_'.my_lang()] : '' }}
                </span>
              </div>
               
              </div>

              @if($car->price_type == 'fixed')
              <div class="add-card-footer">
                <h6><strong> {{ $car->price }} </strong> @lang('site.rs')  </h6>
              </div>
              @endif

            </div>
          </div>

          @endforeach
        @endif


    </div>
  </div>
</div>



@endsection

@section('scripts')
<script src="{{ site('assets/js/jquery.refineslide.min.js') }}"></script>
<script>
    // gallery slider ..
        $('.slider-for').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: true,
            asNavFor: '.slider-nav'
        });

        $('.slider-nav').slick({
            slidesToShow: 5,
            slidesToScroll: 1,
            asNavFor: '.slider-for',
            arrows: false,
            dots: false,
            centerMode: false,
            focusOnSelect: true
        });
</script>
<!--
<script src="{{ site('assets/js/jquery.refineslide.min.js') }}"></script>
<script>
  $(function () {
      var $upper = $('#upper');

      $('#images').refineSlide({
          transition : 'fade',
          onInit : function () {
              var slider = this.slider,
                 $triggers = $('.translist').find('> li > a');

              $triggers.parent().find('a[href="#_'+ this.slider.settings['transition'] +'"]').addClass('active');

              $triggers.on('click', function (e) {
                 e.preventDefault();

                  if (!$(this).find('.unsupported').length) {
                      $triggers.removeClass('active');
                      $(this).addClass('active');
                      slider.settings['transition'] = $(this).attr('href').replace('#_', '');
                  }
              });

              function support(result, bobble) {
                  var phrase = '';

                  if (!result) {
                      phrase = ' not';
                      $upper.find('div.bobble-'+ bobble).addClass('unsupported');
                      $upper.find('div.bobble-js.bobble-css.unsupported').removeClass('bobble-css unsupported').text('JS');
                  }
              }

              support(this.slider.cssTransforms3d, '3d');
              support(this.slider.cssTransitions, 'css');
          }
      });
  });
</script>
-->

@endsection
