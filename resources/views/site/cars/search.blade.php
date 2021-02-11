
@extends('site.app')

@section('title')  @lang('site.search_cars') @endsection

@section('styles')

@endsection

@section('content')


<div class="cars-yard">
    <div class="container">
      <div class="row">

        @include('layouts.breadcrumb')

        <div class="col-md-12">
          @if(request()->type == 'damaged')
            @include('site.cars.filter_damaged')
          @else
            @include('site.cars.filter_antique')
          @endif
          
          <div class="results">
              <h6>  @lang('site.result_no') :   <span class="text-dark"> {{ count($items) }}  @lang('site.result')  </span> </h6>
            </div>
          </div>

          <div class="col-md-2"> </div>
          <div class="col-md-8">
            @if($ad_top) <a href="{{ $ad_top->link }}" target="_blank">
               <img src="{{ asset('uploads/'.$ad_top->img) }}" /> </a> @endif
          </div>
          <div class="col-md-2"> </div>
          
          <div class="col-lg-3 col-md-6 col-sm-6">        
            @if($ad_right) <a href="{{ $ad_right->link }}" target="_blank">
              <img src="{{ asset('uploads/'.$ad_right->img) }}" /> </a> @endif
          </div>

          
        @if(count($items) > 0)
          @foreach ($items as $item)

          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="add-card shadow">
              <div class="add-card-head">
                <div class="add-card-layout">
                  <ul class="lay-out-menue">
                    <li> <a href="{{ route('car',$item->id) }}">
                      <img src="{{ site('assets/images/1.png') }}" alt=""></a></li>
                  @if(logged_user() && user_type() == 'user')
                  @if(App\Models\CarFavorite::where('car_id',$item->id)->where('user_id',logged_user()->id)->first())
                    <li><a href="{{ route('control.wishlist.remove_wish_list',$item->id) }}"><img src="{{ site('assets/images/2.png') }}" alt=""></a></li>
                    @else
                    <li><a href="{{ route('control.wishlist.add_wish_list',$item->id) }}"><img src="{{ site('assets/images/2.png') }}" alt=""></a></li>
                  @endif
                @endif

                    <li><a href="https://wa.me/?text={{ $item->title }}" target="_blank">
                      <img src="{{ site('assets/images/3.png') }}" alt=""></a></li>
                  </ul>
                </div>

              @if(count($item->imgs) > 0)
                <img src="{{ img_path($item->imgs[0]->photo) }}" alt="" class="img-fluid">
              @else <img src="{{ site('assets/images/logo.png') }}" alt="" class="img-fluid"> @endif

              </div>
              <div class="add-card-body">
                <p class="float-left"> {{ $item->year }} </p>

              <img src="{{ brand_img($item->brand ? $item->brand['logo'] : '') }}" alt="" class="float-right brand-logo">

              <h6> {{ $item->model ? $item->model['name_'.my_lang()] : '' }}  </h6>

              <h6 class="col-md-12">
                <hr/>
                <a href="{{ route('car',$item->id) }}"> {{ $item->title }} </a>
                {{-- <img src="{{ asset('assets/images/location.png') }}" alt="">
                   {{ $item->region ? $item->region['name_'.my_lang()] : '' }} -
                   {{ $item->city ? $item->city['name_'.my_lang()] : '' }} --}}
              </h6>
              </div>

              @if($item->price_type == 'fixed')
              <div class="add-card-footer">
                @if($item->price) <h6><strong> {{ $item->price }} </strong> @lang('site.rs')  </h6> @endif
              </div>
              @endif

            </div>
          </div>

          @endforeach
        @else
          <div class="text-center"> @lang('site.no_items_found') </div>
        @endif

      </div>
    </div>
  </div>

@endsection

@section('scripts')

  @include('dashboard.ajax.load_models')

  <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

  <script src="{{ site('assets/js/select2.js') }}"></script>

@endsection
