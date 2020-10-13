
@extends('site.app')

@section('title') @lang('site.profile') @endsection

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

          <div class="col-lg-10 col-md-10  col-12">
         
              <div class="tab-pane fade show active" id="profile" role="tabpanel"
                aria-labelledby="profile">
                <div class="row">
                  <div class="col-md-12">
                    <div class="btn-add-container float-left">
                      <button type="submit" class="btn btn-save"> @lang('site.save') </button>

                    </div>
                    <div class="up-img">
                      <input type='file' class="imgpo" onchange="readURLL(this);" />
                      <span class="file-hover"> @lang('site.change') </span>
                    <img id="blah" src="{{ site('assets/images/avatar.jpg') }}" alt="" class="img-fluid">
                    </div>
                    <div class="pro-image-upload mt-4">
                      
                      <h5> {{ logged_user()->name }} </h5>
                      <h6> {{ logged_user()->mobile }} </h6>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <form class="profile-form row mt-3">
                      <div class="form-group col-md-6">
                        <input type="text" class="form-control pro-input" id="username" placeholder="الإسم ">
                      </div>
                      <div class="form-group col-md-6">
                        <input type="email" class="form-control pro-input" id="Email"
                          placeholder="البريد الإلكتروني ">
                      </div>
                      <div class="form-group col-md-6">
                        <input type="tel" class="form-control pro-input" id="userphone" placeholder="الجوال ">
                      </div>
                      <div class="form-group col-md-6">
                        <input type="text" class="form-control pro-input" id="city" placeholder="المدينة ">
                      </div>
                      <div class="form-group col-md-12">
                        <input type="text" class="form-control pro-input" id="address" placeholder="العنوان ">
                      </div>
                      <div class="form-group col-md-6  offset-md-6">
                        <h3 class="mt-5 mb-2">تغيير كلمة المرور</h3>
                      </div>
                      <div class="form-group col-md-6">
                        <input type="password" class="form-control pro-input" id="oldpass"
                          placeholder="كلمة المرور القديمة ">
                      </div>
                      <div class="form-group col-md-6  offset-md-6">
                        <input type="password" class="form-control pro-input" id="newpass"
                          placeholder="كلمة المرور الجديدة ">
                      </div>
                      <div class="form-group col-md-6  offset-md-6">
                        <input type="password" class="form-control pro-input" id="renewpass"
                          placeholder="أعد كلمة المرور الجديدة ">
                      </div>
                    </form>
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

@section('scripts')

    <script src="{{ site('assets/js/bootstrap-input-spinner.js') }}"></script>
    <script>
      $("input[type='number']").inputSpinner()
    </script>

@endsection