
@extends('site.app')

@section('title') @lang('site.old_stock') @endsection

@section('styles')
    
@endsection

@section('content')
 
 <div class="cars-yard">
  <div class="container">
    <div class="row">
      
      @include('layouts.breadcrumb')

      <div class="col-md-12">
      <form class="row mt-4 m-form m-form-2" method="GET" action="{{ route('stock.filter') }}">

          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="form-group row">
              <label for="city" class="col-md-5"> @lang('site.brand') </label>

              <select class="form-control col-md-7 select2" name="brand_id" id="brand_id">
                <option value=""> @lang('site.choose_brand') </option>
                @foreach ($brands as $brand)
                    <option value="{{ $brand->id }}"
                      data-image="{{ brand_img($brand->logo) }}"  class="left"> {{ $brand['name_'.my_lang()] }} </option>    
                @endforeach
              </select>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="form-group">
              <label for="city"> @lang('site.choose_model') </label>
              <select class="form-control" name="model_id" id="model_id">
                <option selected> @lang('site.choose_model') </option>
                
              </select>
            </div>
          </div>
          
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="form-group">
              <label for="city1"> @lang('site.manufacturing_year') </label>
              <select class="form-control" name="year" id="year">
                <option selected> @lang('site.choose_brand') </option>
                @for($i = date('Y')+1  ; $i >= 1970 ; $i--)
                    <option value="{{$i}}" {{ app('request')->input('year')  == $i ? 'selected' : '' }}
                    >{{$i}}</option>
                @endfor
              </select>
            </div>

          </div>

          {{-- <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="form-group">
              <label for="city"> @lang('site.choose_piece') </label>
              <select class="form-control" name="piece_id" id="piece_id">
                <option selected> @lang('site.choose_piece') </option>
                
                @foreach ($pieces as $piece)
              <option value="{{ $piece->id }}"> {{ $piece['name_'.my_lang()] }} </option>    
                @endforeach
              </select>
            </div>

          </div> --}}

          <div class="col-lg-2 col-md-3 col-sm-6">
            <div class="form-group">
              <label> </label>
            <button type="submit" class="btn btn-go btn-block mt-3"> @lang('site.apply') </button>
          </div>
          </div>
        </form>

      </div>
      <!-- start new row -->
      <div class="col-md-12 mt-5">
        <div class="table-responsive">
          <table class="table ">
            <thead class=" bg-dark-blue">
              <tr>
                <th scope="col"> @lang('site.brand') </th>
                <th scope="col"> @lang('site.model') </th>
                <th scope="col"> @lang('site.manufacturing_year') </th>
                
                <th scope="col"> @lang('site.piece_name') </th>
                <th scope="col"> @lang('site.highest_price') </th>
                <th scope="col"> @lang('site.medium_price') </th>
                <th scope="col"> @lang('site.lower_price') </th>
              </tr>
            </thead>
            <tbody>

              @foreach ($items as $item)
                <tr class="bg-blue">
                <th scope="row"><img src="{{ brand_img($item->brand->logo) }}" alt="" class="brand-logo"></th>
                
                  <td> {{ $item->model['name_'.my_lang()] }} </td>
                  <td> {{ $item->year }} </td>

                  <td> {{ $item->piece['name_'.my_lang()] }} </td>
                  <td>
                    <p class="color-dark">
                      @if($item->max_price != $item->min_price) <span class="p-green"> {{ $item->max_price }}</span> 
                       @lang('site.rs') @else - @endif
                    </p>
                  </td>
                  <td>
                    <p class="color-dark">
                       {{ round($item->avg_price,2) }}  @lang('site.rs') 
                    </p>
                  </td>
                  <td>
                    <p class="color-dark"> 
                      @if($item->max_price != $item->min_price) <span class="p-orange"> {{ $item->min_price }} </span>
                        @lang('site.rs') @else - @endif
                    </p>
                  </td>

                </tr>
              @endforeach              
              
            </tbody>
          </table>

        
        </div>


        <div class="text-center"> {{ $items->links() }} </div>

      </div>
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