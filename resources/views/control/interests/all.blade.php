
@extends('site.app')

@section('title') @lang('site.my_interests')  @endsection

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

          <div class="col-lg-9 col-md-9  col-12" style="margin-top: -120px;">

            <div class="row">
              <div class="col-md-12">
                <div class="btn-add-container float-left" style="margin-bottom: 10px;">
                  <button type="button" class="btn btn-save" data-toggle="modal"
                    data-target=".bd-example-modal-lg">
                    <i class="fa fa-plus"></i> @lang('site.add-new-interest')
                  </button>

                </div>
              </div>
              <div class="col-md-12">

                  <table class="my-tbl">
                    <thead>
                      <tr>
                        <th scope="col"> #  </th>
                        <th scope="col"> @lang('site.brand') </th>
                        <th scope="col"> @lang('site.model') </th>
                        <th scope="col"> @lang('site.manufacturing_year') </th>
                        <th scope="col"> @lang('site.price') </th>
                        <th scope="col"> @lang('site.country') </th>
                        <th scope="col"> @lang('site.region') </th>
                        <th scope="col"> @lang('site.city') </th>

                        <th class="operations_th"> </th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($interests as $interest)
                          <tr>
                              <td> {{ $interest->id }} </td>

                              <td> {{ $interest->brand ? $interest->brand['name_'.my_lang()] : '' }} </td>

                              <td> {{ $interest->model ? $interest->model['name_'.my_lang()] : '' }}  </td>

                              <td> {{ $interest->year }}  </td>

                              <td>{{ ($interest->price_type === 'fixed')  ?  __('site.fixed_price')  :  __('site.price_on_bidding') }}
                                    @if($interest->price_from != null & $interest->price_to != null)
                                        {{  __('site.from').":".$interest->price_from." ".__('site.to').":".$interest->price_to }}
                                    @endif
                               </td>
                                 <td> {{ $interest->country ? $interest->country['name_'.my_lang()] : '' }}  </td>
                                   <td> {{ $interest->region ? $interest->region['name_'.my_lang()] : '' }}  </td>
                              <td> {{ $interest->city ? $interest->city['name_'.my_lang()] : '' }}  </td>


                              <td>
                                <a href="{{ route('control.user_interest',$interest->id) }}" class="btn-edit"> <i class="fa fa-edit"></i> </a>

                                <a href="{{ route('control.user_interest.delete',$interest->id) }}" class="btn-delete"><i class="fa fa-trash"></i> </a>

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
</section>

@endsection


@section('popup')

  @include('control.interests.create')

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
  </script>

@endsection
