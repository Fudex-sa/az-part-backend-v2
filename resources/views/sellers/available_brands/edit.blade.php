
@extends('site.app')

@section('title')  @lang('site.update') 
        {{ $item->brand['name_'.my_lang()] .' '. $item->model['name_'.my_lang()] }} @endsection

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

          <div class="col-lg-9 col-md-9  col-12">
             
            <form class="row" method="post" action="{{ route('seller.avaliable_model.store',$item->id) }}">
              @csrf 
                
              <div class="form-group col-6">
                <label> @lang('site.brand') </label>

                <select class="form-control select2 input-A" name="brand_id" id="brand_id">
                  <option value=""> @lang('site.choose_brand') </option>
                  @foreach (brands() as $brand)
                      <option value="{{ $brand->id }}" {{ $item->brand_id == $brand->id ? 'selected' : '' }}
                        data-image="{{ brand_img($brand->logo) }}"  class="left"> {{ $brand['name_'.my_lang()] }} </option>    
                  @endforeach
                </select>

              </div>

              <div class="form-group col-6">
                <label> @lang('site.model') </label>

                <select class="form-control select2 input-B" name="model_id" id="model_id">
                  <option value=""> @lang('site.choose_model') </option>
                  
                  @foreach ($models as $model)
                <option value="{{ $model->id }}" {{ $item->model_id == $model->id ? 'selected' : '' }}>
                   {{ $model['name_'.my_lang()] }} </option>
                  @endforeach
              </select>
              </div>
              
              <div class="form-group col-12">
                <label> @lang('site.manufacturing_year') </label>

                <select name="year" class="form-control"> 
                  <option> @lang('site.choose_year') </option>
                  @for($i = date('Y')+1  ; $i >= 1970 ; $i--)
                    <option value="{{ $i }}" {{ $item->year == $i ? 'selected' : '' }}> {{ $i }} </option>
                  @endfor
                </select>
                {{-- @for($i = date('Y')+1  ; $i >= 1970 ; $i--) --}}

                  {{-- @if(in_array($i,$item->years))
                      <label>  <input type="checkbox" name="years[]" value="{{ $i }}" checked> {{ $i }} </label>
                  @else
                      <label>  <input type="checkbox" name="years[]" value="{{ $i }}"> {{ $i }} </label>
                  @endif --}}

                {{-- @endfor --}}
              </div>
              
                  <button type="submit" class="btn btn-dropform btn-block btn-lg mt-2"> @lang('site.next') </button>
              </form>
          
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

 
@endsection
 


@section('scripts')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

    <script src="{{ site('assets/js/select2.js') }}"></script>

    @include('dashboard.ajax.load_models') 
 

@endsection