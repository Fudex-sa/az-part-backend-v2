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

                                            <div class="form-group col-4">
                                                <input type="radio" class="form-check-input" id="user" name="user_type" value="u" checked
                                                {{ old('user_type') == 'u' ? 'checked' : '' }} required> 
                                                <label class="form-check-label" for="user"> @lang('site.user')  </label>
                                            </div>

                                            <div class="form-group col-4">
                                                <input type="radio" class="form-check-input" id="company" name="user_type" value="c"
                                                {{ old('user_type') == 'c' ? 'checked' : '' }}> 
                                                <label class="form-check-label" for="company"> @lang('site.company')  </label>
                                            </div>

                                            <div class="form-group col-4">
                                                <input type="radio" class="form-check-input" id="seller_manu" name="user_type" value="sm"
                                                {{ old('user_type') == 'sm' ? 'checked' : '' }}> 
                                                <label class="form-check-label" for="seller_manu"> @lang('site.manufacturing')  </label>
                                            </div>

                                            <div class="form-group col-4">
                                                <input type="radio" class="form-check-input" id="seller_tashlih" name="user_type" value="st"
                                                {{ old('user_type') == 'st' ? 'checked' : '' }}> 
                                                <label class="form-check-label" for="seller_tashlih"> @lang('site.tashalih')  </label>
                                            </div>

                                            <div class="form-group col-4">
                                                <input type="radio" class="form-check-input" id="broker" name="user_type" value="b"
                                                {{ old('user_type') == 'b' ? 'checked' : '' }}> 
                                                <label class="form-check-label" for="broker"> @lang('site.broker')  </label>
                                            </div>
 
                                            <div class="form-group col-12">
                                                <input type="tel" class="form-control" id="mobile" name="mobile" 
                                                    value="{{ old('mobile') }}" placeholder="@lang('site.mobile')">
                                            </div>
                                            
                                            <div class="form-group col-12">
                                                <input type="password" class="form-control" id="password" name="password" placeholder="@lang('site.password')">
                                            </div>
                                            
                                           
                                                <button type="submit" class="btn btn-dropform btn-block btn-lg mt-2"> @lang('site.login') </button>
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
 
@endsection