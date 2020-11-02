
@extends('site.app')

@section('title')  @lang('site.seller_requests') @endsection

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
           
            
          <table class="my-tbl" id="myTbl">
            <thead class=" text-primary">
                <tr>
                    <th>#  </th>
                    <th> @lang('site.the_request') </th>
                    <th> @lang('site.price') </th>
                    <th> @lang('site.status') </th>
                    <th class="operations_th"></th>
              </tr>
              </thead>
              <tbody class="text-center">
                @foreach($items as $k=>$item)
                @if($item->request)
                  <tr>
                    <td> {{ $k+1 }} </td>
  
                    <td> @lang('site.elec_req_no') {{$item->request->id}}   </td>
 
                    <td> {{ $item->price ? $item->price . __('site.rs') : '-'}} </td>

                    <td> <span class="btn status-{{ $item->status_id }}"> {{ $item->status['name_'.my_lang()] }} </span> </td>

                    <td>
                        
                        <a href="{{ route('request.show',$item->request->id) }}" class="btn-edit">
                            <i class="fa fa-edit"></i> </a>
                   
                    </td>
                  </tr>
                  @endif
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
 
@endsection


@section('scripts')
   
@endsection