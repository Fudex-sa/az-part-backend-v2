
@extends('site.app')

@section('title')  @lang('site.my_prices') @endsection

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

          <div class="col-lg-9 col-md-9  col-12" style="margin-top: -66px;">

            <div class="btn-add-container float-left">
              <a data-toggle="modal" data-target=".add_item" class="btn btn-save"> 
                <i class="fa fa-plus"></i>  @lang('site.add') </a>
                <br/><br/>
              </div>
 

              <table class="my-tbl text-center" id="myTbl">
                <thead class=" text-primary">
                    <tr>
                        <th>#  </th>
                        <th> @lang('site.tashlih_region') </th>
                        <th> @lang('site.city') </th>
                        <th> @lang('site.price') </th>
                        <th> @lang('site.active') </th>
                        <th> @lang('site.car_size') </th>
                        <th class="operations_th"></th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($items as $k=>$item)
                      <tr>
                        <td> {{ $k+1 }} </td>
     
                        <td>{{ $item->region_from ? $item->region_from['name_'.my_lang()] : ''}}</td>

                        <td>{{ $item->city ? $item->city['name_'.my_lang()] : ''}}</td>
     
                        <td> {{ $item->price }} @lang('site.rs') </td>
    
                        <td> 
                          @if($item->active ==1) <button class="btn btn-success btn-xs" onclick="activate({{ $item->id }})">
                            <i class="fa fa-check"></i> @lang('site.de_activate') </button>
                        @else
                            <button class="btn btn-warning btn-xs" onclick="activate({{ $item->id }})">
                            <i class="fa fa-close"></i> @lang('site.activate') </button>
                        @endif       
                        </td>
    
                        <td> {{ implode(',',$item->car_size) }} </td>
    
                        <td>
                            
                            <a href="{{ route('rep.my_price',$item->id) }}" class="btn-edit">
                                <i class="fa fa-edit"></i> </a>
                      
                            <a onclick="deleteItem({{ $item->id }})" class="btn-delete">
                                  <i class="fa fa-trash"></i> </a>
                          
                        </td>
                      </tr>
                  @endforeach
                      
                  </tbody>
            
                </table>
        
            </table>
          
        
         
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

 

@endsection

@section('popup')

    @include('rep.my_prices.create')

@endsection


@section('scripts')
     

    @include('dashboard.ajax.delete',['target'=>'my_price']) 

    @include('dashboard.ajax.activate',['target'=>'my_price'])  
 
    @include('dashboard.ajax.load_regions') 
    @include('dashboard.ajax.load_cities') 
 
@endsection