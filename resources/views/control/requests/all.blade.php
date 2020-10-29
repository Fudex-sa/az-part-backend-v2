
@extends('site.app')

@section('title') @lang('site.my_requests')  @endsection

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

          <div class="col-lg-10 col-md-10  col-12" style="margin-top: -120px;">
          
            <div class="row">
             
              <div class="col-md-12">
                <div class="table-responsive">
                  <table class="table mt-5 tabel-order">
                    <thead class="thead-light">
                      <tr>
                        <th scope="col"> #  </th>         
                        <th scope="col"> <i class="fa fa-camera"></i> </th>                                       
                        <th scope="col"> @lang('site.model') </th>
                        <th scope="col"> @lang('site.piece') </th>
                        <th scope="col"> @lang('site.qty') </th>                        
                        <th scope="col"> @lang('site.offers_placed_no') </th>                        
                        <th scope="col"> @lang('site.created_at') </th>
                        <th style="width: 115px;"> </th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                          <tr>
                              <td> {{ $item->id }} </td>
                              <td> <img src="{{ cart_img($item->photo) }}" style="width: 100px;" /> </td>
                              
                              <td> 
                                {{ $item->brand ? $item->brand['name_'.my_lang()] : '' }} -
                                {{ $item->model ? $item->model['name_'.my_lang()] : '' }} -
                                {{ $item->year }} 
                              </td>

                              <td> {{ $item->piece_alt ? $item->piece_alt['name_'.my_lang()] : '' }} </td>

                              <td> {{ $item->qty }} </td>
                              <td> </td>
                              <td> {{ $item->created_at }} </td>
                              <td>
                              <a href="{{ route('request.show',$item->id) }}" class="btn btn-info btn-xs"> <i class="fa fa-edit"></i> </a>
    
                                <a onclick="deleteItem({{ $item->id }})" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> </a>

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
   
@endsection

@section('scripts')
  
  @include('dashboard.ajax.delete',['target'=>'my_request']) 

@endsection