
@extends('site.app')

@section('title') 
  @lang('site.request') {{ $item->id }} : 
  {{ $item->piece_alt ? $item->piece_alt['name_'.my_lang()] : '' }}

@endsection

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

          <div class="col-lg-9 col-md-9  col-9" style="margin-top: -48px;">
          
            <div class="row">
              
              <div class="results">
                <h6>  @lang('site.result_no') :   <span class="text-dark"> @lang('site.result')  {{ count($sellers) }} </span> </h6>
              </div>
            </div>

            <div class="row">
            @foreach ($sellers as $seller)
              
              <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="search-box shadow">
                  <div class="s-box-head text-center">
                    @if($seller->seller->photo)
                      <img src="{{ img_path($seller->seller->photo) }}" alt="" class="img-fluid">
                    @else <img src="{{ site('assets/images/logo.png') }}" alt="" class="img-fluid"> @endif
                  </div>
      
                  <div class="s-box-body">
                    <h4> {{ $seller->seller->name }} </h4>
                    <h6> <span class="btn status-{{ $seller->status_id }}"> {{ $seller->status['name_'.my_lang()] }} </span> </h6>
                  </div>
                  
                  @if($seller->price) 
                    <div class="s-box-footer">
                    <a href="{{ route('offer.add_to_cart',$seller->id) }}" class="btn btn-client float-left"> @lang('site.add_to_cart') </a>
                      <h6> <span> {{ $seller->price }} </span> @lang('site.rs')  </h6>
                    </div>
                  @endif
      
                </div>
              </div>    
            @endforeach
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


 