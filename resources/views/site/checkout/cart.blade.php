
@extends('site.app')

@section('title') @lang('site.cart') @endsection

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
              <li class="nav-item col-lg-4 col-md-4 col-sm-12 after-line">

                <a class="nav-link active activeted" id="home-tab" data-toggle="tab" href="#home" role="tab"
                  aria-controls="home" aria-selected="true"><span class="badge cir-active">1</span> @lang('site.items_added')
                </a>
              </li>
              
              <li class="col">
                <div class=""></div>
              <li class="nav-item col-lg-4 col-md-4 col-sm-12 after-line-2">
                <a class="nav-link disabled" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                  aria-controls="profile" aria-selected="false" disabled><span class="badge cir">2</span> @lang('site.shipping')
                </a>
              </li>
              
              <li class="col-lg-1 col-md-1 col-sm-1">
                <div class=""></div>
              </li>
              <li class="nav-item col-lg-2 col-md-2 col-sm-12">
                <a class="nav-link disabled" id="profile-tab-2" data-toggle="tab" href="#profile-2" role="tab"
                  aria-controls="profile-2" aria-selected="false"><span class="badge cir">3</span> @lang('site.payment') </a>
              </li>

            </ul>
            <div class="tab-content">
               

                <div class="shadow row p-5 mt-5 rounded">
                    <div class="col-md-12 mb-5">
                        <div class="head-page">
                        <h4> @lang('site.pieces_prices') </h4>
                        </div>
                    </div>

                    @foreach (cart() as $k=>$item)
                          
                        <div class="col-md-1 col-sm-1">
                            <div class="cart-box"> <h5> {{ $k+1 }} </h5> </div>
                        </div>
         
        
                        <div class="col-md-3 col-sm-3">
                            <div class="cart-box">
                                <h5> {{ $item->piece_alt['name_'.my_lang()] }}  </h5>
                            </div>
                        </div>

                        <div class="col-md-2 col-sm-3">
                            <div class="cart-box">
                                <h5> <span class="blue"> @lang('site.seller') : </span>
                                     {{ $item->seller['name'] }}  </h5>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-3">
                            <div class="cart-box">
                            <h5> {{ $item->price }} @lang('site.rs') </h5>
                            </div>
                        </div>

                        <div class=" col-md-3 col-sm-3">       
                            <div class="cart-box">                     
                            <h5><a onclick="deleteItem({{ $item->id }})" href="javascript:void(0);">
                                    <img src="{{ site('assets/images/remove.png') }}" alt="" class="remove-pen mt-2">
                                </a></h5>                  
                            </div>          
                        </div>
                        
                    @endforeach

                   
                </div>


                
                <div class="row mt-5">
                  <div class="col-lg-7 col-md-5">
                    <div class="dis  shadow  p-4 rounded">
                      <h3 class="col-md-12">كوبون الخصم</h3>
                      <div class="form-group col-md-12">
                        <input type="text" class="form-control" id="discount" placeholder="  أدخل كوبون الخصم">
                      </div>
                    </div>

                  </div>
                  
                  <div class="col-lg-5 col-md-7">
                    <div class="cart-details row  p-4 shadow rounded">
                      
                      @include('site.checkout.sammary')

                      @if(sub_total() > 0)
                        <div class="col-md-12">
                              <a href="{{ route('shipping') }}" class="btn btn-next btn-block btn-lg"> @lang('site.continue_purchase') </a>
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
  </section>

 
@endsection

@section('scripts')

<script src="{{ site('assets/js/bootstrap-input-spinner.js') }}"></script>
<script>
    $("input[type='number']").inputSpinner()
</script>

@include('dashboard.ajax.delete',['target'=>'cart']) 

@endsection