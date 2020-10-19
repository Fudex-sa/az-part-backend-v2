
@extends('site.app')

@section('title') @lang('site.packages') @endsection

@section('styles')
    
@endsection

@section('content')
 

<section class="sub">
    <div class="container">
      <div class="row">
       
        @include('layouts.breadcrumb')
        
        <div class="col-md-12">
          <div class="sub-head-box">
            <h4> @lang('site.choose_your_package') </h4>
            {{-- <p>احصل على أسبوع مجانا بعد تجديد الباقة</p> --}}
          </div>
        </div>


      </div>
      <div class="row text-center ">
        <div class="sub-steps col-md-12">
          <ul class="nav nav-pills  row" id="pills-tab" role="tablist">
            <li class="nav-item col-md-6">  
            <a class="nav-link {{ $type == 'electronic' ? 'active' : '' }}" href="{{ route('package.show','manual') }}">
               @lang('site.manual') </a>
            </li>
            <li class="nav-item col-md-6">
              <a class="nav-link {{ $type == 'manual' ? 'active' : '' }}" href="{{ route('package.show','electronic') }}">
                 @lang('site.electronic') </a>
            </li>

          </ul>
        </div>

        <div class="tab-content" id="pills-tabContent">
          <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">



            <!-- start new row -->
            <div class="row">

              @foreach ($items as $item)

                <div class="col-md-4">
                  <div class="sub-card  text-center">
                    <div class="sub-card-head">
                      <br/>
                    <img src="{{ site('assets/images/sub-1.svg') }}" alt="">
                      <h4>  {{ $item['title_'.my_lang()] }} </h4>

                    </div>
                    <div class="sub-card-body">
                      <ul>
                          <li> 
                            {{ $type == 'manual' ? __('site.stores_no') : __('site.requests_no') }}  :
                            {{ $item->stores_no }}
                          </li>

                          <li> @lang('site.price') : {{ $item->price . ' ' . __('site.rs') }} </li>

                          <li> @lang('site.discount') : {{ $item->discount . ' % '  }} </li>
                      </ul>

                    <a href="{{ route('package.subscribe',$item->id) }}" class="btn btn-sub-1  btn-block btn-lg">
                       @lang('site.subscribe_in_package') </a>
                    </div>
                    
                  </div>
                </div>
              @endforeach


             
            </div>





          </div>
          <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">

            <!-- start new row -->
            <div class="row">
              <div class="col-md-4">
                <div class="sub-card  text-center">
                  <div class="sub-card-head">
                    <img src="assets/images/sub-1.svg" alt="">
                    <h4>الباقة الأولى</h4>

                  </div>
                  <div class="sub-card-body">
                    <h6>أحصل على متجر واحد إضافي
                      في البحث</h6>
                    <p>فقط ب 5 ريال للشهر</p>
                    <button type="button" class="btn btn-sub-1  btn-block btn-lg">إشترك في الباقة</button>
                  </div>
                  <div class="sub-card-footer">
                    <a href="#" class="know-more">إعرف المزيد</a>

                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="sub-card  text-center">
                  <div class="sub-card-head">
                    <img src="assets/images/sub-2.svg" alt="">
                    <h4>الباقة الأولى</h4>

                  </div>
                  <div class="sub-card-body">
                    <h6>أحصل على متجر واحد إضافي
                      في البحث</h6>
                    <p>فقط ب 5 ريال للشهر</p>
                    <button type="button" class="btn btn-sub-1 btn-sub-2 btn-block btn-lg">إشترك في الباقة</button>
                  </div>
                  <div class="sub-card-footer">
                    <a href="#" class="know-more">إعرف المزيد</a>

                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="sub-card  text-center">
                  <div class="sub-card-head">
                    <img src="assets/images/sub-3.svg" alt="">
                    <h4>الباقة الأولى</h4>

                  </div>
                  <div class="sub-card-body">
                    <h6>أحصل على متجر واحد إضافي
                      في البحث</h6>
                    <p>فقط ب 5 ريال للشهر</p>
                    <button type="button" class="btn btn-sub-1 btn-sub-3 btn-block btn-lg">إشترك في الباقة</button>
                  </div>
                  <div class="sub-card-footer">
                    <a href="#" class="know-more">إعرف المزيد</a>

                  </div>
                </div>
              </div>

              <!-- start new row -->

              <div class="col-md-4">
                <div class="sub-card  text-center">
                  <div class="sub-card-head">
                    <img src="assets/images/sub-4.svg" alt="">
                    <h4>الباقة الأولى</h4>

                  </div>
                  <div class="sub-card-body">
                    <h6>أحصل على متجر واحد إضافي
                      في البحث</h6>
                    <p>فقط ب 5 ريال للشهر</p>
                    <button type="button" class="btn btn-sub-1 btn-sub-4 btn-block btn-lg">إشترك في الباقة</button>
                  </div>
                  <div class="sub-card-footer">
                    <a href="#" class="know-more">إعرف المزيد</a>

                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="sub-card  text-center">
                  <div class="sub-card-head">
                    <img src="assets/images/sub-5.svg" alt="">
                    <h4>الباقة الأولى</h4>

                  </div>
                  <div class="sub-card-body">
                    <h6>أحصل على متجر واحد إضافي
                      في البحث</h6>
                    <p>فقط ب 5 ريال للشهر</p>
                    <button type="button" class="btn btn-sub-1 btn-sub-5 btn-block btn-lg">إشترك في الباقة</button>
                  </div>
                  <div class="sub-card-footer">
                    <a href="#" class="know-more">إعرف المزيد</a>

                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="sub-card  text-center">
                  <div class="sub-card-head">
                    <img src="assets/images/sub-6.svg" alt="">
                    <h4>الباقة الأولى</h4>

                  </div>
                  <div class="sub-card-body">
                    <h6>أحصل على متجر واحد إضافي
                      في البحث</h6>
                    <p>فقط ب 5 ريال للشهر</p>
                    <button type="button" class="btn btn-sub-1 btn-sub-6 btn-block btn-lg">إشترك في الباقة</button>
                  </div>
                  <div class="sub-card-footer">
                    <a href="#" class="know-more">إعرف المزيد</a>

                  </div>
                </div>
              </div>

              <!-- start new row -->
              <div class="col-md-4">
                <div class="sub-card  text-center">
                  <div class="sub-card-head">
                    <img src="assets/images/sub-7.svg" alt="">
                    <h4>الباقة الأولى</h4>

                  </div>
                  <div class="sub-card-body">
                    <h6>أحصل على متجر واحد إضافي
                      في البحث</h6>
                    <p>فقط ب 5 ريال للشهر</p>
                    <button type="button" class="btn btn-sub-1 btn-sub-7 btn-block btn-lg">إشترك في الباقة</button>
                  </div>
                  <div class="sub-card-footer">
                    <a href="#" class="know-more">إعرف المزيد</a>

                  </div>
                </div>
              </div>
            </div>


          </div>
        </div>



      </div>

    </div>
  </section>

@endsection