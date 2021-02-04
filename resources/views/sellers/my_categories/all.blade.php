@extends('site.app')

@section('title')  @lang('site.my_categories') @endsection

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
            
            <div class="table-responsive">
          <table class="my-tbl" id="myTbl">
            <thead class=" text-primary">
                <tr>
                    <th>#  </th>
                    <th> @lang('site.name') </th>                    
                    <th class="operations_th"></th>
              </tr>
              </thead>
              <tbody class="text-center">
                @foreach($items as $k=>$item)
                  <tr>
                    <td> {{ $k+1 }} </td>
 
                    <td> {{ $item->category ? $item->category['name_'.my_lang()] : __('site.all') }} </td>

                    <td>
                      
                        <a onclick="deleteItem({{ $item->id }})" class="btn-delete">
                              <i class="fa fa-trash"></i> </a>
                      
                    </td>
                  </tr>
              @endforeach
                  
              </tbody>
        
            </table>
          </div>
          
          <div class="text-center">  {{ $items->links('vendor.pagination.bootstrap-4') }}  </div>
         
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

 @endsection
 
@section('popup')

 @include('sellers.my_categories.create')

@endsection

@section('scripts')    
 
    @include('dashboard.ajax.delete',['target'=>'my_category']) 
    
@endsection
