
@extends('site.app')

@section('title')  @lang('site.antique_cars') @endsection

@section('styles')
    
@endsection

@section('content')


<div class="cars-yard">
    <div class="container">
      <div class="row">

        @include('layouts.breadcrumb')

        <div class="col-md-12">
          <form class="row mt-4 m-form m-form-2">

            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="form-group row">
                <label for="city" class="col-md-5">إختر المركة </label>
                <select class="form-control col-md-7" id="city">
                  <option selected>نيسان</option>
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>

                </select>
              </div>

            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="form-group row">
                <label for="city" class="col-md-5">إختر الموديل </label>
                <select class="form-control col-md-7" id="city">
                  <option selected>صاني</option>
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>

                </select>
              </div>

            </div>
            <div class="col-lg-2 col-md-6 col-sm-6">
              <div class="form-group row">
                <label for="city1" class="col-md-7"> سنة الصنع </label>
                <select class="form-control col-md-5" id="city1">
                  <option selected>2012</option>
                  <option>1</option>

                </select>
              </div>

            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="form-group row">
                <label for="city" class="col-md-5"> تصنيف حسب </label>
                <select class="form-control col-md-7" id="city">
                  <option selected>الأقرب</option>
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>

                </select>
              </div>

            </div>
            <div class="col-lg-1 col-md-3 col-sm-6">
              <button type="submit" class="btn btn-go btn-block">تطبيق</button>

            </div>
          </form>
          <div class="results">
            <h6>   عدد النتائج :   <span class="text-dark">نتيجة 13445</span> </h6>
          </div>
        </div>
        <!-- start new row -->
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="add-card shadow">
            <div class="add-card-head">
              <div class="add-card-layout">
                <ul class="lay-out-menue">
                  <li><a href="#"><img src="assets/images/1.png" alt=""></a></li>
                  <li><a href="#"><img src="assets/images/2.png" alt=""></a></li>
                  <li><a href="#"><img src="assets/images/3.png" alt=""></a></li>



                </ul>
              </div>

              <img src="assets/images/car-1.png" alt="" class="img-fluid">
            </div>
            <div class="add-card-body">
              <p class="float-left">1999</p>

              <img src="assets/images/brand-1.png" alt="" class="float-right">
              <h5>الماركة</h5>
              <h6 class="mt-3"><img src="assets/images/location.png" alt="">العنوان - السعودية\الدمام</h6>
            </div>
            <div class="add-card-footer">
              <h6><strong>1190</strong> ريال سعودي</h6>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="add-card shadow">
            <div class="add-card-head">
              <div class="add-card-layout">
                <ul class="lay-out-menue">
                  <li><a href="#"><img src="assets/images/1.png" alt=""></a></li>
                  <li><a href="#"><img src="assets/images/2.png" alt=""></a></li>
                  <li><a href="#"><img src="assets/images/3.png" alt=""></a></li>



                </ul>
              </div>

              <img src="assets/images/car-2.png" alt="" class="img-fluid">
            </div>
            <div class="add-card-body">
              <p class="float-left">1999</p>

              <img src="assets/images/brand-2.png" alt="" class="float-right">
              <h5>الماركة</h5>
              <h6 class="mt-3"><img src="assets/images/location.png" alt="">العنوان - السعودية\الدمام</h6>
            </div>
            <div class="add-card-footer">
              <h6><strong>1190</strong> ريال سعودي</h6>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="add-card shadow">
            <div class="add-card-head">
              <div class="add-card-layout">
                <ul class="lay-out-menue">
                  <li><a href="#"><img src="assets/images/1.png" alt=""></a></li>
                  <li><a href="#"><img src="assets/images/2.png" alt=""></a></li>
                  <li><a href="#"><img src="assets/images/3.png" alt=""></a></li>



                </ul>
              </div>

              <img src="assets/images/car-3.png" alt="" class="img-fluid">
            </div>
            <div class="add-card-body">
              <p class="float-left">1999</p>

              <img src="assets/images/brand-3.png" alt="" class="float-right">
              <h5>الماركة</h5>
              <h6 class="mt-3"><img src="assets/images/location.png" alt="">العنوان - السعودية\الدمام</h6>
            </div>
            <div class="add-card-footer">
              <h6><strong>1190</strong> ريال سعودي</h6>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="add-card shadow">
            <div class="add-card-head">
              <div class="add-card-layout">
                <ul class="lay-out-menue">
                  <li><a href="#"><img src="assets/images/1.png" alt=""></a></li>
                  <li><a href="#"><img src="assets/images/2.png" alt=""></a></li>
                  <li><a href="#"><img src="assets/images/3.png" alt=""></a></li>



                </ul>
              </div>

              <img src="assets/images/car-4.png" alt="" class="img-fluid">
            </div>
            <div class="add-card-body">
              <p class="float-left">1999</p>

              <img src="assets/images/brand-2.png" alt="" class="float-right">
              <h5>الماركة</h5>
              <h6 class="mt-3"><img src="assets/images/location.png" alt="">العنوان - السعودية\الدمام</h6>
            </div>
            <div class="add-card-footer">
              <h6><strong>1190</strong> ريال سعودي</h6>
            </div>
          </div>
        </div>
        <!-- start new row -->
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="add-card shadow">
            <div class="add-card-head">
              <div class="add-card-layout">
                <ul class="lay-out-menue">
                  <li><a href="#"><img src="assets/images/1.png" alt=""></a></li>
                  <li><a href="#"><img src="assets/images/2.png" alt=""></a></li>
                  <li><a href="#"><img src="assets/images/3.png" alt=""></a></li>



                </ul>
              </div>

              <img src="assets/images/car-3.png" alt="" class="img-fluid">
            </div>
            <div class="add-card-body">
              <p class="float-left">1999</p>

              <img src="assets/images/brand-3.png" alt="" class="float-right">
              <h5>الماركة</h5>
              <h6 class="mt-3"><img src="assets/images/location.png" alt="">العنوان - السعودية\الدمام</h6>
            </div>
            <div class="add-card-footer">
              <h6><strong>1190</strong> ريال سعودي</h6>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="add-card shadow">
            <div class="add-card-head">
              <div class="add-card-layout">
                <ul class="lay-out-menue">
                  <li><a href="#"><img src="assets/images/1.png" alt=""></a></li>
                  <li><a href="#"><img src="assets/images/2.png" alt=""></a></li>
                  <li><a href="#"><img src="assets/images/3.png" alt=""></a></li>



                </ul>
              </div>

              <img src="assets/images/car-4.png" alt="" class="img-fluid">
            </div>
            <div class="add-card-body">
              <p class="float-left">1999</p>

              <img src="assets/images/brand-1.png" alt="" class="float-right">
              <h5>الماركة</h5>
              <h6 class="mt-3"><img src="assets/images/location.png" alt="">العنوان - السعودية\الدمام</h6>
            </div>
            <div class="add-card-footer">
              <h6><strong>1190</strong> ريال سعودي</h6>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="add-card shadow">
            <div class="add-card-head">
              <div class="add-card-layout">
                <ul class="lay-out-menue">
                  <li><a href="#"><img src="assets/images/1.png" alt=""></a></li>
                  <li><a href="#"><img src="assets/images/2.png" alt=""></a></li>
                  <li><a href="#"><img src="assets/images/3.png" alt=""></a></li>



                </ul>
              </div>

              <img src="assets/images/car-2.png" alt="" class="img-fluid">
            </div>
            <div class="add-card-body">
              <p class="float-left">1999</p>

              <img src="assets/images/brand-1.png" alt="" class="float-right">
              <h5>الماركة</h5>
              <h6 class="mt-3"><img src="assets/images/location.png" alt="">العنوان - السعودية\الدمام</h6>
            </div>
            <div class="add-card-footer">
              <h6><strong>1190</strong> ريال سعودي</h6>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="add-card shadow">
            <div class="add-card-head">
              <div class="add-card-layout">
                <ul class="lay-out-menue">
                  <li><a href="#"><img src="assets/images/1.png" alt=""></a></li>
                  <li><a href="#"><img src="assets/images/2.png" alt=""></a></li>
                  <li><a href="#"><img src="assets/images/3.png" alt=""></a></li>



                </ul>
              </div>

              <img src="assets/images/car-2.png" alt="" class="img-fluid">
            </div>
            <div class="add-card-body">
              <p class="float-left">1999</p>

              <img src="assets/images/brand-1.png" alt="" class="float-right">
              <h5>الماركة</h5>
              <h6 class="mt-3"><img src="assets/images/location.png" alt="">العنوان - السعودية\الدمام</h6>
            </div>
            <div class="add-card-footer">
              <h6><strong>1190</strong> ريال سعودي</h6>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection