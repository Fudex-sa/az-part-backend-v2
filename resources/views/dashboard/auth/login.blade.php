<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ cur_dir() }}">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'AZParts') }} | @lang('site.management_login')  </title>
    <link rel="icon" href="{{ site('images/logo.png') }}" type="image/ico"/>
    
    <!-- Bootstrap -->
  <link href="{{ dashboard('vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ dashboard('vendors/bootstrap-rtl/dist/css/bootstrap-rtl.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
  <link href="{{ dashboard('vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- NProgress -->
  <link href="{{ dashboard('vendors/nprogress/nprogress.css') }}" rel="stylesheet">
    <!-- Animate.css -->
  <link href="{{ dashboard('vendors/animate.css/animate.min.css') }}" rel="stylesheet">

    <!-- Custom Theme Style -->
  <link href="{{ dashboard('build/css/custom.css') }}" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>
      <a class="hiddenanchor" id="reset"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
 
            <form method="post" action="{{ route('admin.login') }}">
                @csrf

              <h1>  @lang('site.management_login')   </h1>
              
              <div class="form-group has-feedback">
                <input type="tel" name="mobile" class="form-control" placeholder="{{ __('site.mobile') }}" required>
                
                <div class="form-control-feedback">
                  <i class="fa fa-phone text-muted"></i>
                </div>

                @if ($errors->has('mobile'))
                    <div id="email-error" class="error text-danger pl-3" for="mobile" style="display: block;">
                    <strong>{{ $errors->first('mobile') }}</strong>
                    </div>
                @endif

              </div>

              <div class="form-group has-feedback">
                <input type="password" name="password" id="password" class="form-control" 
                placeholder="{{ __('site.password') }}"  required autocomplete="new-password">

                <div class="form-control-feedback">
                  <i class="fa fa-lock text-muted"></i>
                </div>

                @if ($errors->has('password'))
                    <div id="password-error" class="error text-danger pl-3" for="password" style="display: block;">
                    <strong>{{ $errors->first('password') }}</strong>
                    </div>
                @endif

              </div>

              <div>
                <button type="submit" value="@lang('site.login')" class="btn btn-success submit" > 
                   <i class="fa fa-lock"> </i> @lang('site.login') </button>
                {{-- <a class="reset_pass" href="#reset"> Reset Password </a> --}}
              </div>

              <div class="clearfix"></div>

              <div class="separator">
               
                <div>
                  <h1><i class="fa fa-car"></i> {{ config('app.name', 'AZParts') }} </h1>
                  <p> &copy;  @lang('site.all_copy_right_reserved') {{ config('app.name', 'AZParts') .' '. date('Y') }}  </p>
                </div>
              </div>
            </form>
          </section>
        </div>
          


      </div>
    </div>

    @include('layouts.message')
  </body>
</html>
