
@extends('site.app')

@section('title') @lang('site.electronic_search') @endsection

@section('styles')
    
    
@endsection

@section('content')

<section class="manual-search">
    <div class="container">
      <div class="row">
        @include('layouts.breadcrumb')
     
        @if(total_valid_elec() > 0)
        {{-- @if(valid_for_elec() == 1) --}}
  
        @if($response['found_result'] == 0)
          <div class="modal-body modal-padding">

            <div class="text-center advice">                           
              <p>  {{ data('search_find_no_result') }} 
                <a href="javascript:void(0);" data-toggle="modal" data-target="#other_cities">
                  @lang('site.in_other_cities') </a>
              </p>
            </div>

          @else

            
            <div class="head-section mb-5 col-md-12">
              <h2> @lang('site.enter_required_pieces') </h2>              
              
              @if(total_valid_elec() > 1)
                <div class="text-left">
                      <a onclick="addNewPiece()" href="javascript:void(0);">
                          @lang('site.add_piece') <i class="fa fa-plus"></i> </a>
                </div>
              @endif
            </div>
            
     
           <form class="col-md-12 pop-margin" method="POST" action="{{ route('create_request') }}" enctype="multipart/form-data">
            @csrf
            
             <input type="hidden" name="brand_id" value="{{ request()->brand }}" />
             <input type="hidden" name="model_id" value="{{ request()->model }}" />
             <input type="hidden" name="year" value="{{ request()->year }}" />
             <input type="hidden" name="country_id" value="{{ request()->country }}" />
             <input type="hidden" name="region_id" value="{{ request()->region }}" />
             <input type="hidden" name="city_id" value="{{ request()->city }}" />
              
              <div class="form-group row">
     
                <div class="col-md-4">
                    <label> @lang('site.piece_name') </label>

                  <select name="piece_alt_id[]" class="form-control select2">
                     <option value=""> @lang('site.choose_piece') </option>
                       @foreach ($piece_alts as $piece_alt)
                         <option value="{{ $piece_alt->id }}"> {{ $piece_alt['name_'.my_lang()] }} </option>     
                       @endforeach
                  </select>
                </div>
                
                <div class="form-group col-md-4">
                    <label> @lang('site.qty') </label>

                    <input type="number" class="form-control" name="qty[]" min="1" value="1" placeholder="@lang('site.qty')">
                  </div>

                <div class="form-group col-md-4">
                    <label> @lang('site.color') </label>

                    <input type="text" class="form-control" name="color[]"  placeholder="@lang('site.color')">
                  </div>
                  
                  <div class="form-group col-md-4">
                    <label> @lang('site.piece_image') </label>

                    <input type="file" class="form-control" name="photo[]">
                  </div>
                   
                <div class="form-group col-md-8">
                    <label> @lang('site.notes') </label>

                    <input type="text" class="form-control" name="notes[]"  placeholder="@lang('site.notes')">
                </div>

                <div id="more_pieces" class="row"> </div>
      
              <button type="submit" class="btn btn-next btn-block btn-lg"> @lang('site.order_now') </button>
            </form>
     
            @endif

          </div>
        
          @else          
            <div class="advice"> 
              <p> {{ data('invalid_for_elec') }} </p>
            </div>          
          @endif

        <div class="col-md-12">

          <div class="advice text-center">       
            @if(total_valid_elec() < 1)
            {{-- @if(valid_for_elec() == 0)      --}}
              <a href="{{ route('package.show',request()->search_type) }}" class="btn btn-results">
                @lang('site.join_our_packages') </a>
            @endif
          </div>
          
        </div>

      </div>

    </div>
  </section>


@endsection

@section('popup')
    
@include('site.parts.other_cities')
    
@endsection


@section('scripts')
  
@if($response['found_result'] == 0)
<script>
GrowlNotification.notify({
    title: "{{__('site.failed')}}",
    description: " {{ __('site.not_found_result_in_your_city') }} ",
    zIndex: 1056,
    'type' : 'error'
  });
</script>
@endif

<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

<script src="{{ site('assets/js/select2.js') }}"></script>


<script src="{{ site('assets/js/bootstrap-input-spinner.js') }}"></script>
<script>
  $("input[type='number']").inputSpinner()

  var pieceCount =1;
  
  function addNewPiece(){
      pieceCount ++;

        $.get("{{ route('more_pieces') }}", function(data){
            $("#more_pieces").append(data);
        });
    };


    function removePiece(elem){
        $(elem).parent().parent('.piecePart').remove();
    }

</script>
@endsection