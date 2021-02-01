
@extends('site.app')

@section('title')   @lang('site.elec_req_no') {{ $item->id }} @endsection

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

          <div class="col-lg-9 col-md-9  col-12" style="margin-top:-20px;">
           
            
            <div class="row">
            
            <div class="col-md-12">
              <div class="row">

                <div class="col-md-12">
                  <div class="map-info-xz">                    
                    <h5 class="mt-3"> <a href="#" class="padiaa" >
                    <img src="{{ site('assets/images/location.png') }}" alt="">  
                        {{ $item->country ? $item->country['name_'.my_lang()] : '' }} -
                        {{ $item->region ? $item->region['name_'.my_lang()] : '' }} -
                        {{ $item->city ? $item->city['name_'.my_lang()] : '' }}
                    </a></h5>                    
                  </div>
                   
                </div>

                <div class="col-md-12 ">
                  <div class="border rounded mt-3 pt-3 pr-3 pb-1">
                    <div class="row ">
                      <div class="col-md-4">
                        <div class="back-back">
                          <h4> @lang('site.request_no') : <span> ER-{{ $item->id }} </span></h4>
                        </div>
                      </div>
    
                      <div class="col-md-8">
                        <div class="back-back">
                          <h4> @lang('site.user') : 
                            <span>  {{ $item->user->name }}   ( {{ __('site.'.$item->user_type) }} )  </span>
                          </h4>
                        </div>
                      </div>
                        
                    </div>
                  </div>
                  <br/> <br/>

                </div>

                <div class="col-md-2">
                  @if($item->photo)
                      <img src="{{ cart_img($item->photo) }}" class="img-fluid" />  
                    @else <img src="{{ site('assets/images/logo.png') }}" class="img-fluid" />
                  @endif                  
                </div>
                <div class="col-md-8">
                  <div class="model-xx mt-2">
                    <h6> 
                      {{ $item->brand ? $item->brand['name_'.my_lang()] : '' }}-
                      {{ $item->model ? $item->model['name_'.my_lang()] : '' }}-
                      {{ $item->year }}  
                    </h6>

                    <h6>  {{ $item->piece_alt->piece['name_'.my_lang()] }}  </h6>
                  </div>
                </div>

                <div class="col-md-2">
                  <div class="pri-pop mt-2">
                    <h6> @lang('site.qty') : {{ $item->qty }} </h6>
                    <h6> @lang('site.color') : {{ $item->color }} </h6>
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="cli-nots mt-3 border rounded p-3">
                    <h6><span class="noti"> @lang('site.notes') </span></h6>
                    <h6> {{ $item->notes ? $item->notes : '-' }} </h6>
                  </div>
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

@section('popup')
 
@endsection


@section('scripts')
   
@endsection