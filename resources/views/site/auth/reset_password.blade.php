@extends('site.app')

@section('title') @lang('site.reset_password') @endsection

@section('styles')
     
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
                                            <h4> @lang('site.reset_password') </h4>
                                            <p> @lang('site.enter_your_phone') </p>
                                        </div>
                                        <div class="tab-content mt-5">
                                        <form class="row" method="post" action="{{ route('reset_password') }}" enctype="multipart/form-data">
                                            @csrf 
                                          
                                            <div class="form-group col-12">
                                                <input type="tel" class="form-control" id="mobile" name="mobile" 
                                                    value="{{ old('mobile') }}" placeholder="@lang('site.mobile')" maxlength="9"
                                                    minlength="9">
                                            </div>
                                             
                                                <button type="submit" class="btn btn-dropform btn-block btn-lg mt-2"> @lang('site.next') </button>
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

    <script src="{{site('assets/js/my_scripts.js')}}"></script>

@endsection