@extends('site.app')

@section('title') @lang('site.new_registeration') @endsection

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

                    <ul class="nav nav-tabs row" id="myTab" role="tablist">
                        <li class="nav-item col-md-3">
                          <a class="nav-link"> 
                            <span class="badge cir">1</span> @lang('site.data') 
                          </a>
                        </li>
                        
                        <li class="col-md-6 col-12"><div class="step"></div></li>

                        <li class="nav-item col-md-3">
                          <a class="nav-link  active activeted"> 
                            <span class="badge cir-active">2</span> @lang('site.confirmation') 
                          </a> 
                        </li>               
                      </ul>

                      <div class="tab-content" id="myTabContent">

                        <div class="fade show active">
                            
                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-7">
                                    <div class="tab-card">
                                        <div class="tab-card-head text-center pb-2">
                                            <h4> @lang('site.continue_signup') </h4>
                                            <p> @lang('site.enter_your_verfication_code_sent_to_your_mobile') </p>
                                        </div>
                                        <div class="tab-content mt-5">
                                        <form class="row" method="POST" action="{{ route('confirm',['id' => $id , 'type' => $type]) }}">
                                          @csrf
                                            <div class="row d-flex justify-content-center" dir="ltr">
                                                <div class="form-group col">
                                                    <input type="text" class="form-control ver-code" name="verification_code[]" maxlength="1" required tabindex="5">
                                                  </div>
                                                  <div class="form-group col">
                                                    <input type="text" class="form-control ver-code" name="verification_code[]" maxlength="1" required tabindex="4">
                                                  </div>
                                                  <div class="form-group col">
                                                    <input type="text" class="form-control ver-code" name="verification_code[]" maxlength="1" required tabindex="3">
                                                  </div>
                                                  <div class="form-group col">
                                                    <input type="text" class="form-control ver-code" name="verification_code[]" maxlength="1" required tabindex="2">
                                                  </div>
                                                  <div class="form-group col">
                                                    <input type="text" class="form-control ver-code" name="verification_code[]" maxlength="1" required tabindex="1">
                                                  </div>
                                            </div>
                          
                                            <div class="tab-card-head text-center pb-2">
                                            <a href="{{ route('resend_code',['id' => $id , 'type' => $type]) }}"> @lang('site.resend_code') </a> 
                                          </div>

                                            <button type="submit" class="btn btn-dropform btn-block btn-lg mt-2"> @lang('site.send') </button>
                                        </form>
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