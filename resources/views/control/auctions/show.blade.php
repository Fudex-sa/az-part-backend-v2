
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



        <div class="count-head">
          <h3>
            <p><img src="{{ site('assets/images/place-1.png') }}" alt="">
              @lang('site.model') : {{ $item->brand ? $item->brand['name_'.my_lang()] : '' }} -
                                    {{ $item->model ? $item->model['name_'.my_lang()] : '' }}
                                    {{ $item->year }}
            </p>
          </h3>
          <h5 class="count-h5">تفاصيل أخرى عن القطعة </h5>
          <div class="contain-count">
            <h5 class="text-center mt-5">الوقت المتبقي للمزايدة</h5>
            <div class="jumbotron countdown show" data-Date='{{ $item->date_auction }}'>
              <div class="running">
                <timer>
                  <span class=" seconds"></span><span class="minutes"></span><span class=" hours"></span><span
                    class="days"></span>
                </timer>

                </div>

              </div>


            </div>

            <form class="row" method="post" action="{{ route('control.carStoreBidding') }}" enctype="multipart/form-data">
              @csrf

              <input type="hidden" name="car_id" value="{{$item->id}}">
              <input type="hidden" name="user_id" value="{{auth()->id()}}">
              <div class="form-group col-md-8">
                <input type="text" name="price" class="form-control m-0" id="sub" placeholder="أدخل قيمة المزايدة لديك" required>
              </div>
              <div class="col-md-4">
                <button type="submit" class="btn btn-client btn-block">إشترك في المزاد </button>

              </div>
            </form>
            <h5 class="count-h5-2">المزايدة الحالية <span> {{$tenders->max('price')}} ريال سعودي</span></h5>
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
            <input type="submit" value="@lang('site.send')" class="btn btn-primary"/>
          </form>
        </div>
        @endif

      </div>

      <div class="col-md-12 mt-5 tenders">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab"
              aria-controls="pills-home" aria-selected="true">{{ __('site.car_details') }}</a>
          </li>
          <li class="nav-item mr-5">
            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab"
              aria-controls="pills-profile" aria-selected="false">المناقصات</a>
          </li>

        </ul>
        <div class="tab-content" id="pills-tabContent">
          <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">


            <div class="tender-info mt-5">
              <h5> <img src="assets/images/per-gray.png" alt=""><span> {{ __('site.seller') }} : </span>{{$item->user['name']}}</h5>
              <h5> <img src="assets/images/loc-gray.png" alt=""><span> {{__('site.brand')}} :  </span> {{$item->brand['name_'.my_lang()]}}</h5>
              <h5> <img src="assets/images/cal-gray.png" alt=""><span>{{__('site.model')}} : </span> {{$item->model['name_'.my_lang()]}} </h5>
              <h5> <img src="assets/images/cal-gray.png" alt=""><span>  {{__('site.kilometers')}}  : </span> {{$item->kilo_no}}
              </h5>
              <h5> <img src="assets/images/cart-gray.png" alt=""><span> {{__('site.manufacturing_year')}} : </span> {{$item->year}} </h5>

            </div>





          </div>
          <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">


            <div class="tender-info-2  mt-5">
              @foreach($tenders as $tender)
              <h5><img src="{{ site('assets/images/tender.png') }}" alt="">{{  __('site.tenders') }}  {{ number_format($tender->price) }} {{ __('site.rs') }}</h5>

              <h6>{{ $tender->created_at }}</h6>
              @endforeach


            </div>


          </div>
        </div>
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
                  <li><a href="#"><img src="{{ asset('assets/images/1.png') }}" alt=""></a></li>
                  @if(logged_user() && user_type() == 'user')
                  @if(App\Models\CarFavorite::where('car_id',$car->id)->where('user_id',logged_user()->id)->first())
                    <li><a href="{{ route('control.wishlist.remove_wish_list',$car->id) }}"><img src="{{ site('assets/images/2.png') }}" alt=""></a></li>
                    @else
                    <li><a href="{{ route('control.wishlist.add_wish_list',$car->id) }}"><img src="{{ site('assets/images/2.png') }}" alt=""></a></li>
                  @endif
                @endif
                  <li><a href="#"><img src="{{ asset('assets/images/3.png') }}" alt=""></a></li>
                  </ul>
                </div>

              @if(count($car->imgs) > 0)
                <img src="{{ img_path($car->imgs[0]->photo) }}" alt="" class="img-fluid">
              @else <img src="{{ site('assets/images/logo.png') }}" alt="" class="img-fluid"> @endif

              </div>
              <div class="add-card-body">
                <p class="float-left"> {{ $car->year }} </p>

              <img src="{{ brand_img($car->brand ? $car->brand['logo'] : '') }}" alt="" class="float-right brand-logo">

              <h6> <a href="{{ route('car',$car->id) }}">{{ $car->model ? $car->model['name_'.my_lang()] : '' }} </a> </h6>

              <h6 class="mt-3">
                <a href="{{ route('car',$car->id) }}"> {{ $car->title }} </a>

                {{-- <img src="{{ asset('assets/images/location.png') }}" alt="">
                   {{ $car->region ? $car->region['name_'.my_lang()] : '' }} -
                   {{ $car->city ? $car->city['name_'.my_lang()] : '' }} --}}
              </h6>
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

@endsection
