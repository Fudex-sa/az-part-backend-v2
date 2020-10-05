@extends('site.app')

@section('title') @lang('site.home') @endsection

@section('styles')
    <link rel="stylesheet" href="{{ site('assets/css/breaking-news-ticker.min.css') }}">
@endsection

@section('content')
    
<section class="header">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="logo-box text-center">
          <img src="{{ site('assets/images/logo-box.png') }}" alt="">
          </div>
          <div class="info-box text-center">
            <h1>هل تبحث عن قطع غيار لسيارتك ؟</h1>
            <p>كان لورم اوبسم هو النص الوهمي القياسي في الصناعة منذ القرن الخامس عشر الميلادي ، عندما أخذت الطابعة غير المعروفة مجموعة من الألوان
            </p>
          </div>
        </div>
        <div class="col-md-12" id="slide">
          <div class="row">
            <div class="ui-widget col-md-4">
              <input id="tags" class="form-control input-A" placeholder="إختر المركة">
              
            </div>
            <div class="ui-widget col-md-4">
              <input id="tags-2" class="form-control input-B" placeholder="إختر الموديل">
              
            </div>
            <div class="ui-widget col-md-4">
              <input id="tags-3" class="form-control input-C" placeholder="سنة الصنع">
              
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-4 ">
              <button type="button" class="btn btn-next btn-block btn-lg" id="btn-slide"  value="Show text input">التالي</button>
  
            </div>
          </div>
        </div>
        <div class="col-md-12" id="slide-2">
          <div class="row ">
            <div class="col-md-2"></div>
            <div class="ui-widget col-md-4">
              <input id="tags-4" class="form-control input-D" placeholder="إختر المركة">
              
            </div>
            <div class="ui-widget col-md-4">
              <input id="tags-5" class="form-control input-E" placeholder="إختر الموديل">
              
            </div>
            <div class="col-md-2"></div>
  
            <div class="col-md-4"></div>
  
            <div class="col-md-4 ">
              <button type="button" class="btn btn-next btn-block btn-lg" >بحث الآن</button>
  
            </div>
          </div>
        </div>
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
            <h2> @lang('site.stock') </h2>
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
  
                    <img src="assets/images/brand-1.png" alt="" class="float-right">
                    <h4 class="text-center pt-2">الماركة</h4>
                    <h6 class="text-center mt-3">مكان مخصص لاسم قطعة الغيار</h6>
                    <p class="float-left"> <span class="color-r">400</span>ريال</p>
  
                    <p class="float-right"> <span class="color-g">400</span>ريال</p>
                    <p class="pt-2 text-center"> <span class="color-d">400</span>ريال</p>
  
                  </div>
                </div>
                <div class="p-container-image-box shadow">
                  <a href="#"><img src="assets/images/logo.png" alt="">
                  </a>
                </div>
         
  
              </div>
            </li>
            <li>
              <div class="price-container ">
                <div class="p-container-info-box  float-left">
                  <div class="add-card-body shadow p-3 radius">
                    <p class="float-left">1999</p>
  
                    <img src="assets/images/brand-1.png" alt="" class="float-right">
                    <h4 class="text-center pt-2">الماركة</h4>
                    <h6 class="text-center mt-3">مكان مخصص لاسم قطعة الغيار</h6>
                    <p class="float-left"> <span class="color-r">400</span>ريال</p>
  
                    <p class="float-right"> <span class="color-g">400</span>ريال</p>
                    <p class="pt-2 text-center"> <span class="color-d">400</span>ريال</p>
  
                  </div>
                </div>
                <div class="p-container-image-box shadow">
                  <a href="#"><img src="assets/images/logo.png" alt="">
                  </a>
                </div>
         
  
              </div>
            </li>
            <li>
              <div class="price-container ">
                <div class="p-container-info-box  float-left">
                  <div class="add-card-body shadow p-3 radius">
                    <p class="float-left">1999</p>
  
                    <img src="assets/images/brand-1.png" alt="" class="float-right">
                    <h4 class="text-center pt-2">الماركة</h4>
                    <h6 class="text-center mt-3">مكان مخصص لاسم قطعة الغيار</h6>
                    <p class="float-left"> <span class="color-r">400</span>ريال</p>
  
                    <p class="float-right"> <span class="color-g">400</span>ريال</p>
                    <p class="pt-2 text-center"> <span class="color-d">400</span>ريال</p>
  
                  </div>
                </div>
                <div class="p-container-image-box shadow">
                  <a href="#"><img src="assets/images/logo.png" alt="">
                  </a>
                </div>
         
  
              </div>
            </li>
            <li>
              <div class="price-container ">
                <div class="p-container-info-box  float-left">
                  <div class="add-card-body shadow p-3 radius">
                    <p class="float-left">1999</p>
  
                    <img src="assets/images/brand-1.png" alt="" class="float-right">
                    <h4 class="text-center pt-2">الماركة</h4>
                    <h6 class="text-center mt-3">مكان مخصص لاسم قطعة الغيار</h6>
                    <p class="float-left"> <span class="color-r">400</span>ريال</p>
  
                    <p class="float-right"> <span class="color-g">400</span>ريال</p>
                    <p class="pt-2 text-center"> <span class="color-d">400</span>ريال</p>
  
                  </div>
                </div>
                <div class="p-container-image-box shadow">
                  <a href="#"><img src="assets/images/logo.png" alt="">
                  </a>
                </div>
         
  
              </div>
            </li>
          </ul>
        </div>
  
      </div>

</section>


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
@endsection
