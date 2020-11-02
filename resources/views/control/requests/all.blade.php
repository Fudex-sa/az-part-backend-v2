
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

          <div class="col-lg-9 col-md-9  col-9">
          
            <div class="row">
              
                  <table class="my-tbl text-center">
                    <thead class="text-center">
                      <tr>
                        <th scope="col"> #  </th>         
                        <th scope="col"> <i class="fa fa-camera"></i> </th>                                       
                        <th scope="col"> @lang('site.model') </th>
                        <th scope="col"> @lang('site.piece') </th>
                        <th scope="col"> @lang('site.qty') </th>                        
                        <th scope="col"> @lang('site.request_sellers') </th>                        
                        <th scope="col"> @lang('site.created_at') </th>
                        <th class="operations_th"> </th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                          <tr>
                              <td> {{ $item->id }} </td>
                              <td> 
                                @if($item->photo)
                                  <img src="{{ cart_img($item->photo) }}" class="img-table" /> </td>
                                @else <img src="{{ site('assets/images/logo.png') }}" class="img-table" /> </td> @endif

                              <td> 
                                {{ $item->brand ? $item->brand['name_'.my_lang()] : '' }} -
                                {{ $item->model ? $item->model['name_'.my_lang()] : '' }} -
                                {{ $item->year }} 
                              </td>

                              <td> {{ $item->piece_alt ? $item->piece_alt['name_'.my_lang()] : '' }} </td>

                              <td> {{ $item->qty }} </td>
                            
                              <td> <a href="{{ route('request.offers',$item->id) }}"> 
                                    <span class="bg-circle"> {{ count($item->assign_sellers) }} </span> 
                                     
                                  </a> </td>
                            
                              <td> {{ date('Y-m-d',strtotime($item->created_at)) }} </td>
                            
                              <td>
                                <a href="{{ route('request.show',$item->id) }}" class="btn-edit"> <i class="fa fa-edit"></i> </a>
    
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
</section>


@endsection

@section('popup')
   
@endsection

@section('scripts')
  
  @include('dashboard.ajax.delete',['target'=>'my_request']) 

@endsection