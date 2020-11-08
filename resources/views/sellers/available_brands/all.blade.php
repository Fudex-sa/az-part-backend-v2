
@extends('site.app')

@section('title')  @lang('site.avaliable_models') @endsection

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
 
            
          <table class="my-tbl" id="myTbl">
            <thead class=" text-primary">
                <tr>
                    <th>#  </th>
                    <th> @lang('site.brand') </th>
                    <th> @lang('site.model') </th>
                    <th> @lang('site.year') </th>
                    <th class="operations_th"></th>
              </tr>
              </thead>
              <tbody class="text-center">
                @foreach($items as $k=>$item)
                  <tr>
                    <td> {{ $k+1 }} </td>

                    <td>
                      <img src="{{brand_img($item->brand['logo'])}}" width="50"/>
                      {{$item->brand['name_'.my_lang()]}}
                    </td>
                    
                    <td>{{$item->model['name_'.my_lang()]}}</td>
 
                    <td> {{ $item->year }} </td>

                    <td>
                        
                        <a href="{{ route('seller.avaliable_model',$item->id) }}" class="btn-edit">
                            <i class="fa fa-edit"></i> </a>
                  
                        <a onclick="deleteItem({{ $item->id }})" class="btn-delete">
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
</section>

 
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