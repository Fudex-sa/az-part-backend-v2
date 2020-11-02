
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

          <div class="col-lg-9 col-md-9  col-12">
           
            
            <div class="row">
                <h3 class="col-md-12"> @lang('site.request_details') </h3>

                <table class="table table-striped col-md-8">
                    <tr>
                        <th> @lang('site.request_no') </th>
                        <td> ER-{{ $item->id }} </td>
                    </tr>

                    <tr>
                        <th> @lang('site.user') </th>
                        <td> {{ $item->user->name }}   ( {{ __('site.'.$item->user_type) }} ) </td>
                    </tr>

                    <tr>
                        <th> @lang('site.model') </th>
                        <td> {{ $item->brand ? $item->brand['name_'.my_lang()] : '' }}-
                            {{ $item->model ? $item->model['name_'.my_lang()] : '' }}-
                            {{ $item->year }}
                        </td>
                    </tr>

                    <tr>
                        <th> @lang('site.region') </th>
                        <td> {{ $item->country ? $item->country['name_'.my_lang()] : '' }} -
                              {{ $item->region ? $item->region['name_'.my_lang()] : '' }} -
                              {{ $item->city ? $item->city['name_'.my_lang()] : '' }} 
                        </td>
                    </tr>
                    
                </table>

                 <div class="col-md-1"></div>
 
                    <table class="table table-striped col-md-3">                  
                      <form method="POST" action="{{ route('seller.request.update',$req_seller->id) }}">
                          @csrf
                        <tr>
                            <th> @lang('site.price') </th>
                        <td> <input type="number" name="price" class="form-control" required
                            value="{{ $req_seller ? $req_seller->price : '' }}"/> </td>
                        </tr>
                        <tr class="text-center">
                          <td colspan="2"> <input type="submit" value="@lang('site.send')" class="btn btn-success" /> </td>
                        </tr>
                      </form>
                    </table>
                 
            </div>

            <hr/>

            <h3> @lang('site.piece_data') </h3>

            <table class="table table-striped">
                <tr>
                    <th> @lang('site.piece_name') </th>
                    <td> {{ $item->piece_alt['name_'.my_lang()] }} </td>

                    <th> @lang('site.piece_img') </th>                    
                    <td>  <img src="{{ cart_img($item->photo) }}" class="img-table" /> </td>
                </tr>

                <tr>
                  <th> @lang('site.qty') </th>
                  <td> {{ $item->qty }} </td>

                  <th> @lang('site.notes') </th>
                  <td> {{ $item->notes }} </td>
                </tr>

                <tr>
                  <th> @lang('site.color') </th>
                  <td> {{ $item->color }} </td>

                </tr>
 
                 
            </table>

         
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