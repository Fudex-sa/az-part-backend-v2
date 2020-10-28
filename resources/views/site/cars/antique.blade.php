
@extends('site.app')

@section('title')  @lang('site.antique_cars') @endsection

@section('styles')
    
@endsection

@section('content')


<div class="cars-yard">
    <div class="container">
      <div class="row">

        @include('layouts.breadcrumb')

        <div class="col-md-12">
          @include('site.cars.filter')

          <div class="results">
            <h6>  @lang('site.result_no') :   <span class="text-dark"> {{ count($items) }}  @lang('site.result')  </span> </h6>
          </div>
        </div>

        @if(count($items) > 0)
          @foreach ($items as $item)
              
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="add-card shadow">
              <div class="add-card-head">
                <div class="add-card-layout">
                  <ul class="lay-out-menue">
                  <li><a href="#"><img src="{{ site('assets/images/1.png') }}" alt=""></a></li>
                  <li><a href="#"><img src="{{ site('assets/images/2.png') }}" alt=""></a></li>
                  <li><a href="#"><img src="{{ site('assets/images/3.png') }}" alt=""></a></li>
                  </ul>
                </div>
                
                @if(count($item->imgs) > 0)
                  <img src="{{ img_path($item->imgs[0]->photo) }}" alt="" class="img-fluid">
                @else <img src="{{ site('assets/images/logo.png') }}" alt="" class="img-fluid"> @endif

              </div>
              <div class="add-card-body">
                <p class="float-left"> {{ $item->year }} </p>
  
              <img src="{{ brand_img($item->brand ? $item->brand['logo'] : '') }}" alt="" class="float-right brand-logo">

              <h6> <a href="{{ route('car',$item->id) }}">{{ $item->model ? $item->model['name_'.my_lang()] : '' }} </a> </h6>

              <h6 class="mt-3"><img src="{{ site('assets/images/location.png') }}" alt="">
                   {{ $item->region ? $item->region['name_'.my_lang()] : '' }} -
                   {{ $item->city ? $item->city['name_'.my_lang()] : '' }}
              </h6>
              </div>

              @if($item->price_type == 'fixed')
              <div class="add-card-footer">
                <h6><strong> {{ $item->price }} </strong> @lang('site.rs')  </h6>
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