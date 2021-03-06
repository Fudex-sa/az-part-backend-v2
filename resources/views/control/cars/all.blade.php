
@extends('site.app')

@section('title') @lang('site.my_cars')  @endsection

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

            <div class="row">
              <div class="col-md-12">
                <div class="btn-add-container float-left" style="margin-bottom: 10px;">
                  <a class="btn btn-save" href="{{ route('control.car.add') }}">
                    <i class="fa fa-plus"></i> @lang('site.add_car')
                  </a>

                </div>
              </div>
              <div class="col-md-12">
                <div class="table-responsive">
                  <table class="my-tbl text-center">
                    <thead>
                      <tr>
                        <th scope="col"> #  </th>
                        <th scope="col"> <i class="fa fa-camera"></i>  </th>
                        <th scope="col"> @lang('site.title') </th>
                        <th scope="col"> @lang('site.model') </th>
                        <th scope="col"> @lang('site.type') </th>
                        <th scope="col"> @lang('site.price') </th>
                        <th scope="col"> @lang('site.created_at') </th>
                        <th class="operations_th"> </th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $k=>$item)
                          <tr>
                              <td> {{ $k+1 }} </td>

                              <td> @if(isset($item->imgs[0]))
                                    <img src="{{ img_path($item->imgs[0]->photo) }}" class="img-user"/>
                                    @else <img src="{{ site('assets/images/logo.png') }}" class="img-user"/> @endif 
                              </td>

                              <td> <a href="{{ route('car',$item->id) }}" target="_blank"> {{ $item->title }} </a> </td>

                              <td>
                                {{ $item->brand ? $item->brand['name_'.my_lang()] : '' }} -
                                {{ $item->model ? $item->model['name_'.my_lang()] : '' }} -
                                {{ $item->year }}
                              </td>

                              <td> {{ __('site.'.$item->type) }} </td>
                              <td> {{ $item->price_type == 'fixed' ? $item->price . ' '. __('site.rs') : __('site.'.$item->price_type) }} </td>
                              <td> {{ date('Y-m-d',strtotime($item->created_at)) }} </td>
                              <td>
                                <a href="{{ route('control.car',$item->id) }}" class="btn-edit"> <i class="fa fa-edit"></i> </a>

                                <a onclick="deleteItem({{ $item->id }})" class="btn-delete"><i class="fa fa-trash"></i> </a>

                              </td>
                          </tr>
                        @endforeach

                    </tbody>
                  </table>
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

  @include('control.cars.create')

@endsection

@section('scripts')
  <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

  <script src="{{ site('assets/js/select2.js') }}"></script>

  @include('dashboard.ajax.load_models')
  @include('dashboard.ajax.load_regions')
  @include('dashboard.ajax.load_cities')

  @include('dashboard.ajax.delete',['target'=>'car'])

  <script>
    $(document).on("click","input[name=price_type]:radio",function(){
        var price_type = $(this).val();

        if(price_type == 'fixed')
          $("#price_div").show();
        else
          $("#price_div").hide();
    });

    $(document).on("click","input[name=auction]:radio",function(){
        var auction = $(this).val();

        if(auction == 1){ 
          $("#auction_div").show();
          $(".price-options").hide();
        }else{ 
          $("#auction_div").hide();
          $(".price-options").show();
        }
    });

    $(document).on("click","input[name=type]:radio",function(){
        var type = $(this).val();

        if(type == 'antique'){
          $(".tender").show();
          $("#original_or_not").show();
        }else{ 
          $(".tender").hide();
          $("#auction_div").hide();
          $("#original_or_not").hide();
          $(".replica_years").hide();  
          $(".car-year").show();
        }
    });

    $(document).on("click","input[name=original]:radio",function(){
        var original = $(this).val();

        if(original == 0){
          $(".replica_years").show();  
          $(".car-year").hide();        
        }else{ 
          $(".replica_years").hide();          
          $(".car-year").show();
        }
    });
  </script>
   <script>
        // upload image
        function readURL(input) {
            var id = $(input).attr("id");
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {

                    $('label[for="' + id + '"] .prev').attr('src', e.target.result).show();
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $(".inputfile").change(function () {
            readURL(this);
        });
    </script>

@endsection
