
@extends('site.app')

@section('title') @lang('site.home') @endsection

@section('styles')
    <link rel="stylesheet" href="{{ site('assets/css/breaking-news-ticker.min.css') }}">
@endsection

@section('content')
    
<section class="header">
  <div class="container">
    <div class="row">

      <form method="GET" action="{{ route('search.parts') }}" id="frm_search">

        <div class="col-md-12">
          <div class="logo-box text-center">
            <img src="{{ site('assets/images/logo-box.png') }}" alt="">
          </div>
          <div class="info-box text-center">
            <h1> @lang('site.did_u_search_about_part') </h1>
            <p> @lang('site.search_spare_text') </p>
          </div>
        </div>

        <div class="col-md-12" id="slide">
          <div class="row">
            <div class="ui-widget col-md-4">

                <select class="form-control select2 input-A" name="brand" id="brand_id">
                  <option value=""> @lang('site.choose_brand') </option>
                  @foreach ($brands as $brand)
                      <option value="{{ $brand->id }}"
                        data-image="{{ brand_img($brand->logo) }}"  class="left"> {{ $brand['name_'.my_lang()] }} </option>    
                  @endforeach
                </select>
             
            </div>
            <div class="ui-widget col-md-4">
             
              <select class="form-control select2 input-B" name="model" id="model_id">
                  <option value=""> @lang('site.choose_model') </option>
              
              </select>

            </div>
            <div class="ui-widget col-md-4">
              
              <select class="form-control input-C" name="year" id="year">
                <option value=""> @lang('site.manufacturing_year') </option>
                @for($i = date('Y')+1  ; $i >= 1970 ; $i--)
                    <option value="{{$i}}" {{ app('request')->input('year')  == $i ? 'selected' : '' }}
                    >{{$i}}</option>
                @endfor
              </select> 

            </div>
            <div class="col-md-4"></div>
            <div class="col-md-4 ">
              <button type="button" class="btn btn-next btn-block btn-lg" id="btn-slide"
                value="Show text input"> @lang('site.next') </button>

            </div>
          </div>
        </div>

        <div class="col-md-12" id="slide-2">
          <div class="row ">
            <div class="col-md-2"></div>

            <div class="ui-widget col-md-4">

                <select class="form-control select2" name="country" id="country_id">
                    <option value=""> @lang('site.choose_country') </option>
                    @foreach (countries() as $country)
                        <option value="{{ $country->id }}"> {{ $country['name_'.my_lang()] }} </option>    
                    @endforeach
                </select>
            </div>

            <div class="ui-widget col-md-4">
              <select class="form-control select2" name="region" id="region_id">
                <option value=""> @lang('site.choose_region') </option>                 
              </select>
            </div>

            <div class="ui-widget col-md-4">
              <select class="form-control select2" name="city" id="cities">
                <option value=""> @lang('site.choose_city') </option>                 
              </select>
            </div>

            <div class="ui-widget col-md-4">
              <div class="row">
                <select name="search_type" class="form-control input-E col-md-10">
                    <option value=""> @lang('site.search_type') </option>
                    <option value="manual"> @lang('site.manual') </option>
                    <option value="electronic"> @lang('site.electronic') </option>
                </select>
                
                <div class="col-md-2">                  
                  <button type="button" class="btn btn-info-2" data-toggle="modal" data-target="#exampleModal"></button>
                </div>

              </div>
            </div>

            <div class="col-md-2"></div>

            <div class="col-md-4"></div>

            <div class="col-md-4 ">
              <div class="row">
                <a href="javascript:void(0);" class="col-md-2" id="back"> <img src="{{ site('assets/images/back.png') }}" alt="" class="img-fluid"> </a>

                <button type="submit" class="btn btn-next col-md-10 btn-lg"> @lang('site.search')  </button>

              </div>
            </div>
          </div>
        </div>

      </form>

    </div>
  </div>
</section>




<!-- Stock -->
<section class="price">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="head-section text-center cust-m-midn">
          <img src="{{ site('assets/images/statistics.png') }}" alt="" class="mb-4">
          <h2>مؤشر أسعار قطع الغيار</h2>
        </div>
      </div>

    </div>
  </div>


  <div class="bn-breaking-news" id="newsTicker2">
    <div class="bn-news">
      <ul>
        <li>
          <div class="price-container ">
            <div class="p-container-info-box  float-left">
              <div class="add-card-body shadow p-3 radius">
                <p class="float-left">1999</p>

                <img src="{{ site('assets/images/brand-1.png') }}" alt="" class="float-right">
                <h4 class="text-center pt-2">الماركة</h4>
                <h6 class="text-center mt-3">مكان مخصص لاسم قطعة الغيار</h6>
                <p class="float-left"> <span class="color-r">400</span>ريال</p>

                <p class="float-right"> <span class="color-g">400</span>ريال</p>
                <p class="pt-2 text-center"> <span class="color-d">400</span>ريال</p>

              </div>
            </div>
            <div class="p-container-image-box shadow">
              <a href="#"><img src="{{ site('assets/images/logo.png') }}" alt="">
              </a>
            </div>


          </div>
        </li>
        <li>
          <div class="price-container ">
            <div class="p-container-info-box  float-left">
              <div class="add-card-body shadow p-3 radius">
                <p class="float-left">1999</p>

                <img src="{{ site('assets/images/brand-1.png') }}" alt="" class="float-right">
                <h4 class="text-center pt-2">الماركة</h4>
                <h6 class="text-center mt-3">مكان مخصص لاسم قطعة الغيار</h6>
                <p class="float-left"> <span class="color-r">400</span>ريال</p>

                <p class="float-right"> <span class="color-g">400</span>ريال</p>
                <p class="pt-2 text-center"> <span class="color-d">400</span>ريال</p>

              </div>
            </div>
            <div class="p-container-image-box shadow">
              <a href="#"><img src="{{ site('assets/images/logo.png') }}" alt="">
              </a>
            </div>


          </div>
        </li>
        <li>
          <div class="price-container ">
            <div class="p-container-info-box  float-left">
              <div class="add-card-body shadow p-3 radius">
                <p class="float-left">1999</p>

                <img src="{{ site('assets/images/brand-1.png') }}" alt="" class="float-right">
                <h4 class="text-center pt-2">الماركة</h4>
                <h6 class="text-center mt-3">مكان مخصص لاسم قطعة الغيار</h6>
                <p class="float-left"> <span class="color-r">400</span>ريال</p>

                <p class="float-right"> <span class="color-g">400</span>ريال</p>
                <p class="pt-2 text-center"> <span class="color-d">400</span>ريال</p>

              </div>
            </div>
            <div class="p-container-image-box shadow">
              <a href="#"><img src="{{ site('assets/images/logo.png') }}" alt="">
              </a>
            </div>


          </div>
        </li>
        <li>
          <div class="price-container ">
            <div class="p-container-info-box  float-left">
              <div class="add-card-body shadow p-3 radius">
                <p class="float-left">1999</p>

                <img src="{{ site('assets/images/brand-1.png') }}" alt="" class="float-right">
                <h4 class="text-center pt-2">الماركة</h4>
                <h6 class="text-center mt-3">مكان مخصص لاسم قطعة الغيار</h6>
                <p class="float-left"> <span class="color-r">400</span>ريال</p>

                <p class="float-right"> <span class="color-g">400</span>ريال</p>
                <p class="pt-2 text-center"> <span class="color-d">400</span>ريال</p>

              </div>
            </div>
            <div class="p-container-image-box shadow">
              <a href="#"><img src="{{ site('assets/images/logo.png') }}" alt="">
              </a>
            </div>


          </div>
        </li>
        <li>
          <div class="price-container ">
            <div class="p-container-info-box  float-left">
              <div class="add-card-body shadow p-3 radius">
                <p class="float-left">1999</p>

                <img src="{{ site('assets/images/brand-1.png') }}" alt="" class="float-right">
                <h4 class="text-center pt-2">الماركة</h4>
                <h6 class="text-center mt-3">مكان مخصص لاسم قطعة الغيار</h6>
                <p class="float-left"> <span class="color-r">400</span>ريال</p>

                <p class="float-right"> <span class="color-g">400</span>ريال</p>
                <p class="pt-2 text-center"> <span class="color-d">400</span>ريال</p>

              </div>
            </div>
            <div class="p-container-image-box shadow">
              <a href="#"><img src="{{ site('assets/images/logo.png') }}" alt="">
              </a>
            </div>


          </div>
        </li>
      </ul>
    </div>

  </div>
</section>




 <!-- start add section -->
 <section class="add">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="head-section text-center cust-m-mid">
          <img src="{{ site('assets/images/speed.png') }}" alt="" class="mb-3">
          <h2>أخر الإضافات</h2>
        </div>
      </div>
      <div class="col-md-12">
        <div class="responsive">
          <div class="add-card">
            <div class="add-card-head">
              <div class="add-card-layout">
                <ul class="lay-out-menue">
                  <li><a href="#"><img src="{{ site('assets/images/1.png') }}" alt=""></a></li>
                  <li><a href="#"><img src="{{ site('assets/images/2.png') }}" alt=""></a></li>
                  <li><a href="#"><img src="{{ site('assets/images/3.png') }}" alt=""></a></li>



                </ul>
              </div>

              <img src="{{ site('assets/images/car-1.png') }}" alt="" class="img-fluid">
            </div>
            <div class="add-card-body">
              <p class="float-left">1999</p>

              <img src="{{ site('assets/images/brand-1.png') }}" alt="" class="float-right">
              <h5>الماركة</h5>
              <h6 class="mt-3"><img src="{{ site('assets/images/location.png') }}" alt="">العنوان - السعودية\الدمام</h6>
            </div>
            <div class="add-card-footer">
              <h6><strong>1190</strong> ريال سعودي</h6>
            </div>
          </div>
          <div class="add-card">
            <div class="add-card-head">
              <div class="add-card-layout">
                <ul class="lay-out-menue">
                  <li><a href="#"><img src="{{ site('assets/images/1.png') }}" alt=""></a></li>
                  <li><a href="#"><img src="{{ site('assets/images/2.png') }}" alt=""></a></li>
                  <li><a href="#"><img src="{{ site('assets/images/3.png') }}" alt=""></a></li>



                </ul>
              </div>

              <img src="{{ site('assets/images/car-3.png') }}" alt="" class="img-fluid">
            </div>
            <div class="add-card-body">
              <p class="float-left">1999</p>

              <img src="{{ site('assets/images/brand-1.png') }}" alt="" class="float-right">
              <h5>الماركة</h5>
              <h6 class="mt-3"><img src="{{ site('assets/images/location.png') }}" alt="">العنوان - السعودية\الدمام</h6>
            </div>
            <div class="add-card-footer">
              <h6><strong>1190</strong> ريال سعودي</h6>
            </div>
          </div>
          <div class="add-card">
            <div class="add-card-head">
              <div class="add-card-layout">
                <ul class="lay-out-menue">
                  <li><a href="#"><img src="{{ site('assets/images/1.png') }}" alt=""></a></li>
                  <li><a href="#"><img src="{{ site('assets/images/2.png') }}" alt=""></a></li>
                  <li><a href="#"><img src="{{ site('assets/images/3.png') }}" alt=""></a></li>



                </ul>
              </div>

              <img src="{{ site('assets/images/car-2.png') }}" alt="" class="img-fluid">
            </div>
            <div class="add-card-body">
              <p class="float-left">1999</p>

              <img src="{{ site('assets/images/brand-1.png') }}" alt="" class="float-right">
              <h5>الماركة</h5>
              <h6 class="mt-3"><img src="{{ site('assets/images/location.png') }}" alt="">العنوان - السعودية\الدمام</h6>
            </div>
            <div class="add-card-footer">
              <h6><strong>1190</strong> ريال سعودي</h6>
            </div>
          </div>
          <div class="add-card">
            <div class="add-card-head">
              <div class="add-card-layout">
                <ul class="lay-out-menue">
                  <li><a href="#"><img src="{{ site('assets/images/1.png') }}" alt=""></a></li>
                  <li><a href="#"><img src="{{ site('assets/images/2.png') }}" alt=""></a></li>
                  <li><a href="#"><img src="{{ site('assets/images/3.png') }}" alt=""></a></li>



                </ul>
              </div>

              <img src="{{ site('assets/images/car-4.png') }}" alt="" class="img-fluid">
            </div>
            <div class="add-card-body">
              <p class="float-left">1999</p>

              <img src="{{ site('assets/images/brand-1.png') }}" alt="" class="float-right">
              <h5>الماركة</h5>
              <h6 class="mt-3"><img src="{{ site('assets/images/location.png') }}" alt="">العنوان - السعودية\الدمام</h6>
            </div>
            <div class="add-card-footer">
              <h6><strong>1190</strong> ريال سعودي</h6>
            </div>
          </div>
          <div class="add-card">
            <div class="add-card-head">
              <div class="add-card-layout">
                <ul class="lay-out-menue">
                  <li><a href="#"><img src="{{ site('assets/images/1.png') }}" alt=""></a></li>
                  <li><a href="#"><img src="{{ site('assets/images/2.png') }}" alt=""></a></li>
                  <li><a href="#"><img src="{{ site('assets/images/3.png') }}" alt=""></a></li>



                </ul>
              </div>

              <img src="{{ site('assets/images/car-1.png') }}" alt="" class="img-fluid">
            </div>
            <div class="add-card-body">
              <p class="float-left">1999</p>

              <img src="{{ site('assets/images/brand-1.png') }}" alt="" class="float-right">
              <h5>الماركة</h5>
              <h6 class="mt-3"><img src="{{ site('assets/images/location.png') }}" alt="">العنوان - السعودية\الدمام</h6>
            </div>
            <div class="add-card-footer">
              <h6><strong>1190</strong> ريال سعودي</h6>
            </div>
          </div>
          <div class="add-card">
            <div class="add-card-head">
              <div class="add-card-layout">
                <ul class="lay-out-menue">
                  <li><a href="#"><img src="{{ site('assets/images/1.png') }}" alt=""></a></li>
                  <li><a href="#"><img src="{{ site('assets/images/2.png') }}" alt=""></a></li>
                  <li><a href="#"><img src="{{ site('assets/images/3.png') }}" alt=""></a></li>



                </ul>
              </div>

              <img src="{{ site('assets/images/car-3.png') }}" alt="" class="img-fluid">
            </div>
            <div class="add-card-body">
              <p class="float-left">1999</p>

              <img src="{{ site('assets/images/brand-1.png') }}" alt="" class="float-right">
              <h5>الماركة</h5>
              <h6 class="mt-3"><img src="{{ site('assets/images/location.png') }}" alt="">العنوان - السعودية\الدمام</h6>
            </div>
            <div class="add-card-footer">
              <h6><strong>1190</strong> ريال سعودي</h6>
            </div>
          </div>
          <div class="add-card">
            <div class="add-card-head">
              <div class="add-card-layout">
                <ul class="lay-out-menue">
                  <li><a href="#"><img src="{{ site('assets/images/1.png') }}" alt=""></a></li>
                  <li><a href="#"><img src="{{ site('assets/images/2.png') }}" alt=""></a></li>
                  <li><a href="#"><img src="{{ site('assets/images/3.png') }}" alt=""></a></li>



                </ul>
              </div>

              <img src="{{ site('assets/images/car-2.png') }}" alt="" class="img-fluid">
            </div>
            <div class="add-card-body">
              <p class="float-left">1999</p>

              <img src="{{ site('assets/images/brand-1.png') }}" alt="" class="float-right">
              <h5>الماركة</h5>
              <h6 class="mt-3"><img src="{{ site('assets/images/location.png') }}" alt="">العنوان - السعودية\الدمام</h6>
            </div>
            <div class="add-card-footer">
              <h6><strong>1190</strong> ريال سعودي</h6>
            </div>
          </div>
          <div class="add-card">
            <div class="add-card-head">
              <div class="add-card-layout">
                <ul class="lay-out-menue">
                  <li><a href="#"><img src="{{ site('assets/images/1.png') }}" alt=""></a></li>
                  <li><a href="#"><img src="{{ site('assets/images/2.png') }}" alt=""></a></li>
                  <li><a href="#"><img src="{{ site('assets/images/3.png') }}" alt=""></a></li>



                </ul>
              </div>

              <img src="{{ site('assets/images/car-4.png') }}" alt="" class="img-fluid">
            </div>
            <div class="add-card-body">
              <p class="float-left">1999</p>

              <img src="{{ site('assets/images/brand-1.png') }}" alt="" class="float-right">
              <h5>الماركة</h5>
              <h6 class="mt-3"><img src="{{ site('assets/images/location.png') }}" alt="">العنوان - السعودية\الدمام</h6>
            </div>
            <div class="add-card-footer">
              <h6><strong>1190</strong> ريال سعودي</h6>
            </div>
          </div>
          <div class="add-card">
            <div class="add-card-head">
              <div class="add-card-layout">
                <ul class="lay-out-menue">
                  <li><a href="#"><img src="{{ site('assets/images/1.png') }}" alt=""></a></li>
                  <li><a href="#"><img src="{{ site('assets/images/2.png') }}" alt=""></a></li>
                  <li><a href="#"><img src="{{ site('assets/images/3.png') }}" alt=""></a></li>



                </ul>
              </div>

              <img src="{{ site('assets/images/car-1.png') }}" alt="" class="img-fluid">
            </div>
            <div class="add-card-body">
              <p class="float-left">1999</p>

              <img src="{{ site('assets/images/brand-1.png') }}" alt="" class="float-right">
              <h5>الماركة</h5>
              <h6 class="mt-3"><img src="{{ site('assets/images/location.png') }}" alt="">العنوان - السعودية\الدمام</h6>
            </div>
            <div class="add-card-footer">
              <h6><strong>1190</strong> ريال سعودي</h6>
            </div>
          </div>
          <div class="add-card">
            <div class="add-card-head">
              <div class="add-card-layout">
                <ul class="lay-out-menue">
                  <li><a href="#"><img src="{{ site('assets/images/1.png') }}" alt=""></a></li>
                  <li><a href="#"><img src="{{ site('assets/images/2.png') }}" alt=""></a></li>
                  <li><a href="#"><img src="{{ site('assets/images/3.png') }}" alt=""></a></li>



                </ul>
              </div>

              <img src="{{ site('assets/images/car-3.png') }}" alt="" class="img-fluid">
            </div>
            <div class="add-card-body">
              <p class="float-left">1999</p>

              <img src="{{ site('assets/images/brand-1.png') }}" alt="" class="float-right">
              <h5>الماركة</h5>
              <h6 class="mt-3"><img src="{{ site('assets/images/location.png') }}" alt="">العنوان - السعودية\الدمام</h6>
            </div>
            <div class="add-card-footer">
              <h6><strong>1190</strong> ريال سعودي</h6>
            </div>
          </div>
          <div class="add-card">
            <div class="add-card-head">
              <div class="add-card-layout">
                <ul class="lay-out-menue">
                  <li><a href="#"><img src="{{ site('assets/images/1.png') }}" alt=""></a></li>
                  <li><a href="#"><img src="{{ site('assets/images/2.png') }}" alt=""></a></li>
                  <li><a href="#"><img src="{{ site('assets/images/3.png') }}" alt=""></a></li>



                </ul>
              </div>

              <img src="{{ site('assets/images/car-2.png') }}" alt="" class="img-fluid">
            </div>
            <div class="add-card-body">
              <p class="float-left">1999</p>

              <img src="{{ site('assets/images/brand-1.png') }}" alt="" class="float-right">
              <h5>الماركة</h5>
              <h6 class="mt-3"><img src="{{ site('assets/images/location.png') }}" alt="">العنوان - السعودية\الدمام</h6>
            </div>
            <div class="add-card-footer">
              <h6><strong>1190</strong> ريال سعودي</h6>
            </div>
          </div>
          <div class="add-card">
            <div class="add-card-head">
              <div class="add-card-layout">
                <ul class="lay-out-menue">
                  <li><a href="#"><img src="{{ site('assets/images/1.png') }}" alt=""></a></li>
                  <li><a href="#"><img src="{{ site('assets/images/2.png') }}" alt=""></a></li>
                  <li><a href="#"><img src="{{ site('assets/images/3.png') }}" alt=""></a></li>
                </ul>
              </div>

              <img src="{{ site('assets/images/car-4.png') }}" alt="" class="img-fluid">
            </div>
            <div class="add-card-body">
              <p class="float-left">1999</p>

              <img src="{{ site('assets/images/brand-1.png') }}" alt="" class="float-right">
              <h5>الماركة</h5>
              <h6 class="mt-3"><img src="{{ site('assets/images/location.png') }}" alt="">العنوان - السعودية\الدمام</h6>
            </div>
            <div class="add-card-footer">
              <h6><strong>1190</strong> ريال سعودي</h6>
            </div>
          </div>
        </div>

      </div>

    </div>
  </div>
</section>



<section class="order">
    <div class="container">
      <div class="row ">
        <div class="col-md-12">
          <div class="head-section text-center cust-m-mid">
            <h2> @lang('site.how_to_order') </h2>
          </div>
        </div>

        <div class="col">
          <div class="order-box shadow text-center">
          <img src="{{ site('assets/images/img1.png') }}" alt="">
          </div>

          <div class="or-info">
            <h4> @lang('site.register_piece') </h4>
          </div>
        </div>

        <div class="col"> <span class="step-1"></span>  </div>

        <div class="col">
          <div class="order-box-2 shadow text-center">
            <img src="{{ site('assets/images/img2.png') }}" alt="">          
          </div>
          <div class="or-info">
            <h4> @lang('site.recive_prices') </h4>  
          </div>
        </div>

        <div class="col"> <span class="step-2"></span> </div>

        <div class="col">
          <div class="order-box shadow text-center">
              <img src="{{ site('assets/images/img3.png') }}" alt="">
          </div>

          <div class="or-info">
            <h4> @lang('site.negotiate_and_receive') </h4>
          </div>
        </div>

      </div>
    </div>
  </section>



<!-- start contact -->
<section class="contact ">
  <div class="container">
    <div class="bg-white">
      <div class="row ">
        <div class="col-md-5 pr-0">
          <div class="map-box">
          <img src="{{ site('assets/images/map2.png') }}" alt="" class="img-fluid">
          </div>
        </div>
        <div class="col-md-7 ">
          <div class="map-card">
            <h4> @lang('site.reach_us') </h4>

            <form class="row" id="frm_contact" method="POST" action="{{ route('contact_us') }}">
              @csrf
                <div class="form-group col-12">
                <input type="text" class="form-control h-50" id="name" name="name" value="{{ old('name') }}"
                    placeholder="@lang('site.name')" required>
                </div>

                <div class="form-group col-12">
                  <input type="email" class="form-control h-50" id="email" name="email" value="{{ old('email') }}"
                     placeholder="@lang('site.email')">
                </div>
                
                <div class="form-group col-12">
                  <input type="tel" class="form-control h-50" id="mobile" name="mobile" value="{{ old('mobile') }}"
                    placeholder="@lang('site.mobile')" required>
                </div>
                
                <div class="form-group col-12">
                  <textarea class="form-control h-50" id="message" name="message" rows="1" placeholder="@lang('site.your_message')" required>
                  {{ old('message') }} </textarea>
                </div>
                
                <div class="col-3"></div>
                
                <div class="col-6">
                  <button type="submit" class="btn btn-next btn-block">@lang('site.send')</button>
                </div>
                
                <div class="col-3"></div>  
            </form>

          </div>
        </div>
      </div>
    </div>

  </div>
</section>
 

@endsection

@section('scripts')
    <script src="{{ site('assets/js/highlight.pack.js') }}"></script>
    <script type="text/javascript">

        hljs.initHighlightingOnLoad();

        $(document).ready(function () {

        $('#newsTicker2').breakingNews({
            direction: 'rtl',
            play:true,
            scrollSpeed:3,
            stopOnHover:true,
        });

        });
    </script> 

    <script>
      
      $( "#btn-slide1" ).click(function( event ) {
        
        $("#slide1").hide();
        $("#slide2").show();

      });
    </script>

<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

<script src="{{ site('assets/js/select2.js') }}"></script>

@include('dashboard.ajax.load_models') 
@include('dashboard.ajax.load_regions') 
@include('dashboard.ajax.load_cities')

@endsection

@section('popup')

 <!-- Modal -->
 <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
 aria-labelledby="exampleModalLabel" aria-hidden="true">
 <div class="modal-dialog" role="document">
   <div class="modal-content border-none">
     <div class="modal-header">
       <h5 class="modal-title" id="exampleModalLabel"></h5>
       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">&times;</span>
       </button>
     </div>
     <div class="modal-body">
       <div class="modal-head text-center">
         <h2>البحث العادي والبحث الالكتورني</h2>
       </div>
       <div class="modal-box">
         <h3>البحث العادي</h3>
         <p>هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام "هنا يوجد محتوى نصي، هنا يوجد محتوى نصي" فتجعلها تبدو (أي الأحرف) وكأنها نص مقروء.</p>

       </div>
       <div class="modal-box">
         <h3> البحث الالكتورني</h3>
         <p>هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام "هنا يوجد محتوى نصي، هنا يوجد محتوى نصي" فتجعلها تبدو (أي الأحرف) وكأنها نص مقروء.</p>

       </div>
     </div>
 
   </div>
 </div>
</div>

@endsection