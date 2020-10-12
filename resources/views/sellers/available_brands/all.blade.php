
@extends('site.app')

@section('title')  @lang('site.avaliable_models') @endsection

@section('styles')
    
@endsection

@section('content')

<div class="about">
    <div class="container">
      <div class="row">
        
        @include('layouts.breadcrumb')

        <div class="col-md-8">
          <div class="privacy-box">
           
        
            <a class="btn btn-warning" data-toggle="modal" data-target=".add_item"> 
                    <i class="fa fa-plus"></i>  @lang('site.add') </a> 
        
            
          <table class="table table-striped jambo_table bulk_action" id="myTbl">
            <thead class=" text-primary">
                <tr>
                    <th>#  </th>
                    <th> @lang('site.brand') </th>
                    <th> @lang('site.model') </th>
                    <th> @lang('site.years') </th>
                    <th></th>
              </tr>
              </thead>
              <tbody>
                @foreach($items as $k=>$item)
                  <tr>
                    <td> {{ $k+1 }} </td>

                    <td>
                      <img src="{{brand_img($item->brand['logo'])}}" width="50"/>
                      {{$item->brand['name_'.my_lang()]}}
                    </td>
                    
                    <td>{{$item->model['name_'.my_lang()]}}</td>
 
                    <td> {{ implode(',',$item->years) }} </td>

                    <td>
                        
                        <a href="{{ route('seller.avaliable_model',$item->id) }}" class="btn btn-info btn-xs">
                            <i class="fa fa-edit"></i> </a>
                  
                        <a onclick="deleteItem({{ $item->id }})" class="btn btn-danger btn-xs">
                              <i class="fa fa-trash"></i> </a>
                      
                    </td>
                  </tr>
              @endforeach
                  
              </tbody>
        
            </table>
          
        <div class="text-center"> {{ $items->links() }} </div>
            
          </div>
        </div>
 
        
      </div>
    </div>
  </div>

@endsection

@section('popup')

    @include('sellers.available_brands.create')

@endsection


@section('scripts')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

    <script src="{{ site('assets/js/select2.js') }}"></script>

    @include('dashboard.ajax.load_models') 

    @include('dashboard.ajax.delete',['target'=>'avaliable_model']) 

@endsection