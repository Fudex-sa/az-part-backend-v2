@extends('site.app')

@section('title') @lang('site.login') @endsection

@section('styles')
    <link href="{{asset('templates/maps/style.css')}}" type="text/css" rel="stylesheet">
    
@endsection

@section('content')


<section class="login">
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="white-card shadow">
 
                      <div class="tab-content" id="myTabContent">
                         
                        <div class="tab-pane fade show active">
                            
                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-8">
                                    <div class="tab-card">
                                        <div class="tab-card-head text-center pb-2">
                                            <h4> @lang('site.login') </h4>
                                            <p> @lang('site.enter_the_below_required_data') </p>
                                        </div>
                                        <div class="tab-content mt-5">
                                        <form class="row" method="post" action="{{ route('user.login') }}" >
                                            @csrf 
 
                                                <div class="form-group col-12">
                                                    <input type="tel" class="form-control" id="mobile" name="mobile" maxlength="9" minlength="9" 
                                                        value="{{ old('mobile') }}" placeholder="@lang('site.mobile')">
                                                </div>
                                                
                                                <div class="form-group col-12">
                                                    <input type="password" class="form-control" id="password" name="password" 
                                                    placeholder="@lang('site.password')" autocomplete="new-password">
                                                </div>
                                                
                                                <div class="form-group col-12">
                                                    <button type="submit" class="btn btn-dropform btn-block btn-lg mt-2"> @lang('site.login') </button>
                                                </div>
                                                
                                            </form>

                                            <div class="form-group col-12">
                                                <label class="form-check-label">
                                                    <a href="{{ route('signup_as') }}" class=""> @lang('site.or_register_now') </a>
                                                </label>                                                
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2"></div>
                            </div>
                    
                        </div>

                         
                      </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
    </section>


@endsection

@section('scripts')
    
    <script src="{{site('assets/js/my_scripts.js')}}"></script>

@endsection