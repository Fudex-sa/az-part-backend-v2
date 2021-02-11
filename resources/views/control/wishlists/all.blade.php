
@extends('site.app')

@section('title') @lang('site.my_favorite')  @endsection

@section('styles')

@endsection

@section('content')

<section class="profile">
  <div class="container">
    <div class="row">

      @include('layouts.breadcrumb')

      <div class="col-md-12">
        <div class="row">

          @include('layouts.nav_side_menu')


                <div class="cars-yard col-lg-9 col-md-9  col-12" style="margin-top: -120px;">
                    <div class="container">
                      <div class="row">

                @if(count($items) > 0)
                  @foreach ($items as $item)

                  <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="add-card shadow">
                      <div class="add-card-head">
                        <div class="add-card-layout">
                          <ul class="lay-out-menue">
                          <!-- <li><a href="#"><img src="{{ site('assets/images/1.png') }}" alt=""></a></li> -->

                          @if(logged_user() && user_type() == 'user')
                          @if(App\Models\CarFavorite::where('car_id',$item->id)->where('user_id',logged_user()->id)->first())
                            <li><a href="{{ route('control.wishlist.remove_wish_list',$item->id) }}"><img src="{{ site('assets/images/2.png') }}" alt=""></a></li>
                            @else
                            <li><a href="{{ route('control.wishlist.add_wish_list',$item->id) }}"><img src="{{ site('assets/images/2.png') }}" alt=""></a></li>
                          @endif
                        @endif

                          <!-- <li><a href="#"><img src="{{ site('assets/images/3.png') }}" alt=""></a></li> -->
                          </ul>
                        </div>

                        @if(count($item->imgs) > 0)
                          <img src="{{ img_path($item->imgs[0]->photo) }}" alt="" class="img-fluid">
                        @else <img src="{{ site('assets/images/logo.png') }}" alt="" class="img-fluid"> @endif

                      </div>
                      <div class="add-card-body">
                        <p class="float-left"> {{ $item->year }} </p>

                      <img src="{{ brand_img($item->brand ? $item->brand['logo'] : '') }}" alt="" class="float-right brand-logo">

                      <h6> <a href="{{ route('car',$item->id) }}">{{ $item->model ? $item->model['name_'.my_lang()] : '' }} </a> </h6>

                      <h6 class="mt-3"><img src="{{ site('assets/images/location.png') }}" alt="">
                           {{ $item->region ? $item->region['name_'.my_lang()] : '' }} -
                           {{ $item->city ? $item->city['name_'.my_lang()] : '' }}
                      </h6>
                      </div>

                      @if($item->price_type == 'fixed')
                      <div class="add-card-footer">
                        <h6><strong> {{ $item->price }} </strong> @lang('site.rs')  </h6>
                      </div>
                      @endif

                    </div>
                  </div>

                  @endforeach
                @else
                  <div class="col-md-12 text-center">
                    <h3> @lang('site.no_items_found') </h3>
                  </div>
                @endif



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
  <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

  <script src="{{ site('assets/js/select2.js') }}"></script>

  @include('dashboard.ajax.load_models')
  @include('dashboard.ajax.load_regions')
  @include('dashboard.ajax.load_cities')

  @include('dashboard.ajax.delete',['target'=>'car'])

  <script>
    $(document).on("click","input[name=price_type]:radio",function(){
        var price_type = $(this).val();

        if(price_type == 'fixed')
          $("#price_div").show();
        else
          $("#price_div").hide();

    });
  </script>

@endsection
