
@extends('site.app')

@section('title') @lang('site.home') @endsection

@section('styles')
    <link rel="stylesheet" href="{{ site('assets/css/breaking-news-ticker.min.css') }}">
@endsection

@section('content')
    
<section class="header">
  <div class="container">
    <div class="row d-flex justify-content-center">

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
          <div class="row ">
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
          <div class="row">

            <div class="ui-widget col-md-4">

                <select class="form-control input-C" name="country" id="country_id">
                    <option value=""> @lang('site.choose_country') </option>
                    @foreach (countries() as $country)
                        <option value="{{ $country->id }}"> {{ $country['name_'.my_lang()] }} </option>    
                    @endforeach
                </select>
            </div>

            <div class="ui-widget col-md-4">
              <select class="form-control input-C" name="region" id="region_id">
                <option value=""> @lang('site.choose_region') </option>                 
              </select>
            </div>

            <div class="ui-widget col-md-4">
              <select class="form-control input-C" name="city" id="cities">
                <option value=""> @lang('site.choose_city') </option>                 
              </select>
            </div>
            <div class="col-md-4"></div>

            <div class="ui-widget col-md-4 col-10">
                           <select name="search_type" class="form-control input-E  mt-44">
                    <option value=""> @lang('site.search_type') </option>
                    <option value="manual"> @lang('site.manual') </option>
                    <option value="electronic"> @lang('site.electronic') </option>
                </select>

            </div>
            
                <div class="col-md-2 col-2">                  
                  <button type="button" class="btn btn-info-2" data-toggle="modal" data-target="#search_types"></button>
                </div>
                <div class="col-md-2"></div>

            <div class="col-md-3"></div>

             <div class="col-md-1 col-1">
             <a href="javascript:void(0);" class="float-left an-back" id="back"> <img src="{{ site('assets/images/back.png') }}" alt="" class="img-fluid"> </a>

            </div>
            <div class="col-md-4 col-11">
              <button type="submit" class="btn btn-next  btn-lg btn-block"> @lang('site.search')  </button>

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
          <h2> @lang('site.stock') </h2>
        </div>
      </div>

    </div>
  </div>


  <div class="bn-breaking-news" id="newsTicker2">
    <div class="bn-news">
      <ul>

        @foreach ($stocks as $stock)

        @if($stock->max_price != $stock->min_price)
        <li>
          <div class="price-container ">
            <div class="p-container-info-box  float-left">
              <div class="add-card-body shadow p-3 radius">
                <p class="float-left"> {{ $stock->year }} </p>

                <img src="{{ brand_img($stock->brand->logo) }}" alt="" class="float-right brand-logo">

                <h4 class="text-center pt-2"> {{ $stock->brand['name_'.my_lang()] }} </h4>

                <h6 class="text-center mt-3"> {{ $stock->piece['name_'.my_lang()] }} </h6>

                <p class="float-right"> <span class="color-r"> {{ $stock->max_price }} </span> @lang('site.rs') </p>

                <p class="float-left">
                  <span class="color-g"> {{ $stock->min_price }} </span> @lang('site.rs')
                </p>
                <p class="pt-2 text-center">
                  <span class="color-d"> {{ round($stock->avg_price,2) }} </span> @lang('site.rs') 
                </p>

              </div>
            </div>
            <div class="p-container-image-box shadow">
              <a href="#"><img src="{{ site('assets/images/logo.png') }}" alt="">
              </a>
            </div>
          </div>
        </li>   
        @endif
        @endforeach
         
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
          <h2> @lang('site.latest_additional')  </h2>
        </div>
      </div>
      <div class="col-md-12">
        <div class="responsive">

          @foreach ($cars as $car)
            <div class="add-card">
              <div class="add-card-head">
                <div class="add-card-layout">
                  <ul class="lay-out-menue">
                    <li><a href="{{ route('car',$car->id) }}"><img src="{{ site('assets/images/1.png') }}" alt=""></a></li>
                    <li><a href="#"><img src="{{ site('assets/images/2.png') }}" alt=""></a></li>
                    <li><a href="#"><img src="{{ site('assets/images/3.png') }}" alt=""></a></li>
                    </ul>
                </div>

                @if(count($car->imgs) > 0)
                  <img src="{{ img_path($car->imgs[0]->photo) }}" alt="" class="img-fluid">
                @else <img src="{{ site('assets/images/logo.png') }}" alt="" class="img-fluid"> @endif

              </div>
              <div class="add-card-body">
                <p class="float-left"> {{ $car->year }} </p>

                <img src="{{ brand_img($car->brand ? $car->brand['logo'] : '') }}" alt="" class="float-right brand-logo">

                <h6> {{ $car->model ? $car->model['name_'.my_lang()] : '' }}  </h6>

                <h6 class="mt-3"><img src="{{ site('assets/images/location.png') }}" alt="">
                  {{ $car->region ? $car->region['name_'.my_lang()] : '' }} -
                  {{ $car->city ? $car->city['name_'.my_lang()] : '' }}
                </h6>

              </div>
              
              @if($car->price_type == 'fixed')
                <div class="add-card-footer">
                  <h6><strong> {{ $car->price }} </strong> @lang('site.rs')  </h6>
                </div>
              @endif

            </div>   
          @endforeach
           
            
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
 

<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

<script src="{{ site('assets/js/select2.js') }}"></script>

@include('dashboard.ajax.load_models') 
@include('dashboard.ajax.load_regions') 
@include('dashboard.ajax.load_cities')

@endsection

@section('popup')

 <!-- Modal -->
 <div class="modal fade" id="search_types" tabindex="-1" role="dialog"
 aria-labelledby="exampleModalLabel" aria-hidden="true">
 <div class="modal-dialog modal-lg" role="document">
   <div class="modal-content border-none">
     <div class="modal-header">
       <h5 class="modal-title" id="exampleModalLabel"></h5>
       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">&times;</span>
       </button>
     </div>
     <div class="modal-body row px-5">
       <div class="modal-head text-center col-md-12">
         <h2>أختر نوع البحث</h2>
       </div>
       <div class="modal-box col-md-6">
         <div class="alert-info-2">
         <h3> <img src="{{ site('assets/images/hand.svg') }}" alt="" class="pb-3 pl-2"> البحث العادي</h3>
           <h5 class="my-3"><span class="warning">تنبيهات </span></h5>
           <ul class="take-care">
             <li><span class="dash">-</span> هناك حقيقة مثبتة منذ زمن طويل وهي أن </li>
             <li><span class="dash">-</span> هناك حقيقة مثبتة منذ زمن طويل وهي أن </li>

             <li><span class="dash">-</span> هناك حقيقة مثبتة منذ زمن طويل وهي أن </li>
             <li><span class="dash">-</span> هناك حقيقة مثبتة منذ زمن طويل وهي أن </li>

           </ul>
         </div>
         <div class="skills-11">
           <h5 class="my-3"><span class="skill">مميزات </span></h5>
           <ul class="take-care">
             <li><span class="dash">-</span> هناك حقيقة مثبتة منذ زمن طويل وهي أن </li>
             <li><span class="dash">-</span> هناك حقيقة مثبتة منذ زمن طويل وهي أن </li>
           </ul>

         </div>
       </div>
       <div class="modal-box col-md-6">
         <div class="alert-info-2">
         <h3> <img src="{{ site('assets/images/rocket.svg') }}" alt="" class="pb-3 pl-2">البحث الإلكترونى</h3>
           <h5 class="my-3"><span class="warning">تنبيهات </span></h5>
           <ul class="take-care">
             <li><span class="dash">-</span> هناك حقيقة مثبتة منذ زمن طويل وهي أن </li>
             <li><span class="dash">-</span> هناك حقيقة مثبتة منذ زمن طويل وهي أن </li>

             <li><span class="dash">-</span> هناك حقيقة مثبتة منذ زمن طويل وهي أن </li>
             <li><span class="dash">-</span> هناك حقيقة مثبتة منذ زمن طويل وهي أن </li>

           </ul>
         </div>
         <div class="skills-11">
           <h5 class="my-3"><span class="skill">مميزات </span></h5>
           <ul class="take-care">
             <li><span class="dash">-</span> هناك حقيقة مثبتة منذ زمن طويل وهي أن </li>
             <li><span class="dash">-</span> هناك حقيقة مثبتة منذ زمن طويل وهي أن </li>
           </ul>

         </div>
       </div>
     </div>
     <div class="modal-footer-2 text-center mb-5 row">
       <div class="form-check col-md-12 text-center">
         <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" required>
         <label class="form-check-label pr-4" for="exampleRadios1">
           أوافق على جميع الشروط والأحكام الخاصة          
         </label>
       </div>
       <div class="col-md-4"></div>
       <button type="button" class="btn btn-next col-md-4 btn-block" data-dismiss="modal">موافق علي اكمال الطلب</button>
     </div>
   </div>
 </div>
</div>

@endsection