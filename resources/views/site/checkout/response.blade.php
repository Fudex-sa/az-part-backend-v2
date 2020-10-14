
@extends('site.app')

@section('title') @lang('site.payment_status') @endsection

@section('styles')
    
@endsection

@section('content')
 
<section class="cart">
    <div class="container">
      <div class="row">

        @include('layouts.breadcrumb')
         
        <div class="col-md-12">
          <div class="white-card  white-card-2">
            <ul class="nav nav-tabs row" id="myTab" role="tablist">
              <li class="nav-item col-lg-4 col-md-4 col-sm-12 after-line  after-line-3">

                <a class="nav-link disabled activeted" id="home-tab" data-toggle="tab" href="#home" role="tab"
                  aria-controls="home" aria-selected="true"><span class="badge cir-active">1</span> @lang('site.items_added')  
                </a>
              </li>
              <li class="col">
                <div class=""></div>
              <li class="nav-item col-lg-4 col-md-4 col-sm-12 after-line-2  after-line-3">
                <a class="nav-link disabled activeted" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                  aria-controls="profile" aria-selected="false" disabled><span class="badge cir-active">2</span>  @lang('site.shipping')
                </a>
              </li>
              <li class="col-lg-1 col-md-1 col-sm-1">
                <div class=""></div>
              </li>
              <li class="nav-item col-lg-2 col-md-2 col-sm-12">
                <a class="nav-link active activeted" id="profile-tab-2" data-toggle="tab" href="#profile-2" role="tab"
                  aria-controls="profile-2" aria-selected="false"><span class="badge cir">3</span> @lang('site.payment') </a>
              </li>

            </ul>
            <div class="tab-content" id="myTabContent">

                     
                       <div class="tab-pane fade show active" id="profile-2" role="tabpanel" aria-labelledby="profile-tab-2">
                      
                        <div class="row mt-5">
                          <div class="col-md-12">
                            <div class="cart-address shadow rounded">
                            
                                @if($responseData['result']['code'] == env('HYPERPAY_SUCCESS'))
                                
                                    <div class="alert alert-success col-md-12 text-center pt-4 shadow rounded" role="alert">

                                        <h4 class="pt-2"> <img src="assets/images/ok.png" alt="" class=" pl-2">
                                            {{$responseData['result']['description']}}
                                        </h4>

                                    </div>
                                    @else

                                    <div class="alert alert-danger col-md-12 text-center pt-4 shadow rounded" role="alert">

                                        <h4 class="pt-2"> <i class="fa fa-close"> </i>
                                            {{$responseData['result']['description']}}
                                        </h4>
                                        
                                    </div>
                                    
                                @endif

                            </div>
                    
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
 
@endsection