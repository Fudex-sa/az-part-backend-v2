
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

          <div class="col-lg-10 col-md-10  col-12">
         
               
                <div class="table-responsive">
                 
                  <a class="btn btn-warning" data-toggle="modal" data-target=".add_item"> 
                    <i class="fa fa-plus"></i>  @lang('site.add') </a> 
        
            
          <table class="table table-striped jambo_table bulk_action" id="myTbl">
            <thead class=" text-primary">
                <tr>
                    <th>#  </th>
                    <th> @lang('site.city') </th>
                    <th> @lang('site.price') </th>
                    <th> @lang('site.active') </th>
                    <th></th>
              </tr>
              </thead>
              <tbody>
                @foreach($items as $k=>$item)
                  <tr>
                    <td> {{ $k+1 }} </td>
 
                    <td>{{$item->city['name_'.my_lang()]}}</td>
 
                    <td> {{ $item->price }} @lang('site.rs') </td>

                    <td> 
                      @if($item->active ==1) <button class="btn btn-success btn-xs" onclick="activate({{ $item->id }})">
                        <i class="fa fa-check"></i> @lang('site.de_activate') </button>
                    @else
                        <button class="btn btn-warning btn-xs" onclick="activate({{ $item->id }})">
                        <i class="fa fa-close"></i> @lang('site.activate') </button>
                    @endif       
                    </td>

                    <td>
                        
                        <a href="{{ route('rep.my_price',$item->id) }}" class="btn btn-info btn-xs">
                            <i class="fa fa-edit"></i> </a>
                  
                        <a onclick="deleteItem({{ $item->id }})" class="btn btn-danger btn-xs">
                              <i class="fa fa-trash"></i> </a>
                      
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

    @include('rep.my_prices.create')

@endsection


@section('scripts')
     

    @include('dashboard.ajax.delete',['target'=>'my_price']) 

    @include('dashboard.ajax.activate',['target'=>'my_price'])  

    @include('dashboard.ajax.load_regions') 
    @include('dashboard.ajax.load_cities') 

@endsection